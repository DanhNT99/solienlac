@extends('admin/layouts/index')
@section('title') Nhập điểm @endsection
@section('adminContent')
    @include('admin/layouts/tab')
    <section class="adminAdd">
        <div class="container">

            <div class="adminBoxTitle">
                <div class="yearOfCourse">Năm học: {{$nienkhoa->NamBatDau . '- ' . $nienkhoa->NamKetThuc}}</div>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>

            <div class="adminFormAddBox pt-0">
                <div class="px-4 d-flex">
                    <div class="mr-2 mx-0 btnClass">Lớp : {{$giaovien->Lop->TenLop}}</div>
                        <div class = "mx-0 btnClass d-flex">
                            @foreach ($nienkhoa->HocKy as $item)
                                @if ($item->TrangThai)   <div >{{$item->TenHK}}</div>  @endif
                            @endforeach
                        </div>

                    <!-- Button trigger modal -->
                    <button type="button" class="btnClass ml-auto mr-0" data-toggle="modal" data-target="#exampleModalCenter">
                        Hướng dẫn <i class="far fa-comment-dots"></i>
                      </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog justify-content-center modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header py-1 px-2">
                                    <p class="modal-title" id="exampleModalLongTitle">Hướng dẫn nhập điểm</p>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <ol class = "ml-2">
                                        <li>Các môn học chỉ đánh giá bằng mức đạt được
                                            <ol class="ml-2" type="a">
                                                <li>Ở các lớp 1, 2, 3: Đạo đức, Thể dục, Âm nhạc, Mỹ thuật, Kỹ thuật, Tự nhiên xã hội</li>
                                                <li>Ở các lớp 4, 5: Đạo đức, Thể dục, Âm nhạc, Mỹ thuật, Kỹ thuật.</li>
                                            </ol>
                                        </li>
                                        <li>Chỉ có khối 4 và khối 5 mới có thể nhập điểm giữa kì môn toán và tiếng việt</li>
                                        
                                    </ol>
                                </div>
                                <div class="modal-footer py-1">
                                    <button type="button" class="btn btn-secondary py-1 bg-dangrue" data-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{route('ketquahoctap.store')}}" method="post" class="adminFormAdd">
                    @csrf

                    <table class="adminFormAddTable adminFormAddTableSmall">
                        <tr class="d-none">
                            <td>
                                <div class="formBoxSelect">
                                    <select name="khoi" id = "khoi" class="formSelect">
                                        <option value="{{$giaovien->Lop->Khoi->id}}"></option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><p class="adminFormAddText">Môn học</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="monhoc" id = "subject" class="formSelect">
                                        <option selected disabled>Lựa chọn</option>
                                            @foreach ($giaovien->Lop->Khoi->PhanMonHoc as $item)
                                                <option @if ($item->MonHoc->id == old('monhoc')) selected
                                                @endif value="{{$item->MonHoc->id}}">{{$item->MonHoc->TenMH}}</option>
                                            @endforeach 
                                    </select>
                                    <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                </div>
                                @if ($errors->has('monhoc')) 
                                        <div class="notiFail" role="alert">{{$errors->first('monhoc')}}</div>
                                @endif
                            </td>
                            <td><p class="adminFormAddText">Loại học kỳ</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="LoaiHK" id = "loaiHK" class="formSelect">
                                        <option selected disabled>Lựa chọn</option>
                                            @foreach ($nienkhoa->HocKy as $hocky)
                                                @if ($hocky->TrangThai)
                                                    @foreach ($hocky->LoaiHocKy as $loaihk)
                                                        <option @if ($loaihk->id == old('LoaiHK')) selected
                                                            @endif value="{{$loaihk->id}}"> {{$loaihk->TenLoaiHK}}</option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                    </select>
                                    <div class="formSelectIcon">
                                        <i class="fas fa-caret-down"></i>
                                    </div>
                                </div>
                                @if ($errors->has('LoaiHK')) 
                                    <div class="notiFail" role="alert">{{$errors->first('LoaiHK')}}</div>
                                @endif
                            </td>
                        </tr>
                    </table>
                    
                    <table border = "1" class="adminTable w-75 mt-5">
                        <tr>
                            <th>stt</th>
                            <th>Tên học sinh</th>
                            <th>Mức đạt được</th>
                            <th>Điểm</th>
                        </tr>
                            @foreach ($giaovien->Hoc->where('id_nienkhoa', $nienkhoa->id) as $item)
                            <tr>
                                <td>{{$stt++}}</td>
                                <td><input type="text" class="d-none solienlac" name="SoLienLac[]" value = "{{$item->HocSinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->id}}" >
                                    {{$item->HocSinh->HoHS . ' ' .$item->HocSinh->TenHS}}</td>
                                <td>
                                    <select name="MucDatDuoc[]" class="MucDatDuoc text-center">
                                        <option selected value="" >Lựa chọn</option>
                                        <option value="T">T</option>
                                        <option value="H">H</option>
                                        <option value="C">C</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="Diem[]"  class="formInput formInputMa Diem"></td>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="adminFormSearchContainsBtn adminFormAddGroup">
                        <button class="adminFormAddBtn" name = "luu">lưu</button>
                        <a href = "admin/ketquahoctap" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

  
    {{-- <script type="text/javascript">
       function clickTr(id) {
        console.log('đã click');
    }
    </script> --}}
@endsection
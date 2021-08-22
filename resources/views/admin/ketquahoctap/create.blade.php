@extends('admin/layouts/index')
@section('title') Nhập điểm @endsection
@section('adminContent')
    @include('admin/layouts/tab')
    <section class="adminAdd">
        <div class="container-xl container-lg-fluid">
            <div class="adminBoxTitle py-1 px-2 mb-2" style="width: fit-content;">
                <span>Năm học : {{$nienkhoa->NamBatDau . ' - ' . $nienkhoa->NamKetThuc}}</span>
                <span class="mx-2">|</span>
                <span>{{$hocky->TenHK}}</span>
                <span class="mx-2">|</span>
                <span> Lớp: {{$giaovien->Lop->TenLop}}</span>
            </div>
                        
            <div class="adminBoxTitle py-1 px-2">
            <h6 class = "m-0"><i class="fas fa-plus-circle adminBoxTitleIcon mr-1"></i>Nhập điểm học sinh</h6>
            <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>

            <div class="adminFormAddBox pt-0">
                <div class="ml-2">
                    <!-- Button trigger modal -->
                    <button type="button" class="btnClass" data-toggle="modal" data-target="#exampleModalCenter">
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
                                                <li>Đạo đức, Thể dục, Âm nhạc, Mỹ thuật, Kỹ thuật, Tự nhiên xã hội</li>
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
                                                <option @if ($item->MonHoc->id == Request::get('idSubject')) selected
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
                                                        <option value="{{$loaihk->id}}"> {{$loaihk->TenLoaiHK}}</option>
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
                    
                    <table border = "1" class="adminTable  w-75 mt-2 mt-lg-5">
                        <tr>
                            <th>stt</th>
                            <th>Tên học sinh</th>
                            <th>Mức đạt được</th>
                            <th>Điểm</th>
                        </tr>
                            @foreach ($giaovien->Hoc->where('id_nienkhoa', $nienkhoa->id) as $item)
                            <tr>
                                <td>{{$stt++}}</td>
                                <td class="text-left pl-3"><input type="text" class="d-none solienlac" name="SoLienLac[]" value = "{{$item->HocSinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->id}}" >
                                    {{$item->HocSinh->HoHS . ' ' .$item->HocSinh->TenHS}}</td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="MucDatDuoc[]" class="MucDatDuoc formSelect formSelectSmall">
                                            <option selected value="" >Lựa chọn</option>
                                            <option value="T">T</option>
                                            <option value="H">H</option>
                                            <option value="C">C</option>
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                </td>
                                <td>
                                    <input type="number" name="Diem[]" min = "1" max = "10" 
                                            class="formInput formInputMa Diem text-center">
                                    <div class="notiFail w-75 mx-auto text-left hide" role="alert"></div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="adminFormSearchContainsBtn adminFormAddGroup">
                        <button type="submit" class="px-2 py-1 border-0 rounded modalBtn mr-1">Thực hiện</button>
                        <a href = "admin/ketquahoctap" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
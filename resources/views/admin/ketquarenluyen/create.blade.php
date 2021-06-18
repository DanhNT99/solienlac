@extends('admin/layouts/index')
@section('title')Đánh gia rèn luyện @endsection
@section('adminContent')
    @include('admin/layouts/tab')
    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle">
                <div class="yearOfCourse">Năm học: {{$nienkhoa->NamBatDau . '- ' . $nienkhoa->NamKetThuc}}</div>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="adminFormAddBox">
                <div class="px-4 d-flex">
                    <div class="mr-2 mx-0 btnClass">Lớp : {{$giaovien->Lop->first()->TenLop}}</div>
                    <div class = "mx-0 btnClass d-flex">
                        @foreach ($nienkhoa->HocKy as $item)
                            @if ($item->TrangThai) 
                                <div >{{$item->TenHK}}</div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <form action="{{route('ketquarenluyen.store')}}" method="post" class="adminFormAdd">
                    @csrf
                    <table class="adminFormAddTable adminFormAddTableSmall">
                        <tr>
                            <td><p class="adminFormAddText">Phẩm chất năng lực</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="PCNL" id = "pcnl" class="formSelect">
                                        <option selected disabled>Lựa chọn</option>
                                        @foreach ($pcnl as $item)
                                            <option class="formBoxSelectOption" value="{{$item->id}}">{{$item->TenPCNL}}</option>
                                        @endforeach       
                                    </select>
                                    <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                </div>
                                @if ($errors->has('PCNL')) 
                                        <div class="notiFail" role="alert">{{$errors->first('PCNL')}}</div>
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
                        </tr>
                         @foreach ($giaovien->Hoc->where('id_nienkhoa', $nienkhoa->id) as $item)
                            <tr>
                                <td>{{$stt++}}</td>
                                <td><input type="text" class="d-none solienlac" name="SoLienLac[]" value = "{{$item->HocSinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->id}}" >
                                    {{$item->HocSinh->HoHS . ' ' .$item->HocSinh->TenHS}}</td>
                                <td>
                                    <select name="XepLoai[]" class="XepLoai">
                                        <option selected value="" >Lựa chọn</option>
                                        <option value="T">T</option>
                                        <option value="Đ">Đ</option>
                                        <option value="C">C</option>
                                    </select>
                                </td>

                            </tr>
                        @endforeach
                    </table>
                    <div class="adminFormSearchContainsBtn adminFormAddGroup">
                        <button class="adminFormAddBtn" name = "luu">lưu</button>
                        <a href = "admin/ketquarenluyen" class="adminFormAddLink">Quay lại</a>
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
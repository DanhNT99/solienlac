@extends('admin/layouts/index')
@section('title')Thêm học sinh @endsection
@section('adminContent')
    @include('admin/hocsinh/tab')

    <section class="adminAdd">

        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-user-plus adminBoxTitleIcon mr-1"></i>Thêm học sinh</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="adminFormAddBox">
                <form action="{{route('hocsinh.store')}}" method = "post" enctype="multipart/form-data" class="adminFormAdd">
                    @csrf
                    <div class="adminFormAddContains">
                        <div class="adminFormAddContainsImg wrapImgResize">
                            <div class="wrapImgResize">
                                <img src="{{asset('assets/images/iconAva.jpg')}}" class="adminFormAddImg" alt="">
                            </div>
                            <div class="adminFormAddContainsIcon">
                                <p><i class="fas fa-camera-retro"></i> Tải hình</p>
                            </div>
                            @if ($errors->has('Hinh')) 
                                <div class="notiFail" role="alert">{{$errors->first('Hinh')}}</div>
                            @endif
                        </div>
                        <input type="file" name = "Hinh" class="adminFormAddFileImg">
                        
                        <table class="adminFormAddTable">
                            <tr>
                                {{-- <td><p class="adminFormAddText">Khối</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="Khoi" id="khoi" class="formSelect">
                                             <option value="{{$lop->Khoi->id}}">{{$lop->Khoi->TenKhoi}}</option>
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i>
                                        </div>
                                    </div>
                                    @if ($errors->has('Khoi')) 
                                        <div class="notiFail" role="alert">{{$errors->first('Khoi')}}</div>
                                     @endif
                                </td> --}}
                                {{-- <td><p class="adminFormAddText">Lớp</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="Lop" id = "lop" class="formSelect">
                                            <option class="formBoxSelectOption" value="{{$lop->id}}">{{$lop->TenLop}}</option>
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>

                                    @if ($errors->has('Lop')) 
                                        <div class="notiFail" role="alert">{{$errors->first('Lop')}}</div>
                                    @endif
                                </td> --}}
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Mã học sinh</p></td>
                                <td> <input type="text" name="MaHS" value = "{{$idHocSinh}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Họ học sinh</p></td>
                                <td><input type="text" name="HoHS" value = "{{old('HoHS')}}" class="formInput capitalize" placeholder="Họ và tên lót">
                                    @if ($errors->has('HoHS')) 
                                        <div class="notiFail" role="alert">{{$errors->first('HoHS')}}</div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Tên học sinh</p></td>
                                <td><input type="text" name="TenHS" value = "{{ old('TenHS') }}" class="formInput capitalize" placeholder="Tên học sinh">
                                    @if ($errors->has('TenHS'))
                                        <div class="notiFail" role="alert">{{$errors->first('TenHS')}}</div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Giới tính</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="GioiTinhHS" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            <option value="Nam">Nam</option>
                                            <option value="Nu">Nữ</option>
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                    @if ($errors->has('GioiTinh')) 
                                        <div class="notiFail" role="alert">{{$errors->first('GioiTinh')}}</div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Ngày sinh</p></td>
                                <td><input type="date" value = "{{ old('NgaySinh') }}" name="NgaySinh" class="formInput">
                                    @if ($errors->has('NgaySinh')) 
                                        <div class="notiFail" role="alert">{{$errors->first('NgaySinh')}}</div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Địa chỉ</p></td>
                                <td><input type="text" name="DiaChi" value = "{{ old('DiaChi') }}" class="formInput capitalize" placeholder="Số nhà và tên đường">
                                    @if ($errors->has('DiaChi')) 
                                        <div class="notiFail" role="alert">{{$errors->first('DiaChi')}}</div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Tỉnh</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="Tinh" id="" class="formSelect">
                                            @foreach ($tinh as $item)
                                                <option value="{{$item->id}}">{{$item->TenTinh}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                    @if ($errors->has('Tinh')) 
                                        <div class="notiFail" role="alert">{{$errors->first('Tinh')}}</div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Phường</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="Phuong" id="" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            @foreach ($phuong as $item)
                                                <option value="{{$item->id}}">{{$item->DonVi . ' '. $item->TenPhuong}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                    @if ($errors->has('Phuong')) 
                                        <div class="notiFail" role="alert">{{$errors->first('Phuong')}}</div>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="">
                        <p class="adminFormTitle">Thêm thông tin phụ huynh</p>
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Họ tên cha</p></td>
                                <td><input type="text" name="HoTen[cha]" value="{{old('HoTen.cha')}}" class="formInput capitalize" placeholder="Họ và tên cha">
                                    @if ($errors->has('HoTen.cha')) 
                                        <div class="notiFail" role="alert">{{$errors->first('HoTen.cha')}}</div>
                                    @endif
                                </td>                                
                                <td><p class="adminFormAddText">Họ tên mẹ</p></td>
                                <td><input type="text" name="HoTen[me]" value="{{old('HoTen.me')}}" class="formInput capitalize" placeholder="Họ và tên mẹ">
                                    @if($errors->has('HoTen.me'))
                                        <div class="notiFail" role="alert">{{$errors->first('HoTen.me')}}</div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Giới tính</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="GioiTinh[cha]" class="formSelect">
                                            <option value="Nam">Nam</option>
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                </td>
                                <td><p class="adminFormAddText">Giới tính</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="GioiTinh[me]" class="formSelect">
                                            <option value="Nu">Nữ</option>
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Nghề nghiệp</p></td>
                                <td><input type="text" name="NgheNghiep[cha]" value="{{old('NgheNghiep.cha')}}" class="formInput" placeholder="Nghề nghiệp">
                                    @if ($errors->has('NgheNghiep.cha')) 
                                        <div class="notiFail" role="alert">{{$errors->first('NgheNghiep.cha')}}</div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Nghề nghiệp</p></td>
                                <td><input type="text" name="NgheNghiep[me]" value="{{old('NgheNghiep.me')}}" class="formInput" placeholder="Nghề nghiệp">
                                    @if ($errors->has('NgheNghiep.me')) 
                                        <div class="notiFail" role="alert">{{$errors->first('NgheNghiep.me')}}</div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Nơi làm việc</p></td>
                                <td><input type="text" name="NoiLamViec[cha]" value="{{old('NoiLamViec.cha')}}" class="formInput" placeholder="Nơi làm việc">
                                    @if ($errors->has('NoiLamViec.cha')) 
                                        <div class="notiFail" role="alert">{{$errors->first('NoiLamViec.cha')}}</div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Nơi làm việc</p></td>
                                <td><input type="text" name="NoiLamViec[me]" value="{{old('NoiLamViec.me')}}" class="formInput" placeholder="Nơi làm việc">
                                    @if ($errors->has('NoiLamViec.me')) 
                                        <div class="notiFail" role="alert">{{$errors->first('NoiLamViec.me')}}</div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Số điện thoại</p></td>
                                <td><input type="text" name="SoDT[cha]" value="{{old('SoDT.cha')}}" class="formInput" placeholder="Số điện thoại">
                                    @if ($errors->has('SoDT.cha')) 
                                        <div class="notiFail" role="alert">{{$errors->first('SoDT.cha')}}</div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Số điện thoại</p></td>
                                <td><input type="text" name="SoDT[me]" value="{{old('SoDT.me')}}" class="formInput" placeholder="Số điện thoại">
                                    @if ($errors->has('SoDT.me')) 
                                        <div class="notiFail" role="alert">{{$errors->first('SoDT.me')}}</div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Mật khẩu</p></td>
                                <td><input type="password" name="MatKhau[cha]" class="formInput" placeholder="Mật khẩu">
                                    @if ($errors->has('MatKhau.cha')) 
                                        <div class="notiFail" role="alert">{{$errors->first('MatKhau.cha')}}</div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Mật khẩu</p></td>
                                <td><input type="password" name="MatKhau[me]" class="formInput" placeholder="Mật khẩu">
                                    @if ($errors->has('MatKhau.me')) 
                                        <div class="notiFail" role="alert">{{$errors->first('MatKhau.me')}}</div>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button class="adminFormAddBtn">Thêm</button>
                        <a href = "admin/hocsinh" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
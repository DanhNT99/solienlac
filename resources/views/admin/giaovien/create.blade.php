@extends('admin/layouts/index')
@section('title') Thêm giáo viên @endsection
@section('adminContent')
    @include('admin/giaovien/tab')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Thêm giáo viên
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="{{route('giaovien.store')}}" method = "post" enctype="multipart/form-data" class="adminFormAdd" >
                    @csrf
                    <div class="adminFormAddContains">
                        <div class="adminFormAddContainsImg">
                            <div class="wrapImgResize">
                                <img src="{{asset('assets/images/iconAva.jpg')}}" class="adminFormAddImg" alt="">
                            </div>
                           
                            <div class="adminFormAddContainsIcon">
                                <p><i class="fas fa-camera-retro"></i> Tải hình</p>
                            </div>
                            @if ($errors->has('Hinh')) 
                                <div class="notiFail" role="alert">
                                    {{$errors->first('Hinh')}}
                                </div>
                            @endif
                        </div>
                        <input type="file" name = 'Hinh' class="adminFormAddFileImg">
                        <table class="adminFormAddTable">
                            <tr>
                                <td><p class="adminFormAddText">Mã giáo viên</p></td>
                                <td> <input type="text" name="MaGV" value="{{$text_id}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Họ giáo viên</p></td>
                                <td>
                                    <input type="text" name="HoGV" value="{{old('HoGV')}}" class="formInput capitalize" placeholder="Họ và tên lót">
                                     @if ($errors->has('HoGV')) 
                                        <div class="notiFail" role="alert">
                                            {{$errors->first('HoGV')}}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Tên giáo viên</p></td>
                                <td>
                                    <input type="text" name="TenGV" value="{{old('TenGV')}}" class="formInput capitalize" placeholder="Tên giáo viên"
                                    @if ($errors->has('TenGV')) 
                                        <div class="notiFail" role="alert">
                                            {{$errors->first('TenGV')}}
                                        </div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Giới tính</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="GioiTinh" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            <option  value="Nam" >Nam</option>
                                            <option value="Nu" >Nữ</option>
                                        </select>
                                        <div class="formSelectIcon">
                                            <i class="fas fa-caret-down"></i>
                                        </div>
                                    </div>

                                    @if ($errors->has('GioiTinh')) 
                                        <div class="notiFail" role="alert">
                                            {{$errors->first('GioiTinh')}}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Ngày sinh</p></td>
                                <td>
                                    <input type="date"  value="{{old('NgaySinh')}}" name="NgaySinh" class="formInput">
                                    @if ($errors->has('NgaySinh')) 
                                        <div class="notiFail" role="alert">
                                            {{$errors->first('NgaySinh')}}
                                        </div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Địa chỉ</p></td>
                                <td>
                                    <input type="text" name="DiaChi" value="{{old('HoGV')}}" class="formInput capitalize" placeholder="Địa chỉ">
                                    @if ($errors->has('DiaChi')) 
                                        <div class="notiFail" role="alert">
                                            {{$errors->first('DiaChi')}}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                            <td><p class="adminFormAddText">Tỉnh</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="Tinh" class="formSelect">
                                            @foreach ($tinh as $item)
                                            <option value="{{$item->id}}">{{$item->TenTinh}}</option>
                                        @endforeach
                                        </select>
                                        <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                    </div>

                                    @if ($errors->has('Tinh')) 
                                        <div class="notiFail" role="alert">{{$errors->first('Tinh')}} </div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Phường</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="Phuong" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            @foreach ($phuong as $item)
                                                <option value="{{$item->id}}">{{$item->DonVi . ' '. $item->TenPhuong}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon">
                                            <i class="fas fa-caret-down"></i>
                                        </div>
                                    </div>
                                    @if ($errors->has('Phuong')) 
                                        <div class="notiFail" role="alert">
                                            {{$errors->first('Phuong')}}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Số điện thoại</p></td>
                                <td>
                                    <input type="text" name="SoDT" value="{{old('SoDT')}}" class="formInput" placeholder="Số điện thoại">
                                    @if ($errors->has('SoDT')) 
                                        <div class="notiFail" role="alert">
                                            {{$errors->first('SoDT')}}
                                        </div>
                                    @endif
                                </td>  
                                 <td><p class="adminFormAddText">Mật khẩu</p></td>
                                <td>
                                    <input type="password" name="MatKhau" class="formInput" placeholder="Mật khẩu">
                                     @if ($errors->has('MatKhau')) 
                                        <div class="notiFail" role="alert">
                                            {{$errors->first('MatKhau')}}
                                        </div>
                                    @endif
                                </td>      

                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submmit" class="adminFormAddBtn">Thêm</button>
                        <a href = "admin/giaovien" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
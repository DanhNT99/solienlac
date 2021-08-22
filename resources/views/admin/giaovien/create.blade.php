@extends('admin/layouts/index')
@section('title') Thêm giáo viên @endsection
@section('adminContent')
    @include('admin/layouts/tab')
    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-user-plus adminBoxTitleIcon mr-1"></i>Thêm giáo viên</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
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
                            <div class="notiFail notiFileImg hide" role="alert">Vui lòng chọn file đúng định dạng ( jpg, jpeg, png, gif )</div>
                            @if ($errors->has('Hinh')) 
                                <div class="notiFail" role="alert"> {{$errors->first('Hinh')}} </div>
                            @endif
                        </div>
                        <input type="file" name = 'Hinh' class="adminFormAddFileImg">
                        <table class="adminFormAddTable">
                            <tr>
                                <th colspan = "2">
                                    <p class = "ml-4">Chú ý: <span class = "iconInput">(*)</span>  là trường bắt buộc nhập.</p>
                                </th>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Mã giáo viên</p></td>
                                <td> <input type="text" name="MaGV" value="{{$text_id}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Họ giáo viên <span class = "iconInput">*</span></p></td>
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
                                <td><p class="adminFormAddText">Tên giáo viên <span class = "iconInput">*</span></p></td>
                                <td>
                                    <input type="text" name="TenGV" value="{{old('TenGV')}}" class="formInput capitalize" placeholder="Tên giáo viên">
                                    @if ($errors->has('TenGV')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('TenGV')}} </div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Giới tính <span class = "iconInput">*</span></p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="GioiTinh" class="formSelect">
                                            <option @if (old('GioiTinh') == 'Nam') selected 
                                                    @endif value="Nam" >Nam</option>
                                            <option @if (old('GioiTinh') == 'Nu') selected 
                                            @endif value="Nu" >Nữ</option>
                                        </select>
                                        <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                    </div>
                                    @if ($errors->has('GioiTinh')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('GioiTinh')}} </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Ngày sinh <span class = "iconInput">*</span></p></td>
                                <td>
                                    <input type="date"  value="{{old('NgaySinh')}}" name="NgaySinh" class="formInput">
                                    @if ($errors->has('NgaySinh')) 
                                        <div class="notiFail" role="alert">  {{$errors->first('NgaySinh')}} </div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Địa chỉ <span class = "iconInput">*</span></p></td>
                                <td>
                                    <input type="text" name="DiaChi" value="{{old('DiaChi')}}" class="formInput capitalize" placeholder="Địa chỉ">
                                    @if ($errors->has('DiaChi')) 
                                        <div class="notiFail" role="alert">  {{$errors->first('DiaChi')}} </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Phường/xã <span class = "iconInput">*</span></p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="Phuong" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            @foreach ($phuong as $item)
                                                <option @if (old('Phuong') == $item->id) selected
                                                        @endif value="{{$item->id}}">{{$item->DonVi . ' '. $item->TenPhuong}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                    @if ($errors->has('Phuong')) 
                                        <div class="notiFail" role="alert">  {{$errors->first('Phuong')}} </div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Số điện thoại <span class = "iconInput">*</span></p></td>
                                <td>
                                    <input type="text" name="SoDT" value="{{old('SoDT')}}" class="formInput" placeholder="Số điện thoại">
                                    @if ($errors->has('SoDT')) 
                                        <div class="notiFail" role="alert">{{$errors->first('SoDT')}}</div>
                                    @endif
                                </td>  
                            </tr>
                            <tr>
                                 <td><p class="adminFormAddText">Mật khẩu <span class = "iconInput">*</span></p></td>
                                <td>
                                    <input type="password" name="MatKhau" class="formInput" placeholder="Mật khẩu">
                                     @if ($errors->has('MatKhau')) 
                                        <div class="notiFail" role="alert">{{$errors->first('MatKhau')}} </div>
                                    @endif
                                </td>      

                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submit" class="px-2 py-1 border-0 rounded modalBtn mr-1">Thực hiện</button>
                        <a href = "admin/giaovien" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
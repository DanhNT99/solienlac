@extends('admin/layouts/index')
@section('title')Chỉnh sửa giáo viên @endsection
@section('adminContent')
    @include('admin/layouts/tab')

    <section class="adminAdd">

        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-edit adminBoxTitleIcon mr-1"></i>Chỉnh sửa giáo viên</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <form action="{{route('giaovien.update','')}}/{{$giaovien->id}}" method = "post" enctype="multipart/form-data" class="adminFormAdd">
                @method('PATCH')   @csrf
                <div class="adminFormAddBox">
                    <div class="adminFormAddContains">
                        <div class="adminFormAddContainsImg wrapImgResize">
                            <div class="wrapImgResize">
                                <img src="{{asset('assets/images')}}/{{$giaovien->Hinh}}" class="adminFormAddImg" alt="ảnh thẻ">
                            </div>
                            <div class="adminFormAddContainsIcon">
                                <p><i class="fas fa-camera-retro"></i> Tải hình</p>
                            </div>
                            <div class="notiFail notiFileImg hide" role="alert">Vui lòng chọn file đúng định dạng ( jpg, jpeg, png, gif )</div>
                            @if ($errors->has('Hinh')) 
                                <div class="notiFail" role="alert">{{$errors->first('Hinh')}}</div>
                            @endif
                        </div>
                        <input type="file" name = "Hinh" class="adminFormAddFileImg">
                        
                        <table class="adminFormAddTable">
                            <tr>
                                <td><p class="adminFormAddText">Mã giáo viên</p></td>
                                <td><input type="text" name="MaGV" value = "{{$giaovien->MaGV}}" class="formInput formInputMa"> </td>
                                <td><p class="adminFormAddText">Họ giáo viên </p></td>
                                <td>
                                    <input type="text" name="HoGV" value = "{{$giaovien->HoGV}}" class="formInput capitalize">
                                    @if ($errors->has('HoGV')) 
                                        <div class="notiFail" role="alert">{{$errors->first('HoGV')}}</div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Tên giáo viên </p></td>
                                <td>
                                    <input type="text" name="TenGV" value = "{{$giaovien->TenGV}}" class="formInput capitalize">
                                    @if ($errors->has('TenGV')) 
                                        <div class="notiFail" role="alert">{{$errors->first('TenGV')}}</div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Giới tính</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="GioiTinh" class="formSelect">
                                            <option @if ($giaovien->GioiTinh == 'Nam') {{$selected = 'selected'}} @endif value="Nam">Nam</option>
                                            <option @if ($giaovien->GioiTinh == 'Nu') {{$selected = 'selected'}} @endif value="Nu">Nữ</option>
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Ngày sinh</p></td>
                                <td><input type="date" name="NgaySinh" value = "{{$giaovien->NgaySinh}}" class="formInput "></td>
                                <td><p class="adminFormAddText">Địa chỉ</p></td>
                                <td>
                                    <input type="text" name="DiaChi" value = "{{$giaovien->DiaChi}}" class="formInput capitalize">
                                    @if ($errors->has('DiaChi')) 
                                        <div class="notiFail" role="alert">{{$errors->first('DiaChi')}}</div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Phường/xã</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="Phuong" id="" class="formSelect">
                                            @foreach ($phuong as $item)
                                                <option @if ($item->id == $giaovien->id_phuong) {{$selected = 'selected'}} 
                                                    @endif value="{{$item->id}}">{{$item->DonVi . ' '. $item->TenPhuong}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                </td>
                                <td><p class="adminFormAddText">Số điện thoại</p></td>
                                <td>
                                    <input type="text" name="SoDT" value = "{{$giaovien->SoDT}}" class="formInput">
                                    @if ($errors->has('SoDT')) 
                                        <div class="notiFail" role="alert">{{$errors->first('SoDT')}}</div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                               
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submit" class="px-2 py-1 border-0 rounded modalBtn mr-1">Thực hiện</button>
                        <a href = "admin/giaovien" class="adminFormAddLink">Quay lại</a>
                    </div>
                
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection
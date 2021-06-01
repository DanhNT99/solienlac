@extends('admin/layouts/index')
@section('title')Chỉnh sửa giáo viên @endsection
@section('adminContent')
    @include('admin/layouts/tab')

    <section class="adminAdd">

        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Thông tin chi tiết giáo viên
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
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
                        </div>
                        <input type="file" name = "Hinh" class="adminFormAddFileImg">
                        
                        <table class="adminFormAddTable">
                            <tr>
                                <td><p class="adminFormAddText">Mã giáo viên</p></td>
                                <td> <input type="text" name="MaGV" value = "{{$giaovien->MaGV}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Họ giáo viên </p></td>
                                <td><input type="text" name="HoGV" value = "{{$giaovien->HoGV}}" class="formInput capitalize"></td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Tên giáo viên </p></td>
                                <td><input type="text" name="TenGV" value = "{{$giaovien->TenGV}}" class="formInput capitalize"></td>
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
                                <td><input type="text" name="DiaChi" value = "{{$giaovien->DiaChi}}" class="formInput capitalize"></td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Phường</p></td>
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
                                    @if ($errors->has('Phuong')) 
                                        <div class="notiFail" role="alert">{{$errors->first('Phuong')}}</div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Tỉnh</p></td>
                                <td><input type="text" value = "{{$giaovien->Phuong->Tinh->TenTinh}}" class="formInput"></td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Số điện thoại</p></td>
                                <td><input type="text" name="SoDT" value = "{{$giaovien->SoDT}}" class="formInput"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submit" class="px-3 py-1 border-0 rounded modalBtn mr-2">Thực hiện</button>
                        <a href = "admin/giaovien" class="adminFormAddLink">Quay lại</a>
                    </div>
                
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection
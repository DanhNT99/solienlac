@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/giaovien/tab')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Thêm giáo viên
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form class = "adminFormAdd">
                    <div class="adminFormAddContains">
                        <div class="adminFormAddContainsImg">
                            <div class="wrapImgResize">
                                <img src="{{asset('assets/images')}}/{{$giaovien->Hinh}}" class="adminFormAddImg" alt="">
                            </div>
                        </div>
                        <table class="adminFormAddTable">
                            <tr>
                                <td><p class="adminFormAddText">Mã giáo viên</p></td>
                                <td> <input  type="text" name="MaGV" value="{{$giaovien->MaGV}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Họ giáo viên</p></td>
                                <td>
                                    <input  type="text" name="HoGV" value="{{$giaovien->HoGV}}"  class="formInput  formInputMa" >
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Tên giáo viên</p></td>
                                <td>
                                    <input  type="text" name="TenGV" value = "{{$giaovien->TenGV}}" class="formInput formInputMa">
                                </td>
                                <td><p class="adminFormAddText">Giới tính</p></td>
                                <td>
                                     <input  type="text" name="NgaySinh" 
                                        value = "@if ($giaovien->GioiTinh == 'Nu') Nữ
                                                @else Nam @endif" class="formInput formInputMa">
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Ngày sinh</p></td>
                                <td>
                                     <input  type="date" name="NgaySinh" value = "{{$giaovien->NgaySinh}}" class="formInput formInputMa">
                                </td>
                                <td><p class="adminFormAddText">Địa chỉ</p></td>
                                <td>
                                    <input  type="text" name="DiaChi" value = "{{$giaovien->DiaChi}}" class="formInput formInputMa">
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Phường</p></td>
                                <td>
                                     <input  type="text" name="DiaChi" value = "{{$giaovien->phuong->TenPhuong}}" class="formInput formInputMa">
                                </td>
                                 <td><p class="adminFormAddText">Tỉnh</p></td>
                                <td>
                                     <input  type="text" name="DiaChi" value = "{{$giaovien->phuong->tinh->TenTinh}}" class="formInput formInputMa">
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Số điện thoại</p></td>
                                <td>
                                    <input  type="text" name="DiaChi" value = "{{$giaovien->SoDT}}" class="formInput formInputMa">
                                </td>    
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <a href = "admin/giaovien" class="adminFormAddLink">Quay lại</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/layouts/tab')

    <section class="adminAdd">

        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Thông tin chi tiết giáo viên
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <form action="{{route('giaovien.destroy', '')}}/{{$giaovien->id}}" method = "post" class="adminFormAdd">
                   @method('DELETE') @csrf
                <div class="adminFormAddBox">
                    <div class="adminFormAddContains">
                        <div class="adminFormAddContainsImg wrapImgResize">
                            <div class="wrapImgResize">
                                <img src="{{asset('assets/images')}}/{{$giaovien->Hinh}}" class="adminFormAddImg" alt="">
                            </div>
                        </div>
                        
                        <table class="adminFormAddTable">
                            <tr>
                                <td><p class="adminFormAddText">Mã giáo viên</p></td>
                                <td> <input type="text" value = "{{$giaovien->MaGV}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Họ và tên</p></td>
                                <td><input type="text" value = "{{$giaovien->HoGV . ' ' . $giaovien->TenGV}}" class="formInput formInputMa"></td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Giới tính</p></td>
                                <td>
                                    @if($giaovien->GioiTinh == 'Nam')
                                        <input type="text" value  = "Nam"  class="formInput formInputMa">
                                    @else
                                        <input type="text" value = "Nữ"  class="formInput formInputMa">
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Ngày sinh</p></td>
                                <td><input type="date" value = "{{$giaovien->NgaySinh}}" class="formInput formInputMa">
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Số điện thoại</p></td>
                                <td><input type="date" value = "{{$giaovien->SoDT}}" class="formInput formInputMa">
                                <td><p class="adminFormAddText">Địa chỉ</p></td>
                                <td><input type="text" value = "{{$giaovien->DiaChi}}" class="formInput formInputMa"></td>
                            </tr>
                            <tr>
                             
                                <td><p class="adminFormAddText">Phường</p></td>
                                <td><input type="text" value = "{{$giaovien->Phuong->TenPhuong}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Tỉnh</p></td>
                                <td><input type="text" value = "{{$giaovien->Phuong->Tinh->TenTinh}}" class="formInput formInputMa"></td>
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
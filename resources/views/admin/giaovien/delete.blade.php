@extends('admin/layouts/index')
@section('title')Xóa giáo viên @endsection

@section('adminContent')
    @include('admin/layouts/tab')

    <section class="adminAdd">

        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-trash adminBoxTitleIcon mr-1"></i>Xóa giáo viên</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <form action="{{route('giaovien.destroy', '')}}/{{$giaovien->id}}" method = "post" class="adminFormAdd">
                   @method('DELETE') @csrf
                <div class="adminFormAddBox">
                    <div class="adminFormAddContains">
                        <div class="adminFormAddContainsImg wrapImgResize">
                            <div class="wrapImgResize">
                                <img src="{{asset('assets/images')}}/{{$giaovien->Hinh}}" class="adminFormAddImg" alt="Ảnh thẻ">
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
                                <td><input type="text" value = "{{$giaovien->SoDT}}" class="formInput formInputMa">
                                <td><p class="adminFormAddText">Địa chỉ</p></td>
                                <td><input type="text" value = "{{$giaovien->DiaChi}}" class="formInput formInputMa"></td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Phường/xã</p></td>
                                <td><input type="text" value = "{{$giaovien->Phuong->TenPhuong}}" class="formInput formInputMa"></td>
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
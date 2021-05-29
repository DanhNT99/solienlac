@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/hocsinh/tab')

    <section class="adminAdd">

        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Thông tin chi tiết học sinh
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <form action="{{route('hocsinh.destroy', '')}}/{{$hocsinh->id}}" method = "post" class="adminFormAdd">
                   @method('DELETE') @csrf
                <div class="adminFormAddBox">
                    <div class="adminFormAddContains">
                        <div class="adminFormAddContainsImg wrapImgResize">
                            <div class="wrapImgResize">
                                <img src="{{asset('assets/images')}}/{{$hocsinh->Hinh}}" class="adminFormAddImg" alt="">
                            </div>
                        </div>
                        
                        <table class="adminFormAddTable">
                            <tr>
                                <td><p class="adminFormAddText">Khối</p></td>
                                <td><input type="text" value = "{{$hocsinh->Hoc->Lop->Khoi->TenKhoi}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Lớp</p></td>
                                <td><input type="text" value = "{{$hocsinh->Hoc->Lop->TenLop}}" class="formInput formInputMa"></td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Mã học sinh</p></td>
                                <td> <input type="text" value = "{{$hocsinh->MaHS}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Họ và tên</p></td>
                                <td><input type="text" value = "{{$hocsinh->HoHS . ' ' . $hocsinh->TenHS}}" class="formInput formInputMa"></td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Giới tính</p></td>
                                <td>
                                    @if($hocsinh->GioiTinh == 'Nam')
                                        <input type="text" value  = "Nam"  class="formInput formInputMa">
                                    @else
                                        <input type="text" value = "Nữ"  class="formInput formInputMa">
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Ngày sinh</p></td>
                                <td><input type="date" value = "{{$hocsinh->NgaySinh}}" class="formInput formInputMa">
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Địa chỉ</p></td>
                                <td><input type="text" value = "{{$hocsinh->DiaChi}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Phường</p></td>
                                <td><input type="text" value = "{{$hocsinh->Phuong->TenPhuong}}" class="formInput formInputMa"></td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Tỉnh</p></td>
                                <td><input type="text" value = "{{$hocsinh->Phuong->Tinh->TenTinh}}" class="formInput formInputMa"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="">
                        <p class="adminFormTitle">Thông tin phụ huynh</p>
                        <table class="adminFormAddTable mx-auto">
                            <tr>
                                @foreach ($hocsinh->ChiTietGiaDinh as $item)
                                    @if ($item->Phuhuynh->GioiTinh == 'Nam')
                                        <td><p class="adminFormAddText">Họ tên Cha</p></td>
                                        <td><input type="text" value="{{$item->PhuHuynh->HoTenPH}}" class="formInput formInputMa">
                                    @else
                                        <td><p class="adminFormAddText">Họ tên Me</p></td>
                                        <td><input type="text" value="{{$item->PhuHuynh->HoTenPH}}" class="formInput formInputMa">
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($hocsinh->ChiTietGiaDinh as $item)
                                    @if ($item->Phuhuynh->GioiTinh == 'Nam')
                                    <td><p class="adminFormAddText">Giới tính</p></td>
                                    <td><input type="text" value = "Nam" class="formInput formInputMa"></td>
                                    @else
                                        <td><p class="adminFormAddText">Giới tính</p></td>
                                        <td><input type="text" value = "Nữ" class="formInput formInputMa"></td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($hocsinh->ChiTietGiaDinh as $item)
                                    @if ($item->Phuhuynh->GioiTinh == 'Nam')
                                        <td><p class="adminFormAddText">Nghề nghiệp</p></td>
                                        <td><input type="text" value="{{$item->PhuHuynh->NgheNghiep}}" class="formInput formInputMa">
                                    @else
                                        <td><p class="adminFormAddText">Nghề nghiệp</p></td>
                                        <td><input type="text" value="{{$item->PhuHuynh->NgheNghiep}}" class="formInput formInputMa">
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($hocsinh->ChiTietGiaDinh as $item)
                                    @if ($item->Phuhuynh->GioiTinh == 'Nam')
                                        <td><p class="adminFormAddText">Nơi làm việc</p></td>
                                        <td><input type="text" value="{{$item->PhuHuynh->NoiLamViec}}" class="formInput formInputMa">
                                    @else
                                        <td><p class="adminFormAddText">Nơi làm việc</p></td>
                                        <td><input type="text" value="{{$item->PhuHuynh->NoiLamViec}}" class="formInput formInputMa">
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($hocsinh->ChiTietGiaDinh as $item)
                                    @if ($item->Phuhuynh->GioiTinh == 'Nam')
                                        <td><p class="adminFormAddText">Số điện thoại</p></td>
                                        <td><input type="text" value="{{$item->PhuHuynh->SoDT}}" class="formInput formInputMa">
                                    @else
                                        <td><p class="adminFormAddText">Số điện thoại</p></td>
                                        <td><input type="text" value="{{$item->PhuHuynh->SoDT}}" class="formInput formInputMa">
                                    @endif
                                @endforeach
                               
                            </tr>
                            
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submit" class="px-3 py-1 border-0 rounded modalBtn mr-2">Thực hiện</button>
                        <a href = "admin/hocsinh" class="adminFormAddLink">Quay lại</a>
                    </div>
                
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection
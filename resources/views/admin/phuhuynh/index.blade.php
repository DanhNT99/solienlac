@extends('admin/layouts/index')

@section('adminContent')

    <section class="adminAdd">
        <div class="container mt-3">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Thông tin Phu huynh
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <form action="" class="adminFormAdd">
                <div class="adminFormAddBox">
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
            </form>
        </div>
    </section>
   

    <section class="adminAdd">
            @foreach ($ctgd as $item)
             <div class="container mt-3">
                <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Thông tin học sinh
                    <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
                    <a href="phuhuynh/ketquahoctap/{{$item->HocSinh->id}}">kqht</a>
                </h3>
                <form action="" class="adminFormAdd">
                    <div class="adminFormAddBox">
                            <div class="adminFormAddContains">
                                <div class="adminFormAddContainsImg wrapImgResize">
                                    <div class="wrapImgResize">
                                        <img src="{{asset('assets/images')}}/{{$item->HocSinh->Hinh}}" class="adminFormAddImg" alt="">
                                    </div>
                                </div>
                                
                                <table class="adminFormAddTable">
                                    <tr>
                                        <td><p class="adminFormAddText">Khối</p></td>
                                        <td><input type="text" value = "{{$item->HocSinh->Hoc->Lop->Khoi->TenKhoi}}" class="formInput formInputMa"></td>
                                        <td><p class="adminFormAddText">Lớp</p></td>
                                        <td><input type="text" value = "{{$item->HocSinh->Hoc->Lop->TenLop}}" class="formInput formInputMa"></td>
                                    </tr>
                                    <tr>
                                        <td><p class="adminFormAddText">Mã học sinh</p></td>
                                        <td> <input type="text" value = "{{$item->HocSinh->MaHS}}" class="formInput formInputMa"></td>
                                        <td><p class="adminFormAddText">Họ và tên</p></td>
                                        <td><input type="text" value = "{{$item->HocSinh->HoHS . ' ' . $item->HocSinh->TenHS}}" class="formInput formInputMa"></td>
                                    </tr>
                                    <tr>
                                        <td><p class="adminFormAddText">Giới tính</p></td>
                                        <td><input type="text" value = "{{$item->HocSinh->GioiTinh}}" class="formInput formInputMa"></td>
                                        <td><p class="adminFormAddText">Ngày sinh</p></td>
                                        <td><input type="date" value = "{{$item->HocSinh->NgaySinh}}" class="formInput">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><p class="adminFormAddText">Địa chỉ</p></td>
                                        <td><input type="text" value = "{{$item->HocSinh->DiaChi}}" class="formInput formInputMa"></td>
                                        <td><p class="adminFormAddText">Phường</p></td>
                                        <td><input type="text" value = "{{$item->HocSinh->Phuong->TenPhuong}}" class="formInput formInputMa"></td>
                                    </tr>
                                    <tr>
                                        <td><p class="adminFormAddText">Tỉnh</p></td>
                                        <td><input type="text" value = "{{$item->HocSinh->Phuong->Tinh->TenTinh}}" class="formInput formInputMa"></td>
                                    </tr>
                                </table>
                            </div>
                    </div>
                </form>
                </div>

            @endforeach
        </div>
    </section>
@endsection

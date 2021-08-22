@extends('admin/layouts/index')
@section('title') Xem thông tin học sinh @endsection
@section('adminContent')

    <section class="adminAdd">
        <div class="container mt-3">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-user adminBoxTitleIcon mr-1"></i>Thông tin phụ huynh</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <form action="" class="adminFormAdd">
                <div class="adminFormAddBox">
                    <table class="adminFormAddTable mx-auto">
                        <tr>
                            @foreach ($hocsinh->ChiTietGiaDinh as $item)
                                @if ($item->Phuhuynh->GioiTinh == 'Nam')
                                    <td><p class="adminFormAddText">Họ tên cha</p></td>
                                    <td><input type="text" value="{{$item->PhuHuynh->HoTenPH}}" class="formInput formInputMa">
                                @else
                                    <td><p class="adminFormAddText">Họ tên mẹ</p></td>
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
                <div class="adminBoxTitle py-1 px-2">
                    <h6 class = "m-0"><i class="fas fa-user adminBoxTitleIcon mr-1"></i>Thông tin học sinh</h6>
                    <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
                </div>
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
                                    <td><input type="text" 
                                        @if (count($item->HocSinh->Hoc->where('id_nienkhoa', $nienkhoa->id)))
                                            value = "{{$item->HocSinh->Hoc->where('id_nienkhoa', $nienkhoa->id)->first()->Lop->Khoi->TenKhoi}}"
                                        @else value = ""  @endif class="formInput formInputMa">
                                    </td>
                                    <td><p class="adminFormAddText">Lớp</p></td>
                                    <td><input type="text" 
                                        @if (count($item->HocSinh->Hoc->where('id_nienkhoa', $nienkhoa->id)))
                                            value = "{{$item->HocSinh->Hoc->where('id_nienkhoa', $nienkhoa->id)->first()->Lop->TenLop}}"
                                        @else value = ""  @endif class="formInput formInputMa">
                                    </td>
                                   
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
                                    <td><p class="adminFormAddText">GVCN</p></td>
                                    <td>
                                        @if (count($item->HocSinh->Hoc->where('id_nienkhoa', $nienkhoa->id)))
                                        <input type="text" value = "{{
                                            $item->HocSinh->Hoc->where('id_nienkhoa', $nienkhoa->id)->first()->Lop->Gvcn->HoGV . ' ' .  
                                            $item->HocSinh->Hoc->where('id_nienkhoa', $nienkhoa->id)->first()->Lop->Gvcn->TenGV}}" class="formInput formInputMa">
                                        @else
                                        <input type="text" value = "" class="formInput formInputMa">
                                        @endif
                                    </td>
                                    <td><p class="adminFormAddText">Số điện thoại GVCN</p></td>
                                    <td>
                                        @if (count($item->HocSinh->Hoc->where('id_nienkhoa', $nienkhoa->id)))
                                        <input type="text" value = "{{
                                            $item->HocSinh->Hoc->where('id_nienkhoa', $nienkhoa->id)->first()->Lop->Gvcn->SoDT}}"
                                             class="formInput formInputMa">
                                        @else
                                        <input type="text" value = "" class="formInput formInputMa">
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="text-center mt-4">
                            <a href="phuhuynh/ketquahoctap/{{$item->HocSinh->id}}" class="px-3 py-1 border-0 rounded modalBtn mr-2">
                                Xem kết quả học tập</a>
                        </div>
                    </div>
                </form>
                </div>

            @endforeach
        </div>
    </section>
@endsection

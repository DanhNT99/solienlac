@extends('admin/layouts/index')
@section('title')Chỉnh sửa học sinh @endsection
@section('adminContent')
    @include('admin/layouts/tab')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Thông tin chi tiết học sinh
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <form action="{{route('hocsinh.update','')}}/{{$hocsinh->id}}" method = "post" enctype="multipart/form-data" class="adminFormAdd">
                @method('PATCH')   @csrf
                <div class="adminFormAddBox">
                    <div class="adminFormAddContains">
                        <div class="adminFormAddContainsImg wrapImgResize">
                            <div class="wrapImgResize">
                                <img src="{{asset('assets/images')}}/{{$hocsinh->Hinh}}" class="adminFormAddImg" alt="ảnh thẻ">
                            </div>
                            <div class="adminFormAddContainsIcon">
                                <p><i class="fas fa-camera-retro"></i> Tải hình</p>
                            </div>
                        </div>
                        <input type="file" name = "Hinh" class="adminFormAddFileImg">
                        
                        <table class="adminFormAddTable">
                            {{-- <tr>
                                <td class=""><p class="adminFormAddText">Khối</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="Khoi" id="khoi" class="formSelect">
                                            <option selected disabled value="">Lựa chọn</option>
                                            @foreach ($khoi as $item)
                                                @if ($hocsinh->Hoc)
                                                    <option @if ($hocsinh->Hoc->Lop->Khoi->id == $item->id) 
                                                        {{$selected = 'selected'}}
                                                    @endif value="{{$item->id}}">{{$item->TenKhoi}}</option>
                                                @else
                                                    <option  value="{{$item->id}}">{{$item->TenKhoi}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon">
                                            <i class="fas fa-caret-down"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class=""><p class="adminFormAddText">Lop</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="Lop" id="lop" class="formSelect">
                                            <option selected disabled value="">Lựa chọn</option>
                                            @foreach ($lop as $item)
                                            @if ($hocsinh->Hoc)
                                                <option @if ($hocsinh->Hoc->Lop->id == $item->id) selected @endif class = "formBoxSelectOption" value="{{$item->id}}">{{$item->TenLop}}</option>
                                            @else
                                                <option class = "formBoxSelectOption" value="{{$item->id}}">{{$item->TenLop}}</option>
                                            @endif
                                              
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon">
                                            <i class="fas fa-caret-down"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr> --}}
                            <tr>
                                <td><p class="adminFormAddText">Mã học sinh</p></td>
                                <td> <input type="text" name="MaHS" value = "{{$hocsinh->MaHS}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Họ học sinh </p></td>
                                <td><input type="text" name="HoHS" value = "{{$hocsinh->HoHS}}" class="formInput capitalize"></td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Tên học sinh </p></td>
                                <td><input type="text" name="TenHS" value = "{{$hocsinh->TenHS}}" class="formInput capitalize"></td>
                                <td><p class="adminFormAddText">Giới tính</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="GioiTinh" class="formSelect">
                                            <option @if ($hocsinh->GioiTinh == 'Nam') 
                                                {{$selected = 'selected'}}
                                            @endif value="Nam">Nam</option>
                                            <option @if ($hocsinh->GioiTinh == 'Nu') 
                                                {{$selected = 'selected'}} 
                                                @endif value="Nu">Nữ</option>
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Ngày sinh</p></td>
                                <td><input type="date" name="NgaySinh" value = "{{$hocsinh->NgaySinh}}" class="formInput "></td>
                                <td><p class="adminFormAddText">Địa chỉ</p></td>
                                <td><input type="text" name="DiaChi" value = "{{$hocsinh->DiaChi}}" class="formInput capitalize"></td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Phường</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="Phuong" id="" class="formSelect">
                                            @foreach ($phuong as $item)
                                                <option @if ($item->id == $hocsinh->id_phuong) 
                                                    {{$selected = 'selected'}} 
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
                                <td><input type="text" value = "{{$hocsinh->Phuong->Tinh->TenTinh}}" class="formInput "></td>
                            </tr>
                        </table>
                    </div>
                    <div class="">
                        <p class="adminFormTitle">Thông tin phụ huynh</p>
                        <table class="adminFormAddTable mx-auto">
                            <tr class="d-none">
                                @foreach ($hocsinh->ChiTietGiaDinh as $item)
                                    @if ($item->Phuhuynh->GioiTinh == 'Nam')
                                        <td><p class="adminFormAddText">Mã PH</p></td>
                                        <td><input type="text" name="MaPH[]" value="{{$item->PhuHuynh->MaPH}}" class="formInput capitalize">
                                    @else
                                        <td><p class="adminFormAddText">Họ tên Me</p></td>
                                        <td><input type="text" name="MaPH[]" value="{{$item->PhuHuynh->MaPH}}" class="formInput capitalize ">
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($hocsinh->ChiTietGiaDinh as $item)
                                    @if ($item->Phuhuynh->GioiTinh == 'Nam')
                                        <td><p class="adminFormAddText">Họ tên Cha</p></td>
                                        <td><input type="text" name="HoTenPH[]" value="{{$item->PhuHuynh->HoTenPH}}" class="formInput capitalize">
                                    @else
                                        <td><p class="adminFormAddText">Họ tên Me</p></td>
                                        <td><input type="text" name="HoTenPH[]" value="{{$item->PhuHuynh->HoTenPH}}" class="formInput capitalize">
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($hocsinh->ChiTietGiaDinh as $item)
                                    @if ($item->Phuhuynh->GioiTinh == 'Nam')
                                    <td><p class="adminFormAddText">Giới tính</p></td>
                                    <td>
                                        <div class="formBoxSelect">
                                            <select name="GioiTinhPH[]" class="formSelect">
                                                <option selected value="Nam">Nam</option>
                                                <option value="Nu">Nữ</option> 
                                             </select>
                                            <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                        </div>
                                    </td>
                                    @else 
                                    <td><p class="adminFormAddText">Giới tính</p></td>
                                    <td>
                                        <div class="formBoxSelect">
                                            <select name="GioiTinhPH[]" class="formSelect">
                                                <option value="Nam">Nam</option>
                                                <option selected value="Nu">Nữ</option> 
                                             </select>
                                            <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                        </div>
                                    </td>
                                    @endif
                                
                                @endforeach
                               
                                {{-- @foreach ($hocsinh->ChiTietGiaDinh as $item)
                                    @if ($item->Phuhuynh->GioiTinh == 'Nam')
                                    <td><p class="adminFormAddText">Giới tính</p></td>
                                    <td><input type="text" value = "Nam" class="formInput "></td>
                                    @else
                                        <td><p class="adminFormAddText">Giới tính</p></td>
                                        <td><input type="text" value = "Nữ" class="formInput "></td>
                                    @endif
                                @endforeach --}}
                            </tr>
                            <tr>
                                @foreach ($hocsinh->ChiTietGiaDinh as $item)
                                    @if ($item->Phuhuynh->GioiTinh == 'Nam')
                                        <td><p class="adminFormAddText">Nghề nghiệp</p></td>
                                        <td><input type="text" name="NgheNghiep[]" value="{{$item->PhuHuynh->NgheNghiep}}" class="formInput ">
                                    @else
                                        <td><p class="adminFormAddText">Nghề nghiệp</p></td>
                                        <td><input type="text" name="NgheNghiep[]" value="{{$item->PhuHuynh->NgheNghiep}}" class="formInput ">
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($hocsinh->ChiTietGiaDinh as $item)
                                    @if ($item->Phuhuynh->GioiTinh == 'Nam')
                                        <td><p class="adminFormAddText">Nơi làm việc</p></td>
                                        <td><input type="text" name="NoiLamViec[]" value="{{$item->PhuHuynh->NoiLamViec}}" class="formInput ">
                                    @else
                                        <td><p class="adminFormAddText">Nơi làm việc</p></td>
                                        <td><input type="text" name="NoiLamViec[]" value="{{$item->PhuHuynh->NoiLamViec}}" class="formInput ">
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($hocsinh->ChiTietGiaDinh as $item)
                                    @if ($item->Phuhuynh->GioiTinh == 'Nam')
                                        <td><p class="adminFormAddText">Số điện thoại</p></td>
                                        <td><input type="text" name="SoDT[]" value="{{$item->PhuHuynh->SoDT}}" class="formInput NumberPhone">
                                        <div class="notiFail hide" role="alert"></div>
                                    @else
                                        <td><p class="adminFormAddText">Số điện thoại</p></td>
                                        <td><input type="text" name="SoDT[]" value="{{$item->PhuHuynh->SoDT}}" class="formInput NumberPhone">
                                        <div class="notiFail hide" role="alert"></div>
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
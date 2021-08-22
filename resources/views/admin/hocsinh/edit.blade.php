@extends('admin/layouts/index')
@section('title')Chỉnh sửa học sinh @endsection
@section('adminContent')
@if (Auth::guard('giao_vien')->user()->hasrole('Giáo viên chủ nhiệm'))
@include('admin/layouts/tab')
@endif
@if (Auth::guard('giao_vien')->user()->hasrole('Quản trị viên'))
@include('admin/hocsinh/tab')
@endif
    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-edit adminBoxTitleIcon mr-1"></i>Chỉnh sửa thông tin học sinh</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <form action="{{route('hocsinh.update','')}}/{{$hocsinh->id}}" method = "post" enctype="multipart/form-data" class="adminFormAdd">
                @method('PATCH') @csrf
                <div class="adminFormAddBox">
                    <div class="adminFormAddContains">
                        <div class="adminFormAddContainsImg wrapImgResize">
                            <div class="wrapImgResize">
                                <img src="{{asset('assets/images')}}/{{$hocsinh->Hinh}}" class="adminFormAddImg" alt="ảnh thẻ">
                        </div>
                            <div class="adminFormAddContainsIcon">
                                <p><i class="fas fa-camera-retro"></i> Tải hình</p>
                            </div>
                            <div class="notiFail notiFileImg hide" role="alert">Vui lòng chọn file đúng định dạng ( jpg, jpeg, png, gif )</div>
                        </div>
                        
                        <input type="file" name = "Hinh" class="adminFormAddFileImg">
                        <table class="adminFormAddTable">
                            <tr>
                                <td><p class="adminFormAddText">Mã học sinh</p></td>
                                <td>
                                    <input type="text" name="MaHS" value = "{{$hocsinh->MaHS}}" class="formInput formInputMa">
                                </td>
                                <td><p class="adminFormAddText">Họ học sinh </p></td>
                                <td>
                                    <input type="text" name="HoHS" value = "{{$hocsinh->HoHS}}" class="formInput capitalize">
                                    @if ($errors->has('HoHS')) 
                                        <div class="notiFail" role="alert">{{$errors->first('HoHS')}}</div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Tên học sinh </p></td>
                                <td>
                                    <input type="text" name="TenHS" value = "{{$hocsinh->TenHS}}" class="formInput capitalize">
                                    @if ($errors->has('TenHS')) 
                                        <div class="notiFail" role="alert">{{$errors->first('TenHS')}}</div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Giới tính</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="GioiTinh" class="formSelect">
                                            <option @if ($hocsinh->GioiTinh == 'Nam') {{$selected = 'selected'}} @endif value="Nam">Nam</option>
                                            <option @if ($hocsinh->GioiTinh == 'Nu')  {{$selected = 'selected'}} @endif value="Nu">Nữ</option>
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                    @if ($errors->has('GioiTinh')) 
                                        <div class="notiFail" role="alert">{{$errors->first('GioiTinh')}}</div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Ngày sinh</p></td>
                                <td>
                                    <input type="date" name="NgaySinh" value = "{{$hocsinh->NgaySinh}}" class="formInput">
                                    @if ($errors->has('NgaySinh')) 
                                        <div class="notiFail" role="alert">{{$errors->first('NgaySinh')}}</div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Địa chỉ</p></td>
                                <td>
                                    <input type="text" name="DiaChi" value = "{{$hocsinh->DiaChi}}" class="formInput capitalize">
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
                            </tr>
                        </table>
                    </div>
                    <div class="">
                        <p class="adminFormTitle">Thông tin phụ huynh</p>
                        @if (count($hocsinh->ChiTietGiaDinh))
                        <table class="adminFormAddTable mx-auto">
                            <tr class="d-none">
                                @foreach ($hocsinh->ChiTietGiaDinh as $item)
                                    @if ($item->Phuhuynh->GioiTinh == 'Nam')
                                        <td><p class="adminFormAddText">Mã PH</p></td>
                                        <td>
                                            <input type="text" name="MaPH[cha]" value="{{$item->PhuHuynh->MaPH}}" class="formInput capitalize">
                                        </td>
                                    @else
                                        <td><p class="adminFormAddText">Mã PH</p></td>
                                        <td><input type="text" name="MaPH[me]" value="{{$item->PhuHuynh->MaPH}}" class="formInput capitalize "></td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($hocsinh->ChiTietGiaDinh as $item)
                                    @if ($item->Phuhuynh->GioiTinh == 'Nam')
                                        <td><p class="adminFormAddText">Họ tên cha</p></td>
                                        <td>
                                            <input type="text" name="HoTen[cha]" value="{{$item->PhuHuynh->HoTenPH}}" class="formInput capitalize">
                                            @if ($errors->has('HoTen.cha')) 
                                                <div class="notiFail" role="alert">{{$errors->first('HoTen.cha')}}</div>
                                            @endif
                                        </td>
                                    @else
                                        <td><p class="adminFormAddText">Họ tên mẹ</p></td>
                                        <td>
                                            <input type="text" name="HoTen[me]" value="{{$item->PhuHuynh->HoTenPH}}" class="formInput capitalize">
                                            @if ($errors->has('HoTen.me')) 
                                                <div class="notiFail" role="alert">{{$errors->first('HoTen.me')}}</div>
                                            @endif
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr class = "d-none">
                                @foreach ($hocsinh->ChiTietGiaDinh as $item)
                                    @if ($item->Phuhuynh->GioiTinh == 'Nam')
                                    <td><p class="adminFormAddText">Giới tính</p></td>
                                    <td>
                                        <div class="formBoxSelect">
                                            <select name="GioiTinhPH[cha]" class="formSelect">
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
                                            <select name="GioiTinhPH[me]" class="formSelect">
                                                <option value="Nam">Nam</option>
                                                <option selected value="Nu">Nữ</option> 
                                             </select>
                                            <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                        </div>
                                    </td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($hocsinh->ChiTietGiaDinh as $item)
                                    @if ($item->Phuhuynh->GioiTinh == 'Nam')
                                        <td><p class="adminFormAddText">Nghề nghiệp</p></td>
                                        <td>
                                            <input type="text" name="NgheNghiep[cha]" value="{{$item->PhuHuynh->NgheNghiep}}" class="formInput">
                                            @if ($errors->has('NgheNghiep.cha')) 
                                                <div class="notiFail" role="alert">{{$errors->first('NgheNghiep.cha')}}</div>
                                            @endif
                                        </td>
                                    @else
                                        <td><p class="adminFormAddText">Nghề nghiệp</p></td>
                                        <td>
                                            <input type="text" name="NgheNghiep[me]" value="{{$item->PhuHuynh->NgheNghiep}}" class="formInput">
                                            @if ($errors->has('NgheNghiep.me')) 
                                                <div class="notiFail" role="alert">{{$errors->first('NgheNghiep.me')}}</div>
                                            @endif
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($hocsinh->ChiTietGiaDinh as $item)
                                    @if ($item->Phuhuynh->GioiTinh == 'Nam')
                                        <td><p class="adminFormAddText">Nơi làm việc</p></td>
                                        <td>
                                            <input type="text" name="NoiLamViec[cha]" value="{{$item->PhuHuynh->NoiLamViec}}" class="formInput">
                                            @if ($errors->has('NoiLamViec.cha')) 
                                                <div class="notiFail" role="alert">{{$errors->first('NoiLamViec.cha')}}</div>
                                            @endif
                                        </td>
                                    @else
                                        <td><p class="adminFormAddText">Nơi làm việc</p></td>
                                        <td>
                                            <input type="text" name="NoiLamViec[me]" value="{{$item->PhuHuynh->NoiLamViec}}" class="formInput">
                                            @if ($errors->has('NoiLamViec.me')) 
                                                <div class="notiFail" role="alert">{{$errors->first('NoiLamViec.me')}}</div>
                                            @endif
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($hocsinh->ChiTietGiaDinh as $item)
                                    @if ($item->Phuhuynh->GioiTinh == 'Nam')
                                        <td><p class="adminFormAddText">Số điện thoại</p></td>
                                        <td>
                                            <input type="text" name="SoDT[cha]" value="{{$item->PhuHuynh->SoDT}}" class="formInput">
                                            @if ($errors->has('SoDT.cha')) 
                                                <div class="notiFail" role="alert">{{$errors->first('SoDT.cha')}}</div>
                                            @endif
                                        </td>
                                  
                                    @else
                                        <td><p class="adminFormAddText">Số điện thoại</p></td>
                                        <td>
                                            <input type="text" name="SoDT[me]" value="{{$item->PhuHuynh->SoDT}}" class="formInput">
                                            @if ($errors->has('SoDT.me')) 
                                                <div class="notiFail" role="alert">{{$errors->first('SoDT.me')}}</div>
                                            @endif
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                        </table>
                        @else
                        <table class="adminFormAddTable mx-auto">
                            <tr>
                                <td colspan="4">Không có dữ liệu</td>
                            </tr>
                        </table>
                        @endif
                    <div class="adminFormAddGroup">
                        <button type="submit" class="px-2 py-1 border-0 rounded modalBtn mr-2">Thực hiện</button>
                        <a href = "admin/hocsinh" class="adminFormAddLink">Quay lại</a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection
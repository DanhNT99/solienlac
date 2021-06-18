@extends('admin/layouts/index')
@section('title') Học sinh @endsection
@section('adminContent')
    @include('admin/hocsinh/tab')
    <div class="container mt-2">
        <div class="adminBoxTitle py-1 px-2" style="width: fit-content;">
            <div>
                <span>Năm học : {{$nienkhoa->NamBatDau . ' - ' . $nienkhoa->NamKetThuc}}</span>
                <span class="mx-2">|</span>
                <span>

                    @foreach ($nienkhoa->HocKy as $item)
                        @if ($item->TrangThai) {{$item->TenHK}}@endif
                     @endforeach
                </span>
                @if (Auth::guard('giao_vien')->user()->hasrole('Giáo viên chủ nhiệm'))
                <span class="mx-2">|</span>
                <span>
                    Lớp: {{Auth::guard('giao_vien')->user()->Lop->TenLop}}
                </span>
                @endif
            </div>
        </div>
    </div>
    <section class="adminForm pt-1">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-search-plus adminBoxTitleIcon"></i> Tìm kiếm thông tin học sinh</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            
            <div class="adminContainsFormSearch">
                <form action="{{route('searchStudent')}}" class="adminFormSearch" method = "get">
                    <table class="adminFormSeachTable">
                        @if (Auth::guard('giao_vien')->user()->hasrole('Quản trị viên'))
                        
                        @endif
                        <tr>
                            <td><p class="adminFormSearchText">Giới Tính</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="GioiTinh" class="formSelect">
                                        <option selected disabled>Lựa chọn</option>
                                        <option value="Nam">Nam</option>
                                        <option value="Nu">Nữ</option>
                                    </select>
                                    <div class="formSelectIcon">
                                        <i class="fas fa-caret-down"></i>
                                    </div>
                                </div>
                            </td>
                            <td><p class="adminFormSearchText">Phường</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="Phuong" id="" class="formSelect">
                                        <option selected disabled>Lựa chọn</option>
                                        @foreach ($phuong as $item)
                                            <option value="{{$item->id}}">{{$item->DonVi . ' '. $item->TenPhuong}}</option>
                                        @endforeach
                                    </select>
                                    <div class="formSelectIcon">
                                        <i class="fas fa-caret-down"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><p class="adminFormSearchText">Mã học sinh</p></td>
                            <td>                 
                                <input type="text" name="MaHS" class="formInput" placeholder="Mã học sinh..." id="">
                            </td>
                            <td><p class="adminFormSearchText">Tên học sinh</p></td>
                            <td><input type="text" name="TenHS" class="formInput" placeholder="Họ và tên..." id=""></td>
                        </tr>
                    </table>
                    <div class="adminFormSearchContainsBtn">
                        <button class="adminFormSearchBtn">Tìm kiếm</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle mb-0">Danh sách học sinh</h3>
            <div class="adminActive">
                @if (Auth::guard('giao_vien')->user()->hasrole('Quản trị viên'))
                    <a href="admin/hocsinh/create" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Thêm</a>
                @endif
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã học sinh</th>
                    <th>Họ và tên</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Địa chỉ</th>
                    <th>Chọn</th>
                </tr>
                @foreach ($hocsinh as $item)
                    <tr>
                        <td>{{$stt++}}</td>
                        <td>{{$item->MaHS}}</td>
                        <td>{{$item->HoHS . ' ' . $item->TenHS}}</td>
                        <td>@if ($item->GioiTinh == 'Nu') Nữ
                            @else Nam @endif</td>
                        <td>{{$item->NgaySinh}}</td>
                        <td>{{$item->DiaChi}}</td>
                        <td>
                            <a href="admin/hocsinh/{{$item->id}}"><i class="fas fa-info-circle"></i></a>
                            <a href="admin/hocsinh/{{$item->id}}/edit"><i class="fas fa-edit"></i></a>
                            @if (Auth::guard('giao_vien')->user()->hasrole('Quản trị viên'))
                                <a href="admin/hocsinh/{{$item->id}}/delete"><i class="fas fa-trash"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </section>

    @if (Session::has('noti'))
        <div class="notiBox">
        <h4 class="notiBoxTitle">Thông báo <button class="notiBoxBtn"><i class="far fa-window-close"></i></button></h4>
        <p class="notiBoxContent"> {{Session('noti')}}!</p>
        </div>
    @endif
@endsection
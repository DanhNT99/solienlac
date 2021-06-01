@extends('admin/layouts/index')
@section('title')Tìm kiếm học sinh @endsection
@section('adminContent')
    @include('admin/layouts/tab')
    <section class="adminForm">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-search-plus adminBoxTitleIcon"></i>
                Tìm kiếm thông tin học sinh
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span></h3>
            <div class="adminContainsFormSearch">
                <form action="{{route('searchStudent')}}" class="adminFormSearch" method = "get">
                    <table class="adminFormSeachTable">
                        <tr>
                            <td><p class="adminFormSearchText">Khối</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="Khoi" id="khoi" class="formSelect">
                                        <option selected disabled>Lựa chọn</option>
                                        @foreach ($khoi as $item)
                                             <option @if ($item->id == $idKhoi) selected
                                             @endif value="{{$item->id}}">{{$item->TenKhoi}}</option>
                                        @endforeach
                                    </select>
                                    <div class="formSelectIcon">
                                        <i class="fas fa-caret-down"></i>
                                    </div>
                                </div>
                            </td>
                            <td><p class="adminFormSearchText">Lớp</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="Lop" id="lop" class="formSelect">
                                        <option selected disabled>Lựa chọn</option>
                                        @foreach ($lop as $item)
                                             <option class="formBoxSelectOption" @if ($item->id == $idLop) selected @endif value="{{$item->id}}">{{$item->TenLop}}</option>
                                        @endforeach
                                    </select>
                                    <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><p class="adminFormSearchText">Giới Tính</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="Lop" id="" class="formSelect">
                                        <option selected disabled>Lựa chọn</option>
                                        <option @if ($gioitinh == 'Nam') selected @endif value="Nam">Nam</option>
                                        <option @if ($gioitinh == 'Nu') selected @endif value="Nu">Nữ</option>
                                    </select>
                                    <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                </div>
                            </td>
                            <td><p class="adminFormSearchText">Phường</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="Phuong" id="" class="formSelect">
                                        <option selected disabled>Lựa chọn</option>
                                        @foreach ($phuong as $item)
                                            <option @if ($item->id == $idPhuong) selected @endif value="{{$item->id}}">{{$item->TenPhuong}}</option>
                                        @endforeach
                                    </select>
                                    <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><p class="adminFormSearchText">Mã học sinh</p></td>
                            <td>                 
                                <input type="text" name="MaHS" value="{{$MaHS}}" class="formInput" placeholder="Mã học sinh..." id="">
                            </td>
                            <td><p class="adminFormSearchText">Tên học sinh</p></td>
                            <td><input type="text" name="TenHS" value="{{$TenHS}}" class="formInput" placeholder="Họ và tên..." id=""></td>
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
            <h3 class="adminListTitle">Danh sách học sinh</h3>
            <div class="adminActive">
                <a href="admin/hocsinh" class="adminActiveItem"><i class="fas fa-undo-alt"></i> Quay lại</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã học sinh</th>
                    <th>Họ và tên</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Lớp</th>
                    <th>Địa chỉ</th>
                    <th>Chọn</th>
                </tr>
                    @if (count($hocsinh))
                        @foreach ($hocsinh as $item)
                        <tr>
                            <td>{{$stt++}}</td>
                            <td>{{$item->MaHS}}</td>
                            <td>{{$item->HoHS . ' ' . $item->TenHS}}</td>
                            <td>@if ($item->GioiTinh == 'Nu') Nữ
                                @else Nam @endif</td>
                            <td>{{$item->NgaySinh}}</td>
                            <td>{{'Lớp ' . $item->TenLop}}</td>
                            <td>{{$item->DiaChi}}</td>
                            <td>
                                <a href="admin/hocsinh/{{$item->id_hocsinh}}"><i class="fas fa-info-circle"></i></a>
                                <a href="admin/hocsinh/{{$item->id_hocsinh}}/edit"><i class="fas fa-edit"></i></a>
                                <a href="admin/hocsinh/{{$item->id_hocsinh}}/delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center">Không có dữ liệu</td>
                        </tr>
                    @endif
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
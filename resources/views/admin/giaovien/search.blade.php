@extends('admin/layouts/index')
@section('title')Tìm kiếm giáo viên @endsection
@section('adminContent')

    @include('admin/layouts/tab')
    <section class="adminForm">
        <div class="container">
                <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-search-plus"></i> Tìm kiếm thông tin giáo viên</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="adminContainsFormSearch">
                <form action="{{route('searchTeach')}}" ,method = "get" class="adminFormSearch">
                    <table class="adminFormSeachTable">
                        <tr>
                            <td><p class="adminFormSearchText">Mã Giáo viên</p></td>
                            <td>                 
                                <input type="text" name="MaGV" value="{{Request::get('MaGV')}}" class="formInput" placeholder="Mã giáo viên...">
                            </td>
                            <td><p class="adminFormSearchText">Tên giáo viên</p></td>
                            <td>
                                <input type="text" name="TenGV" value="{{Request::get('TenGV')}}" 
                                class="formInput capitalize" placeholder="Họ và tên..." >
                            </td>
                        </tr>
                        <tr>
                         <td><p class="adminFormSearchText">Giới Tính</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="GioiTinh" id="" class="formSelect">
                                        <option selected disabled>Lựa chọn</option>
                                        <option @if (Request::get('GioiTinh') == 'Nam') selected @endif value="Nam">Nam</option>
                                        <option @if (Request::get('GioiTinh') == 'Nu') selected @endif value="Nu">Nữ</option>
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
                                            <option @if ($item->id == Request::get('Phuong')) selected @endif value="{{$item->id}}">{{$item->TenPhuong}}</option>
                                        @endforeach
                                    </select>
                                    <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                </div>
                            </td>
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
            <h3 class="adminListTitle">Danh sách giáo viên</h3>
            <div class="adminActive">
                <a href="admin/giaovien" class="adminActiveItem"><i class="fas fa-undo-alt"></i>Quay lại</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã giáo viên</th>
                    <th>Họ và tên</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                     <th>Phường</th>
                    <th>Chọn</th>
                </tr>
                @if (count($giaovien))
                    @foreach ($giaovien as $item)
                    <tr class="trContainsBox">
                        <td>{{$stt++}}</td>
                        <td>{{$item->MaGV}}</td>
                        <td class = "text-left">{{$item->HoGV . ' ' . $item->TenGV}}</td>
                        <td>@if ($item->GioiTinh == 'Nu') Nữ
                            @else Nam @endif</td>
                        <td>{{$item->NgaySinh}}</td>
                        <td>{{$item->SoDT}}</td>
                        <td>{{$item->DiaChi}}</td>
                        <td class="text-left pl-1">{{$item->Phuong->DonVi}} {{$item->Phuong->TenPhuong}}</td>
                        <td>
                            <a href="admin/giaovien/{{$item->id}}"><i class="fas fa-info-circle"></i></a>
                            <a href="admin/giaovien/{{$item->id}}/edit"><i class="fas fa-edit"></i></a>
                            <a href="admin/giaovien/{{$item->id}}/delete"><i class="fas fa-trash text-danger"></i></a>
                        </td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="9">Không có dữ liệu</td>
                </tr>
                @endif

            </table>
        </div>
    </section>
@endsection
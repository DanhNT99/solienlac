@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/hocsinh/tab')
    <section class="adminForm">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-search-plus adminBoxTitleIcon"></i>
                Tìm kiếm thông tin học sinh
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span></h3>
        </div>
    </section>

    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Danh sách phân công học tập</h3>
            <div class="adminActive">
                <a href="admin/hoc/create" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Phân công</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã học sinh</th>
                    <th>Tên học sinh</th>
                    <th>Tên lớp</th>
                    <th>Niên khóa</th>
                    <th>Chọn</th>
                </tr>
                @foreach ($pcht as $item)
                    <tr>
                        <td>{{$stt++}}</td>
                        <td>{{$item->HocSinh->MaHS}}</td>
                        <td>{{$item->HocSinh->HoHS . ' ' . $item->HocSinh->TenHS}}</td>
                        <td>{{$item->Lop->TenLop}}</td>
                        <td>{{$item->NienKhoa->NamBatDau .'-' .$item->NienKhoa->NamKetThuc}}</td>
                        <td>
                            <a href="admin/hoc/{{$item->id}}/edit"><i class="fas fa-edit"></i></a>
                            <a href="admin/hoc/{{$item->id}}/delete"><i class="fas fa-trash"></i></a>
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
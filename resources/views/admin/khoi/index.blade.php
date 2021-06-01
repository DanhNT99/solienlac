@extends('admin/layouts/index')
@section('title')Khối @endsection
@section('adminContent')
    @include('admin/khoi/tab')
    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Danh sách khối</h3>
            <div class="adminActive">
                <a href="admin/khoi/create" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Thêm</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã Khối</th>
                    <th>Tên Khối</th>
                    <th>Được phép</th>
                    <th>Chọn</th>
                </tr>
                @foreach ($khoi as $item)
                    <tr>
                        <td>{{$stt++}}</td>
                        <td>{{$item->MaKhoi}}</td>
                        <td>{{$item->TenKhoi}}</td>
                        <td> @if ($item->DuocPhep) Được @else Không @endif </td>
                        <td>
                            <a href="admin/khoi/{{$item->id}}/edit"><i class="fas fa-edit"></i></a>
                            <a href="admin/khoi/{{$item->id}}/delete"><i class="fas fa-trash"></i></a>
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
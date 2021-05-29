@extends('admin/layouts/index')

@section('adminContent')
@include('admin/tinh/tab')
    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Danh sách tỉnh</h3>
            <div class="adminActive">
                <a href="admin/tinh/create" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Thêm</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã tỉnh</th>
                    <th>Tên tỉnh</th>
                </tr>
                @foreach ($tinh as $item)
                    <tr>
                        <td>{{$stt++}}</td>
                        <td>
                            {{$item->MaTinh}}
                        </td>
                        <td>{{$item->TenTinh}}</td>
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
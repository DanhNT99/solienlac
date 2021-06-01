@extends('admin/layouts/index')
@section('title')Môn học @endsection
@section('adminContent')
@include('admin/khoi/tab')
    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Danh sách môn học</h3>
            <div class="adminActive">
                <a href="admin/monhoc/create" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Thêm</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã môn học</th>
                    <th>Tên môn học</th>
                    <th>Nhập điểm</th>
                    <th>Chọn</th>
                </tr>
                @foreach ($monhoc as $item)
                    <tr>
                        <td>{{$stt++}}</td>
                        <td>{{$item->MaMH}}</td>
                        <td>{{$item->TenMH}}</td>
                        <td>
                            @if ($item->ChoPhepNhapDiem) Được phép
                            @else Không dược phép  @endif
                        </td>
                        <td>
                            <a href="admin/monhoc/{{$item->id}}/edit"><i class="fas fa-edit"></i></a>
                            <a href="admin/monhoc/{{$item->id}}/delete"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {!!$monhoc->links()!!}
        </div>
    </section>

    @if (Session::has('noti'))
        <div class="notiBox">
        <h4 class="notiBoxTitle">Thông báo <button class="notiBoxBtn"><i class="far fa-window-close"></i></button></h4>
        <p class="notiBoxContent"> {{Session('noti')}}!</p>
        </div>
    @endif
@endsection
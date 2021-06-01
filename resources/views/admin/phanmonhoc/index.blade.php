@extends('admin/layouts/index')
@section('title') Phân môn học @endsection
@section('adminContent')
@include('admin/khoi/tab')
    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Danh sách môn học</h3>
            <div class="adminActive">
                <a href="admin/phanmonhoc/create" class="adminActiveItem">Phân môn học</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Tên khối</th>
                    <th>Tên môn học</th>
                    <th>Chọn</th>
                </tr>
                @foreach ($phanmonhoc as $item)
                    <tr class = "trContainsBox">
                        <td>{{$stt++}}</td>
                        <td>
                            @if ($item->id_khoi) {{$item->Khoi->TenKhoi}} @else Chưa có @endif
                        </td>
                        <td>
                            @if ($item->id_monhoc) {{$item->MonHoc->TenMH}}
                            @else  Chưa có  @endif
                        </td>
                        <td>
                            <a href="admin/phanmonhoc/{{$item->id}}/edit"><i class="fas fa-edit"></i></a>
                            <a href="admin/phanmonhoc/{{$item->id}}/delete"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {!!$phanmonhoc->links()!!}
        </div>
    </section>

    @if (Session::has('noti'))
        <div class="notiBox">
        <h4 class="notiBoxTitle">Thông báo <button class="notiBoxBtn"><i class="far fa-window-close"></i></button></h4>
        <p class="notiBoxContent"> {{Session('noti')}}!</p>
        </div>
    @endif
@endsection
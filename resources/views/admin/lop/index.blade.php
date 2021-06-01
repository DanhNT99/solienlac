@extends('admin/layouts/index')
@section('title')Lớp @endsection
@section('adminContent')
    @include('admin/khoi/tab')
    
    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Danh sách Lớp</h3>
            <div class="adminActive">
                <a href="admin/lop/create" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Thêm</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã Lớp</th>
                    <th>Tên Lớp</th>
                    <th>Khối</th>
                    <th>GVCN</th>
                    <th>Chọn</th>
                </tr>
                @foreach ($lop as $item)
                    <tr class = "trContainsBox">
                        <td>{{$stt++}}</td>
                        <td>{{$item->MaLop}}</td>
                        <td>{{$item->TenLop}}</td>
                        <td>
                            @if ($item->id_khoi) {{$item->Khoi->TenKhoi}}
                            @else Chưa có @endif
                        </td>
                        <td>
                            @if ($item->id_giaovien)
                                {{$item->Gvcn->HoGV.' '.$item->Gvcn->TenGV}}
                            @else Chưa có @endif
                        </td>
                        <td>
                            <a href="admin/lop/{{$item->id}}/edit"><i class="fas fa-edit"></i></a>
                            <a href="admin/lop/{{$item->id}}/delete"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {!!$lop->links()!!}
        </div>
    </section>

    @if (Session::has('noti'))
        <div class="notiBox">
        <h4 class="notiBoxTitle">Thông báo <button class="notiBoxBtn"><i class="far fa-window-close"></i></button></h4>
        <p class="notiBoxContent"> {{Session('noti')}}!</p>
        </div>
    @endif
@endsection
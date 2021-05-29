@extends('admin/layouts/index')

@section('adminContent')
@include('admin/nienkhoa/tab')
    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Danh sách niên khóa</h3>
            <div class="adminActive">
                <a href="admin/nienkhoa/create" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Thêm</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã niên khóa</th>
                    <th>Năm bắt đâu</th>
                    <th>Năm kết thúc</th>
                    <th>Trạng thái</th>
                    <th>Chọn</th>
                </tr>
            @foreach ($nienkhoa as $item)
                    <tr class = "trContainsBox">
                        <td>{{$stt++}}</td>
                        <td>{{$item->MaNK}}</td>
                        <td>{{$item->NamBatDau}}</td>
                        <td>{{$item->NamKetThuc}}</td>
                        <td>
                            <input type="checkbox" @if ($item->TrangThai) checked @endif>
                        </td>
                        <td>
                            <a href="admin/nienkhoa/{{$item->id}}/edit"><i class="fas fa-edit"></i></a>
                            <a href="admin/nienkhoa/{{$item->id}}/delete"><i class="fas fa-trash"></i></a>
                         </td>
                    </tr>
                @endforeach
            </table>
            {!!$nienkhoa->links()!!}
        </div>
    </section>

    @if (Session::has('noti'))
        <div class="notiBox">
            <h4 class="notiBoxTitle">Thông báo <button class="notiBoxBtn"><i class="far fa-window-close"></i></button></h4>
            <p class="notiBoxContent"> {{Session('noti')}}!</p>
        </div>
    @endif
@endsection
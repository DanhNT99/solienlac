@extends('admin/layouts/index')

@section('adminContent')
@include('admin/nienkhoa/tab')
    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Danh sách loại học kỳ</h3>
            <div class="adminActive">
                <a href="admin/loaihocky/create" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Thêm</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã loại HK</th>
                    <th>Tên loại HK</th>
                    <th>Tên học kỳ</th>
                    <th>Niên khóa</th>
                    <th>Chọn</th>
                </tr>
            @foreach ($loaihk as $item)
                    <tr class = "trContainsBox">
                        <td>{{$stt++}}</td>
                        <td>{{$item->MaLoaiHK}}</td>
                        <td>{{$item->TenLoaiHK}}</td>
                        <td>{{$item->HocKy->TenHK}}</td>
                        <td>{{$item->HocKy->NienKhoa->NamBatDau . ' - ' . $item->HocKy->NienKhoa->NamKetThuc}}</td>
                        <td>
                            <a href="admin/loaihocky/{{$item->id}}/edit"><i class="fas fa-edit"></i></a>
                            <a href="admin/loaihocky/{{$item->id}}/delete"><i class="fas fa-trash"></i></a>
                         </td>
                    </tr>
                @endforeach
            </table>
            {!!$loaihk->links()!!}
        </div>
    </section>

    @if (Session::has('noti'))
        <div class="notiBox">
            <h4 class="notiBoxTitle">Thông báo <button class="notiBoxBtn"><i class="far fa-window-close"></i></button></h4>
            <p class="notiBoxContent"> {{Session('noti')}}!</p>
        </div>
    @endif
@endsection
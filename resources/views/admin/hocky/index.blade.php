@extends('admin/layouts/index')

@section('adminContent')
@include('admin/nienkhoa/tab')
    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Danh sách học kỳ</h3>
            <div class="adminActive">
                <a href="admin/hocky/create" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Thêm</a>
                <a href="admin/loaihocky" class="adminActiveItem">Loại học kỳ</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã học kỳ</th>
                    <th>Tên học kỳ</th>
                    <th>Niên khóa</th>
                    <th>Trạng thái</th>
                    <th>Chọn</th>
                </tr>
            @foreach ($hocky as $item)
                    <tr class = "trContainsBox">
                        <td>{{$stt++}}</td>
                        <td>{{$item->MaHK}}</td>
                        <td>{{$item->TenHK}}</td>
                        <td>{{$item->NienKhoa->NamBatDau . ' - ' . $item->NienKhoa->NamKetThuc }}</td>
                          <td>
                            <input type="checkbox" @if ($item->TrangThai) checked @endif>
                        </td>
                        <td>
                            <a href="admin/hocky/{{$item->id}}/edit"><i class="fas fa-edit"></i></a>
                            <a href="admin/hocky/{{$item->id}}/delete"><i class="fas fa-trash"></i></a>
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
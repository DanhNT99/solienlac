@extends('admin/layouts/index')
@section('title') Sổ liên lạc @endsection
@section('adminContent')
    @include('admin/layouts/tab')
    <section class="adminForm">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-search-plus adminBoxTitleIcon"></i>
                Tìm kiếm thông tin học sinh
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span></h3>
        </div>
    </section>

    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Sổ liên lạc học sinh</h3>
            <div class="adminActive">
                <a href="#" class="adminActiveItem"><i class="far fa-times-circle"></i> Xóa</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã SLL</th>
                    <th>Mã học sinh</th>
                    <th>Tên học sinh</th>
                    <th>Học lực</th>
                    <th>Nhận xét</th>
                    <th>Xem chi tiết</th>
                </tr>
                @foreach ($giaovien->Hoc as $item)
                    <tr>
                        <td>{{$stt++}}</td>
                        <td>{{$item->HocSinh->SoLienLac->MaSLL}}</td>
                        <td>{{$item->HocSinh->MaHS}}</td>
                        <td>{{$item->HocSinh->HoHS . ' ' . $item->HocSinh->TenHS}}</td>
                        <td>
                            @if ($item->HocSinh->SoLienLac->HocLuc)
                                {{$item->HocSinh->SoLienLac->HocLuc}}
                            @else Chưa nhập @endif
                        </td>
                        <td>
                            @if ($item->HocSinh->SoLienLac->NhanXet)
                               Đã nhập
                            @else Chưa nhập  @endif
                        </td>
                        <td>
                            <a href="admin/solienlac/{{$item->HocSinh->id}}">đánh giá</a>
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
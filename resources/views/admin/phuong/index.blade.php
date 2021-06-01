@extends('admin/layouts/index')
@section('title') Phường @endsection
@section('adminContent')
@include('admin/tinh/tab')
    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Danh sách phường</h3>
            <div class="adminActive">
                <a href="admin/phuong/create" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Thêm</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã phường</th>
                    <th>Đơn vị</th>
                    <th>Tên phường</th>
                    <th>Tên Tỉnh</th>
                </tr>
                @foreach ($phuong as $item)
                    <tr class = "trContainsBox">
                        <td>{{$stt++}}</td>
                        <td class = "tdContainsBox">
                            {{$item->MaPhuong}}
                            <ul class="tdBoxDrop">
                               <li class="tdBoxDropItem">
                                   <a href="admin/phuong/{{$item->id}}" class="tdBoxDropItemLink"><i class="far fa-id-card"></i>Xem chi tiết</a>
                               </li>
                               <li class="tdBoxDropItem">
                                    <a href="#" class="tdBoxDropItemLink"><i class="fas fa-user-times"></i>Xóa phường</a>
                               </li>
                               <li class="tdBoxDropItem">
                                    <a href="#" class="tdBoxDropItemLink"><i class="fas fa-edit"></i>Cập nhật phường</a>
                                </li>
                            </ul>
                        </td>
                        <td>{{$item->DonVi}}</td>
                        <td>{{$item->TenPhuong}}</td>
                        <td>{{$item->tinh->TenTinh}}</td>
                    </tr>
                @endforeach
            </table>
            {!!$phuong->Links()!!}
        </div>
    </section>

    @if (Session::has('noti'))
        <div class="notiBox">
        <h4 class="notiBoxTitle">Thông báo <button class="notiBoxBtn"><i class="far fa-window-close"></i></button></h4>
        <p class="notiBoxContent"> {{Session('noti')}}!</p>
        </div>
    @endif
@endsection
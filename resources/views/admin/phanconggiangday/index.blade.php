@extends('admin/layouts/index')

@section('adminContent')
@include('admin/giaovien/tab')
    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Danh sách phân công giảng dạy</h3>
            <div class="adminActive">
                <a href="admin/phanconggiangday/create" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Thêm</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Tên giáo viên</th>
                    <th>Tên môn học</th>
                    <th>Tên lớp</th>
                </tr>
                @foreach ($giangday as $item)
                    <tr class = "trContainsBox">
                        <td>{{$stt++}}</td>
                        <td class = "tdContainsBox">
                            {{$item->GiaoVien->HoGV . ' ' . $item->giaovien->TenGV}}
                            {{-- <ul class="tdBoxDrop">
                               <li class="tdBoxDropItem">
                                   <a href="admin/monhoc/{{$item->id}}" class="tdBoxDropItemLink"><i class="far fa-id-card"></i>Xem chi tiết</a>
                               </li>
                               <li class="tdBoxDropItem">
                                    <a href="#" class="tdBoxDropItemLink"><i class="fas fa-user-times"></i>Xóa môn học</a>
                               </li>
                               <li class="tdBoxDropItem">
                                    <a href="#" class="tdBoxDropItemLink"><i class="fas fa-edit"></i>Cập nhật môn học</a>
                                </li>
                            </ul> --}}
                        </td>
                        <td>{{$item->MonHoc->TenMH}}</td>
                        <td>{{$item->Lop->TenLop}}</td>
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
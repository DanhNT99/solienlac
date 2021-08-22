@extends('admin/layouts/index')
@section('title')Loại học kì @endsection
@section('adminContent')
@include('admin/nienkhoa/tab')
    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Danh sách loại học kì</h3>
            <div class="adminActive">
                <a href="admin/loaihocky/create" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Thêm</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã loại HK</th>
                    <th>Tên loại HK</th>
                    <th>Tên học kì</th>
                    <th>Niên khóa</th>
                    <th>Chọn</th>
                </tr>
            @foreach ($loaihk as $item)
                    <tr class = "trContainsBox">
                        <td>{{$stt++}}</td>
                        <td>{{$item->MaLoaiHK}}</td>
                        <td class="text-left ">
                        <p class="ml-5">{{$item->TenLoaiHK}}</p>
                        </td>
                        <td>{{$item->HocKy->TenHK}}</td>
                        <td>{{$item->HocKy->NienKhoa->NamBatDau . ' - ' . $item->HocKy->NienKhoa->NamKetThuc}}</td>
                        <td>
                            <a href="admin/loaihocky/{{$item->id}}/edit"><i class="fas fa-edit"></i></a>
                            <form action="{{route('loaihocky.destroy','')}}/{{$item->id}}" method = "post" class="adminFormAdd {{'formDelete' . $item->id}} d-inline" >
                                @method('DELETE') @csrf
                                <button type="button" class="bg-none border-0 btnButton" id="{{$item->id}}" data-toggle="modal" data-target="#exampleModal">
                                  <i class="fas fa-trash text-danger"></i>
                                </button>
                            </form>
                         </td>
                    </tr>
                @endforeach
            </table>
            {!!$loaihk->links()!!}
        </div>
    </section>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header  py-1">
            <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body"> Bạn có chắc chắn xóa không ? </div>
            <div class="modal-footer py-1">
            <button type="button" class="btn btn-danger py-1 btnSubmit" data-dismiss="modal">Thực hiện</button>
            <button type="button" class="btn btn-primary py-1 ">Hủy bỏ</button>
            </div>
            </div>
    </div>
</div>

    @if (Session::has('noti'))
        <div class="notiBox">
            <h4 class="notiBoxTitle">Thông báo <button class="notiBoxBtn"><i class="far fa-window-close"></i></button></h4>
            <p class="notiBoxContent"> {{Session('noti')}}!</p>
        </div>
    @endif
@endsection
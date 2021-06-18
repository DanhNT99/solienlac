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
                            <form action="{{route('hocky.destroy','')}}/{{$item->id}}" method = "post" class="adminFormAdd {{'formDelete' . $item->id}} d-inline" >
                                @method('DELETE') @csrf
                                <button type="button" class="bg-none border-0 btnButton" id="{{$item->id}}" data-toggle="modal" data-target="#exampleModal">
                                  <i class="fas fa-trash text-danger"></i>
                                </button>
                            </form>
                         </td>
                    </tr>
                @endforeach
            </table>
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
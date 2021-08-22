@extends('admin/layouts/index')
@section('title') Phân môn học @endsection
@section('adminContent')
@include('admin/khoi/tab')
    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Phân môn học theo khối</h3>
            <div class="adminActive">
                <a href="admin/phanmonhoc/create" class="adminActiveItem"><i class = "fas fa-plus-circle"></i> Phân môn học</a>
            </div>
            @foreach ($khoi as $grade)
            <?php $stt = 1?>
            <table class="adminTable mt-4" border="1">
                <tr>
                    <th colspan="1">{{$grade->TenKhoi}}</th>
                </tr>
                <tr>
                    <th>Stt</th>
                    <th>Tên môn học</th>
                    <th>Chọn</th>
                </tr>
                @foreach ($phanmonhoc as $pmh)

                    @if ($pmh->id_khoi == $grade->id)
                        <tr class = "trContainsBox">
                            <td>{{$stt++}}</td>
                            <td>{{$pmh->MonHoc->TenMH}}</td>
                            <td>
                                <a href="admin/phanmonhoc/{{$pmh->id}}/edit"><i class="fas fa-edit"></i></a>
                                <form action="{{route('phanmonhoc.destroy','')}}/{{$pmh->id}}" method = "post" class="adminFormAdd {{'formDelete' . $pmh->id}} d-inline" >
                                    @method('DELETE') @csrf
                                    <button type="button" class="bg-none border-0 btnButton" id="{{$pmh->id}}" data-toggle="modal" data-target="#exampleModal">
                                      <i class="fas fa-trash text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>
            @endforeach
            {!!$khoi->Links()!!}
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
        <div class="modal-body"> Bạn có chắc chắn xóa không?</div>
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
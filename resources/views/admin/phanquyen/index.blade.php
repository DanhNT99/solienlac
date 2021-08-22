@extends('admin/layouts/index')
@section('title') Phân quyền @endsection
@section('adminContent')
    @include('admin/quyen/tab')
    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Danh sách phân quyền</h3>
            <div class="adminActive">
                {{-- <a href="admin/phanquyen/create" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Thêm</a> --}}
                <button type="button" class="adminActiveItem border-0" data-toggle="modal" data-target="#example">
                    Phân quyền
                </button>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Tên giao viên</th>
                    <th>Tên quyền</th>
                    <th>Chọn</th>
                </tr>
                @foreach ($phanquyen as $item)
                    <tr>
                        <td>{{$stt++}}</td>
                        <td>{{$item->GiaoVien->HoGV . ' ' . $item->GiaoVien->TenGV}}</td>
                        <td>{{$item->Quyen->name}}</td>
                        <td>
                            @if (!(Auth::guard('giao_vien')->user()->id == $item->GiaoVien->id))
                                <a href="admin/phanquyen/{{$item->GiaoVien->id}}/edit"><i class="fas fa-edit"></i></a>
                                <form action="{{route('phanquyen.destroy','')}}/{{$item->GiaoVien->id}}" method = "post" class="adminFormAdd {{'formDelete' . $item->GiaoVien->id}} d-inline" >
                                    @method('DELETE') @csrf
                                     <button type="button" class="bg-none border-0 btnButton" id="{{$item->GiaoVien->id}}" data-toggle="modal" data-target="#exampleModal">
                                      <i class="fas fa-trash text-danger"></i>
                                      </button>
                                 </form>
                            @endif
                         </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </section>

    <div class="modal fade" id="example" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modalBox" role="document">
            <div class="modal-content">
                <form class="adminFormSearch py-2" action="{{route('phanquyen.store')}}" method = "post">
                    @csrf
                    <h4 class = "modelTitle">Phân quyền</h4>

                    <table class="adminFormSeachTable">
                        <tr>
                            <td><p class="adminFormSearchText">Tên giáo viên</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="giaovien" id="" class="formSelect">
                                        <option selected disabled>Lựa chọn</option>
                                        @foreach ($giaovien as $item)
                                            <option value="{{$item->id}}">{{$item->HoGV . ' '. $item->TenGV}}</option>
                                        @endforeach
                                    </select>
                                    <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><p class="adminFormSearchText">Tên quyền</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="quyen" id="" class="formSelect">
                                        <option selected disabled>Lựa chọn</option>
                                        @foreach ($quyen as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <div class=" mt-2 mb-1 px-2 text-center">
                        <div>
                            <button type="submit" class="px-3 py-1 border-0 rounded modalBtn mr-2">Thực hiện</button>
                            <button type="button" class="px-3 py-1 border-0 rounded btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
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
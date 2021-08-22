@extends('admin/layouts/index')
@section('title') Phường @endsection
@section('adminContent')
@include('admin/layouts/tab')

<section class="adminForm pt-1">
  <div class="container">
      <div class="adminBoxTitle py-1 px-2">
          <h6 class = "m-0"><i class="fas fa-search-plus adminBoxTitleIcon"></i> Tìm kiếm phường</h6>
          <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
      </div>
      <div class="adminContainsFormSearch">
          <form action="{{route('searchPhuong')}}" class="adminFormSearch" method = "get">
              <table class="adminFormSeachTable">
                  <tr>
                      <td><p class="adminFormSearchText">Đơn vị</p></td>
                      <td>
                          <div class="formBoxSelect">
                              <select name="DonVi" class="formSelect">
                                  <option selected disabled>Lựa chọn</option>
                                  <option value="Xã">Xã</option>
                                  <option value="Phường">Phường</option>
                              </select>
                              <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                          </div>
                      </td>
                      <td><p class="adminFormSearchText">Tên phường/xã</p></td>
                      <td>
                          <input type="text" name="TenPhuong" class="formInput capitalize" placeholder="Tên phường/xã">
                      </td>
                  </tr>
              </table>
              <div class="adminFormSearchContainsBtn">
                  <button class="adminFormSearchBtn">Tìm kiếm</button>
              </div>
          </form>
      </div>
  </div>
</section>

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
                <th>Chọn</th>
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
                    <td>
                        <a href="admin/phuong/{{$item->id}}/edit"><i class="fas fa-edit"></i></a>
                        <form action="{{route('phuong.destroy','')}}/{{$item->id}}" method = "post" class="adminFormAdd {{'formDelete' . $item->id}} d-inline" >
                            @method('DELETE') @csrf
                              <button type="button" class="bg-none border-0 btnButton" id="{{$item->id}}" data-toggle="modal" data-target="#exampleModal">
                              <i class="fas fa-trash text-danger"></i>
                              </button>
                          </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {!!$phuong->Links()!!}
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
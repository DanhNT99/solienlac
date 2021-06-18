@extends('admin/layouts/index')
@section('title')Phân công học tập @endsection
@section('adminContent')
    @include('admin/hocsinh/tab')
    <section class="adminForm">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-search-plus adminBoxTitleIcon"></i>
                Tìm kiếm thông tin học sinh</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="adminContainsFormSearch">
              <form action="{{route('searchStudent')}}" class="adminFormSearch" method = "get">
                <table class="adminFormSeachTable">
                  <tr>
                      <td class=""><p class="adminFormSearchText">Khối</p></td>
                      <td>
                          <div class="formBoxSelect">
                              <select name="Khoi" id="khoi" class="formSelect">
                                  <option selected disabled>Lựa chọn</option>
                                  @foreach ($khoi as $item)
                                      <option value="{{$item->id}}">{{$item->TenKhoi}}</option>
                                  @endforeach
                              </select>
                              <div class="formSelectIcon">
                                  <i class="fas fa-caret-down"></i>
                              </div>
                          </div>
                      </td>
                      <td><p class="adminFormSearchText">Lớp</p></td>
                      <td>
                          <div class="formBoxSelect">
                              <select name="Lop" class="formSelect" id = "lop">
                                  <option selected disabled>Lựa chọn</option>
                                  @foreach ($lop as $item)
                                      <option class="formBoxSelectOption" value="{{$item->id}}">{{$item->TenLop}}</option>
                                  @endforeach
                              </select>
                              <div class="formSelectIcon">
                                  <i class="fas fa-caret-down"></i>
                              </div>
                          </div>
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
            <h3 class="adminListTitle">Danh sách phân công học tập</h3>
            <div class="adminActive">
                <a href="admin/hoc/create" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Phân công</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã học sinh</th>
                    <th>Tên học sinh</th>
                    <th>Tên lớp</th>
                    <th>Niên khóa</th>
                    <th>Chọn</th>
                </tr>
                @foreach ($pcht as $item)
                    <tr>
                        <td>{{$stt++}}</td>
                        <td>{{$item->HocSinh->MaHS}}</td>
                        <td>{{$item->HocSinh->HoHS . ' ' . $item->HocSinh->TenHS}}</td>
                        <td>{{$item->Lop->TenLop}}</td>
                        <td>{{$item->NienKhoa->NamBatDau .'-' .$item->NienKhoa->NamKetThuc}}</td>
                        <td>
                            <a href="admin/hoc/{{$item->id}}/edit"><i class="fas fa-edit"></i></a>
                            <form action="{{route('hoc.destroy','')}}/{{$item->id}}" method = "post" class="adminFormAdd {{'formDelete' . $item->id}} d-inline" >
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
    
      <!-- Modal -->
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
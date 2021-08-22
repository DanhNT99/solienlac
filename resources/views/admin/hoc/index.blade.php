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
                <form action="{{route('timkiemPCHT')}}" class="adminFormSearch" method = "get">
                    <table class="adminFormSeachTable">
                        <tr>
                            <td><p class="adminFormSearchText mr-2">Niên khóa</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="nienkhoa" class="formSelect ">
                                        <option selected disabled>Lựa chọn</option>
                                        @foreach ($nienkhoa as $item)
                                        <option @if ($item->TrangThai == 1) selected 
                                                @endif value="{{$item->id}}">
                                                {{$item->NamBatDau . ' - ' . $item->NamKetThuc}}</option>
                                        @endforeach
                                    </select>
                                    <div class="formSelectIcon"> <i class="fas fa-caret-down"></i></div>
                                </div>
                            </td>
                            <td class=""><p class="adminFormSearchText">Khối</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="Khoi" id="khoi" class="formSelect">
                                        <option value = "">Tất cả</option>
                                        @foreach ($khoi as $item)
                                        <option @if (Request::get('Khoi') == $item->id) selected
                                                @endif value="{{$item->id}}">{{$item->TenKhoi}}</option>
                                        @endforeach
                                    </select>
                                    <div class="formSelectIcon">  <i class="fas fa-caret-down"></i> </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><p class="adminFormSearchText">Lớp</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="Lop" class="formSelect" id = "lop">
                                        <option value = "NULL">Tất cả</option>
                                        @foreach ($lop as $item)
                                        <option @if (Request::get('Lop') == $item->id) selected
                                                @endif  class="formBoxSelectOption" value="{{$item->id}}">{{$item->TenLop}}</option>
                                        @endforeach
                                    </select>
                                    <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                </div>
                            </td>
                            <td><p class="adminFormSearchText">Mã học sinh</p></td>
                            <td><input type="text" name = "MaHS" class = "formInput"  placeholder="Mã học sinh"></td>
                        </tr>
                        <tr>
                            <td><p class="adminFormSearchText">Tên học sinh</p></td>
                            <td>
                                <input type="text" name = "TenHS" class = "formInput" placeholder="Tên học sinh">
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
                <form action="admin/hoc/create" method = "get">
                    <input type="text" class = "d-none" name = "Lop" value="{{Request::get('Lop')}}">
                    <button class="adminActiveItem border-0 outline-none"><i class="fas fa-plus-circle"></i>Phân công</button>
                </form>
            </div>
            <form action = "{{route('hoc.destroy','')}}/{{$item->id}}" method = "post">
                @method('DELETE') @csrf
                <div class="d-flex mb-2">
                    <div class="input-group ml-0 mr-2">
                        <input type="checkbox" class="inputCheckAll" hidden />
                        <label for="checkbox" class="checkbox m-0">
                                <span class="icon"></span>
                                <span class="text">Check all</span>
                        </label>
                    </div> 
                    <button type="submit" name="deleteList" class="px-3 py-1 border-0 rounded modalBtn mr-2"><i class="fas fa-trash color-white mr-1"></i>Xóa</button>
                </div>
                <table class="adminTable" border="1">
                    <tr>
                        <th></th>
                        <th>Stt</th>
                        <th>Mã học sinh</th>
                        <th>Tên học sinh</th>
                        <th>Tên lớp</th>
                        <th>Niên khóa</th>
                        <th>Lên lớp</th>
                        <th>Chọn</th>
                    </tr>
                    @foreach ($pcht as $item)
                        <tr>
                            <td><input type="checkbox" class="checkBoxStudent" value="{{$item->id}}" name="checkBoxGetId[]"></td>
                            <td>{{$stt++}}</td>
                            <td>{{$item->HocSinh->MaHS}}</td>
                            <td class = "text-left pl-4">{{$item->HocSinh->HoHS . ' ' . $item->HocSinh->TenHS}}</td>
                            <td>{{$item->Lop->TenLop}}</td>
                            <td>{{$item->NienKhoa->NamBatDau .'-' .$item->NienKhoa->NamKetThuc}}</td>
                            <td>
                                 @if ($item->LenLop === 0)
                                  Ở lại lớp
                                @endif
                                @if ($item->LenLop === 1)
                                  Lên lớp
                                @endif
                                 @if ($item->LenLop === NULL)
                                  Chưa đánh giá
                                @endif
                            </td>
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
            </form>

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
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#khoi').change(function (e) { 
                let idGrade = $(this).val();
                let listClass = {!! json_encode($lop)!!}
                listClass = listClass.filter(item => {
                    return item.id_khoi == idGrade;
                })

                listClass = listClass.map(item => {
                    return `<option value = ${item.id}>${item.TenLop}</option>`;
                })
                $('#lop').html(listClass.join(''));
            });
        });
    </script>
@endsection
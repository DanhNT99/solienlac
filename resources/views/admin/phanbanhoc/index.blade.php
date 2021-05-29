@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/banhoc/tab')
    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Phân ban học</h3>
            <div class="adminActive">
                <a href="admin/phanbanhoc/create" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Thêm</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Tên khối</th>
                    <th>Tên ban học</th>
                    <th>Chọn</th>
                </tr>
                @foreach ($phanbanhoc as $item)
                        <tr class = "trContainsBox">
                            <td>{{$stt++}}</td>
                            <td class = "tdContainsBox">
                                {{$item->Khoi->TenKhoi}}
                            </td>
                            <td>{{$item->BanHoc->TenBH}}</td>
                            <td>
                                <a href="admin/phanbanhoc/{{$item->id}}/edit">Chỉnh sửa</a>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$item->id}}">
                                  xóa
                                </button>
                                
                            </td>
                        </tr>
                          <!-- Modal -->
                    </form>
                @endforeach
            </table>
        </div>

        {{-- modal delete --}}
       {{-- @foreach ($banhoc as $item)
       <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modalBox" role="document">
            <div class="modal-content">
                <form class="adminFormSearch py-2" action="{{route('banhoc.destroy', '')}}/{{$item->id}}" method = "post">
                    @method('DELETE') @csrf
                    <h4 class = "modelTitle">Thông tin ban học</h4>
                    <table class="adminFormSeachTable">
                        <tr>
                            <td class=""><p class="adminFormSearchText">Mã ban học</p></td>
                            <td><input type="text" disabled value="{{$item->MaBH}}" class="formInput"></td>
                        </tr>
                        <tr>
                            <td class=""><p class="adminFormSearchText">Tên ban học</p></td>
                            <td><input type="text" disabled value="{{$item->TenBH}}" class="formInput"></td>
                        </tr>
                    </table>
                    <div class="d-flex mt-2 mb-1 align-items-center justify-content-between px-2">
                        <p class="modelQuestion">Bạn có muốn xóa ban học này không?</p>
                        <div>
                            <button type="submit" class="px-3 py-1 border-0 rounded modalBtn mr-2">Thực hiện</button>
                            <button type="button" class="px-3 py-1 border-0 rounded btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
       @endforeach --}}
    </section>

    @if (Session::has('noti'))
        <div class="notiBox">
        <h4 class="notiBoxTitle">Thông báo <button class="notiBoxBtn"><i class="far fa-window-close"></i></button></h4>
        <p class="notiBoxContent"> {{Session('noti')}}!</p>
        </div>
    @endif
@endsection
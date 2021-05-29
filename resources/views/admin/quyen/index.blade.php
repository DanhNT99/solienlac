@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/quyen/tab')
    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Danh sách Quyền</h3>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã quyền</th>
                    <th>Tên quyền</th>
                </tr>
                @foreach ($quyen as $item)
                    <tr class = "trContainsBox">
                        <td>{{$stt++}}</td>
                        <td>{{$item->MaQuyen}}</td>
                        <td>{{$item->name}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modalBox" role="document">
            <div class="modal-content">
                <form class="adminFormSearch py-2" action="{{route('quyen.store')}}" method = "post">
                    @csrf
                    <h4 class = "modelTitle">Thêm quyền</h4>
                    <table class="adminFormSeachTable">
                        <tr>
                            <td class=""><p class="adminFormSearchText">Mã quyền</p></td>
                            <td><input type="text" value="{{$text_id}}" name="MaQuyen" class="formInput formInputMa"></td>
                        </tr>
                        <tr>
                            <td class=""><p class="adminFormSearchText">Tên Quyền</p></td>
                            <td><input type="text" name="TenQuyen" class="formInput"></td>
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

    @if (Session::has('noti'))
        <div class="notiBox">
        <h4 class="notiBoxTitle">Thông báo <button class="notiBoxBtn"><i class="far fa-window-close"></i></button></h4>
        <p class="notiBoxContent"> {{Session('noti')}}!</p>
        </div>
    @endif
@endsection
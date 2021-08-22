@extends('admin/layouts/index')
@section('title')Chọn khối và lớp @endsection
@section('adminContent')
    @include('admin/hocsinh/tab')

    <div class="selectedOverlay">
        <div class="selectedContent">
            <h4 class="selctedContentTitle">Vui lòng chọn khối và lớp</h4>
            <form action="admin/hoc" class="selectForm py-2" method = "get">
                <table class="mx-auto">
                    <tr>
                        <td class="py-3"><p class="adminFormSearchText mr-2">Niên khóa</p></td>
                        <td>
                            <div class="formBoxSelect">
                                <select name="nienkhoa" class="formSelect formInputMa">
                                    <option selected disabled>Lựa chọn</option>
                                @foreach ($nienkhoa as $item)
                                    <option @if ($item->TrangThai == 1) selected 
                                    @endif value="{{$item->id}}">{{$item->NamBatDau . ' - ' . $item->NamKetThuc}}</option>
                                @endforeach
                                </select>
                                <div class="formSelectIcon"> <i class="fas fa-caret-down"></i></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3"><p class="adminFormSearchText mr-2">Khối</p></td>
                        <td>
                            <div class="formBoxSelect">
                                <select name="Khoi" class="formSelect" id = "khoi">
                                    <option selected disabled>Lựa chọn</option>
                                @foreach ($khoi as $item)
                                    <option value="{{$item->id}}">{{$item->TenKhoi}}</option>
                                @endforeach
                                </select>
                                <div class="formSelectIcon"> <i class="fas fa-caret-down"></i></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td  class="py-3"><p class="adminFormSearchText mr-2" >Lớp</p></td>
                        <td>
                            <div class="formBoxSelect">
                                <select name="Lop" class="formSelect" id = "lop">
                                      <option class = "formBoxSelectOption" selected disabled>Lựa chọn</option>
                                @foreach ($lop as $item)
                                    <option class = "formBoxSelectOption" value="{{$item->id}}">{{$item->TenLop}}</option>
                                @endforeach
                                </select>
                                <div class="formSelectIcon"> <i class="fas fa-caret-down"></i></div>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="modal-footer py-1">
                    <button type="submit" class="btn btn-danger py-1 btnSubmit" data-dismiss="modal">Thực hiện</button>
                    <a href = "admin/index" type="button" class="btn btn-primary py-1 ">Hủy bỏ</a>
                  </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.adminMainTab').slideDown(0);
        });
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
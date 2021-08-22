@extends('admin/layouts/index')
@section('title') Chỉnh sửa phân môn học @endsection
@section('adminContent')
    @include('admin/khoi/tab')
    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-edit adminBoxTitleIcon mr-1"></i>Chỉnh sửa phân môn học</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="adminFormAddBox">
                <form action="{{route('phanmonhoc.update', '')}}/{{$phanmonhoc->id}}" method = "post" class="adminFormAdd" >
                    @method('PATCH') @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Môn học</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="monhoc" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            @foreach ($monhoc as $mh)
                                                <option @if ($mh->id == $phanmonhoc->id_monhoc) selected @endif value="{{$mh->id}}">{{$mh->TenMH}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                </td>
                                <td><p class="adminFormAddText">Khôi</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="khoi" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            @foreach ($khoi as $item)
                                                <option @if ($item->id == $phanmonhoc->id_khoi) selected @endif value="{{$item->id}}">{{$item->TenKhoi}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submit" class="px-2 py-1 border-0 rounded modalBtn mr-1">Thực hiện</button>
                        <a href = "admin/phanmonhoc" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
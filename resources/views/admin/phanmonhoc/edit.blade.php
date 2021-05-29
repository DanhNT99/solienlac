@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/banhoc/tab')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Phân công môn học
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
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
                        <button type="submit" class="px-3 py-1 border-0 rounded modalBtn mr-2">Thực hiện</button>
                        <a href = "admin/phanmonhoc" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
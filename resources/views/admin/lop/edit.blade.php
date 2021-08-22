@extends('admin/layouts/index')
@section('title')Chỉnh sửa lớp @endsection
@section('adminContent')
    @include('admin/khoi/tab')
    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-edit adminBoxTitleIcon mr-1"></i>Chỉnh sửa lớp </h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="adminFormAddBox">
                <form action="{{route('lop.update', '')}}/{{$lop->id}}" method = "post" class="adminFormAdd" >
                     @method('PATCH') @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã lớp</p></td>
                                <td><input type="text" name="MaLop" value="{{$lop->MaLop}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Tên lớp</p></td>
                                <td>
                                    <input type="text" name="TenLop" value="{{$lop->TenLop}}" class="formInput capitalize">
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Tên giáo viên</p></td>
                                <td>
                            
                                    <div class="formBoxSelect">
                                        <select name="giaovien" class="formSelect">
                                            @if (!$lop->id_giaovien)
                                                <option selected disabled>Lựa chọn</option>
                                            @endif
                                                @foreach ($giaovien as $item)
                                                    <option value="{{$item['id']}}" @if ($item['id'] == $lop->id_giaovien) selected
                                                    @endif>{{$item['HoGV'] . ' '. $item['TenGV']}}</option>
                                                @endforeach 
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i> </div>
                                    </div>
                                </td>
                                <td><p class="adminFormAddText">Khối</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="khoi" class="formSelect">
                                            @foreach ($khoi as $item)
                                                <option value="{{$item->id}}"@if ($item->id == $lop->id_khoi)selected
                                                    @endif>{{$item->TenKhoi}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon">
                                            <i class="fas fa-caret-down"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                          <button type="submit" class="px-2 py-1 border-0 rounded modalBtn mr-1">Thực hiện</button>
                        <a href = "admin/lop" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
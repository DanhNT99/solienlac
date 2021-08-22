@extends('admin/layouts/index')
@section('title') Thêm niên khóa @endsection
@section('adminContent')
    @include('admin/nienkhoa/tab')
    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-plus-circle adminBoxTitleIcon mr-2"></i>Thêm niên khóa</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
             </div>
            <div class="adminFormAddBox">
                <form action="{{route('nienkhoa.store')}}" method = "post" class="adminFormAdd" >
                    @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã niên khóa</p></td>
                                <td><input type="text" name="MaNK" value="{{$text_id}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Trạng thái</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="TrangThai" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            <option value="1">Hiện tại</option>
                                            <option value="0">Bỏ trống</option>
                                        </select>
                                        <div class="formSelectIcon"> <i class="fas fa-caret-down"></i></div>
                                    </div>
                                    @if ($errors->has('TrangThai')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('TrangThai')}} </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Năm bất đầu</p></td>
                                <td>
                                    <input type="text" name="NamBatDau" value = "{{$yearCurrent}}" class="formInput formInputMa">
                                    @if ($errors->has('NamBatDau')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('NamBatDau')}} </div>
                                    @endif
                                </td>
                                 <td><p class="adminFormAddText">Năm kết thúc</p></td>
                                <td>
                                    <input type="text" name="NamKetThuc" value = "{{$yearAfter}}" class="formInput formInputMa">
                                    @if ($errors->has('NamKetThuc')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('NamKetThuc')}} </div>
                                    @endif
                                </td>
                             </tr>

                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submit" class="px-2 py-1 border-0 rounded modalBtn mr-1">Thực hiện</button>
                        <a href = "admin/nienkhoa" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
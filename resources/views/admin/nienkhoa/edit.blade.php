@extends('admin/layouts/index')
@section('title') Chỉnh sửa niên khóa @endsection
@section('adminContent')
    @include('admin/nienkhoa/tab')
    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-edit adminBoxTitleIcon mr-1"></i>Chỉnh sửu niên khóa</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
             </div>
            <div class="adminFormAddBox">
                <form action="{{route('nienkhoa.update', '')}}/{{$nienkhoa->id}}" method = "post" class="adminFormAdd" >
                   @method('PATCH') @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Năm bất đầu</p></td>
                                <td>
                                    <input type="text" value="{{$nienkhoa->NamBatDau}}" name="NamBatDau" class="formInput capitalize" placeholder="Năm bất đầu">
                                    @if ($errors->has('NamBatDau')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('NamBatDau')}}</div>
                                    @endif
                                </td>
                                 <td><p class="adminFormAddText">Năm kết thúc</p></td>
                                <td>
                                    <input type="text" value="{{$nienkhoa->NamKetThuc}}" name="NamKetThuc" class="formInput capitalize" placeholder="Năm kết thúc">
                                    @if ($errors->has('NamKetThuc')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('NamKetThuc')}}</div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Mã niên khóa</p></td>
                                <td><input type="text" name="MaNK" value="{{$nienkhoa->MaNK}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Trạng thái</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="trangthai" class="formSelect">
                                            <option @if ($nienkhoa->TrangThai  == 1) selected @endif value="1">Hiện tại</option>
                                            <option @if ($nienkhoa->TrangThai  == 0) selected @endif value="0">Bỏ trống</option>
                                        </select>
                                        <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submit" class="px-3 py-1 border-0 rounded modalBtn mr-2">Thực hiện</button>
                        <a href = "admin/nienkhoa" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
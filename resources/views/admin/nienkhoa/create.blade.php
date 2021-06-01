@extends('admin/layouts/index')
@section('title') Thêm niên khóa @endsection
@section('adminContent')
    @include('admin/nienkhoa/tab')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Thêm niên khóa
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="{{route('nienkhoa.store')}}" method = "post" class="adminFormAdd" >
                    @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã niên khóa</p></td>
                                <td><input type="text" name="MaNK" value="{{$text_id}}" class="formInput"></td>
                                <td><p class="adminFormAddText">Trạng thái</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="TrangThai" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            <option  value="1">Hiện tại</option>
                                            <option  value="0">Bỏ trống</option>
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
                                    <input type="text" name="NamBatDau" class="formInput capitalize" placeholder="Năm bất đầu">
                                    @if ($errors->has('NamBatDau')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('NamBatDau')}} </div>
                                    @endif
                                </td>
                                 <td><p class="adminFormAddText">Năm kết thúc</p></td>
                                <td>
                                    <input type="text" name="NamKetThuc" class="formInput capitalize" placeholder="Năm kết thúc">
                                    @if ($errors->has('NamKetThuc')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('NamKetThuc')}} </div>
                                    @endif
                                </td>
                             </tr>

                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submmit" class="adminFormAddBtn">Thêm</button>
                        <a href = "admin/nienkhoa" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
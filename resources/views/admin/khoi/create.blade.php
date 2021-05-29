@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/khoi/tab')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Thêm khối
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="{{route('khoi.store')}}" method = "post" class="adminFormAdd" >
                    @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã khối</p></td>
                                <td><input type="text" name="MaKhoi" value="{{$text_id}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Tên khối</p></td>
                                <td>
                                    <input type="text" name="TenKhoi" class="formInput capitalize" placeholder="Tên khối">
                                    @if ($errors->has('TenKhoi')) 
                                        <div class="notiFail" role="alert">  {{$errors->first('TenKhoi')}} </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Được phép</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="DuocPhep" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            <option value="1">Được</option>
                                            <option value="0">Không</option>
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                    @if ($errors->has('DuocPhep')) 
                                        <div class="notiFail" role="alert">{{$errors->first('DuocPhep')}}</div>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submmit" class="adminFormAddBtn">Thêm</button>
                        <a href = "admin/khoi" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
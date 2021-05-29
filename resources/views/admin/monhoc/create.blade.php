@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/banhoc/tab')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Thêm môn học
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="{{route('monhoc.store')}}" method = "post" class="adminFormAdd" >
                    @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã môn học</p></td>
                                <td><input type="text" name="MaMH" value="{{$text_id}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Tên môn học</p></td>
                                <td>
                                    <input type="text" name="TenMH"  value = "{{old('TenMH')}}" class="formInput" placeholder="Tên môn học">
                                    @if ($errors->has('TenMH')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('TenMH')}}  </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Cho phép nhập điểm</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="ChoPhepNhapDiem" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            <option value="1">Được phép</option>
                                            <option value="0">Không được phép</option>
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                    @if ($errors->has('ChoPhepNhapDiem')) 
                                        <div class="notiFail" role="alert">{{$errors->first('ChoPhepNhapDiem')}}</div>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submmit" class="adminFormAddBtn">Thêm</button>
                        <a href = "admin/monhoc" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
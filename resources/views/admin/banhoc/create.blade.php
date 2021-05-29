@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/banhoc/tab')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Thêm ban học
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="{{route('banhoc.store')}}" method = "post" class="adminFormAdd" >
                    @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã ban học</p></td>
                                <td>
                                    <input type="text" name="MaBH" value="{{$idBanHoc}}" class="formInput formInputMa">
                                </td>
                                <td><p class="adminFormAddText">Tên ban học</p></td>
                                <td>
                                    <input type="text" name="TenBH" class="formInput">
                                    @if ($errors->has('TenBH')) 
                                        <div class="notiFail" role="alert">{{$errors->first('TenBH')}}</div>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submmit" class="adminFormAddBtn">Thêm</button>
                        <a href = "admin/banhoc" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
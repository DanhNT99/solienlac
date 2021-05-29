@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/tinh/tab')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Thêm tỉnh
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="{{route('tinh.store')}}" method = "post" class="adminFormAdd" >
                    @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã tỉnh</p></td>
                                <td><input type="text" name="MaTinh" value="{{$text_id}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Tên tỉnh</p></td>
                                <td>
                                    <input type="text" name="TenTinh" class="formInput capitalize" placeholder="Tên tỉnh">
                                    @if ($errors->has('TenTinh')) 
                                        <div class="notiFail" role="alert">
                                            {{$errors->first('TenTinh')}}
                                        </div>
                                    @endif
                                </td>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submmit" class="adminFormAddBtn">Thêm</button>
                        <a href = "admin/tinh" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
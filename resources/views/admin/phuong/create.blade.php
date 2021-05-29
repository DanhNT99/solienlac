@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/tinh/tab')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Thêm phường
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="{{route('phuong.store')}}" method = "post" class="adminFormAdd" >
                    @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã phường</p></td>
                                <td><input type="text" name="MaPhuong" value="{{$text_id}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Tên phường</p></td>
                                <td>
                                    <input type="text" name="TenPhuong" class="formInput capitalize" placeholder="Tên phường">
                                    @if ($errors->has('TenPhuong')) 
                                        <div class="notiFail" role="alert">
                                            {{$errors->first('TenPhuong')}}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Đơn vị</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="donvi" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            <option value="Xã">Xã</option>
                                            <option value="Phường">Phường</option>
                                        </select>
                                        <div class="formSelectIcon">
                                            <i class="fas fa-caret-down"></i>
                                        </div>
                                    </div>
                                    @if ($errors->has('donvi')) 
                                        <div class="notiFail" role="alert">
                                        {{$errors->first('donvi')}}
                                        </div>
                                     @endif
                                </td>
                                <td><p class="adminFormAddText">Tỉnh</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="tinh" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            @foreach ($tinh as $item)
                                                <option value="{{$item->id}}">{{$item->TenTinh}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon">
                                            <i class="fas fa-caret-down"></i>
                                        </div>
                                    </div>
                                    @if ($errors->has('tinh')) 
                                        <div class="notiFail" role="alert">
                                        {{$errors->first('tinh')}}
                                        </div>
                                     @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submmit" class="adminFormAddBtn">Thêm</button>
                        <a href = "admin/phuong" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
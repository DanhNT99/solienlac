@extends('admin/layouts/index')
@section('title') Chỉnh sửa phường @endsection
@section('adminContent')
    @include('admin/layouts/tab')
    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-plus-circle adminBoxTitleIcon mr-2"></i>Thêm phường</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
             </div>
            <div class="adminFormAddBox">
                <form action="{{route('phuong.update', '')}}/{{$phuong->id}}" method = "post" class="adminFormAdd" >
                    @method('PATCH') @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã phường</p></td>
                                <td><input type="text" name="MaPhuong" value="{{$phuong->MaPhuong}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Tên phường/xã</p></td>
                                <td>
                                    <input type="text" name="TenPhuong" class="formInput capitalize" value="{{$phuong->TenPhuong}}">
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
                                        <select name="DonVi" class="formSelect">
                                            <option @if ($phuong->DonVi == 'Xã') selected @endif value="Xã">Xã</option>
                                            <option @if ($phuong->DonVi == 'Phường') selected @endif value="Phường">Phường</option>
                                        </select>
                                        <div class="formSelectIcon"> <i class="fas fa-caret-down"></i></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submit" class="px-2 py-1 border-0 rounded modalBtn mr-1">Thực hiện</button>
                        <a href = "admin/phuong" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
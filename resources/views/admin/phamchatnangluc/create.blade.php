@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/banhoc/tab')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Thêm phẩm chất năng lực
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="{{route('phamchatnangluc.store')}}" method = "post" class="adminFormAdd" >
                    @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã phẩm chất năng lực</p></td>
                                <td><input type="text" name="MaPCNL" value="{{$text_id}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Tên phẩm chất năng lực</p></td>
                                <td>
                                    <input type="text" name="TenPCNL" value="{{ old('TenPCNL')}}" class="formInput ">
                                    @if ($errors->has('TenPCNL')) 
                                        <div class="notiFail" role="alert">{{$errors->first('TenPCNL')}}</div>
                                    @endif
                                </td>
                                
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Loại phẩm chất năng lực</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="LoaiPCNL" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            <option value="1">Năng lực</option>
                                            <option value="2">Phẩm chất</option>
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                    @if ($errors->has('LoaiPCNL')) 
                                        <div class="notiFail" role="alert">{{$errors->first('LoaiPCNL')}}</div>
                                     @endif
                                </td>
                            </tr>                        
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submmit" class="adminFormAddBtn">Thêm</button>
                        <a href = "admin/lop" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@extends('admin/layouts/index')
@section('title') Thêm phầm chất năng lực @endsection
@section('adminContent')
    @include('admin/layouts/tab')
    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-edit adminBoxTitleIcon mr-1"></i>Cho phép nhập điểm </h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="adminFormAddBox">
                <form action="{{route('phamchatnangluc.update', '')}}/{{$PCNL->id}}" method = "post" class="adminFormAdd" >
                   @method('PATCH') @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã phẩm chất năng lực</p></td>
                                <td><input type="text" name="MaPCNL" value="{{$PCNL->MaPCNL}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Tên phẩm chất năng lực</p></td>
                                <td>
                                    <input type="text" name="TenPCNL" value="{{$PCNL->TenPCNL}}" class="formInput ">
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
                                            <option @if ($PCNL->LoaiPCNL == 1) selected @endif value="1">Năng lực</option>
                                            <option @if ($PCNL->LoaiPCNL == 2) selected @endif value="2">Phẩm chất</option>
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                </td>
                            </tr>                        
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                       <button type="submit" class="px-2 py-1 border-0 rounded modalBtn mr-1">Thực hiện</button>
                        <a href = "admin/phamchatnangluc" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
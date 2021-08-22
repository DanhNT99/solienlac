@extends('admin/layouts/index')
@section('title')Chỉnh sửa khối @endsection
@section('adminContent')
    @include('admin/khoi/tab')
    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-edit adminBoxTitleIcon mr-1"></i>Chỉnh sửa khối</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="adminFormAddBox">
                <form action="{{route('khoi.update', '')}}/{{$khoi->id}}" method = "post" class="adminFormAdd" >
                    @method('PATCH') @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã khối</p></td>
                                <td><input type="text" name="MaKhoi" value="{{$khoi->MaKhoi}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Tên khối</p></td>
                                <td><input type="text" name="TenKhoi" value="{{$khoi->TenKhoi}}" class="formInput capitalize">
                                    @if ($errors->has('TenKhoi')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('TenKhoi')}} </div>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submit" class="px-2 py-1 border-0 rounded modalBtn mr-1">Thực hiện</button>
                        <a href = "admin/khoi" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
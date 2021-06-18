@extends('admin/layouts/index')
@section('title')Cho phép nhập điểm @endsection
@section('adminContent')
    @include('admin/layouts/tab')
    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-plus-circle adminBoxTitleIcon mr-1"></i>Cho phép nhập điểm </h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            
            <div class="adminFormAddBox">
                <form action="{{route('chophepnhapdiem.store')}}" method = "post" class="adminFormAdd" >
                    @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Ma nhập điểm</p></td>
                                <td>  <input type="text" name="MaND" value  = "{{$text_id}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Tên khối</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="khoi" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            @foreach ($khoi as $item)
                                                <option @if ($item->id == old('khoi')) selected
                                                @endif value="{{$item->id}}">{{$item->TenKhoi}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"> <i class="fas fa-caret-down"></i></div>
                                    </div>
                                    @if ($errors->has('khoi')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('khoi')}} </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Tên môn học</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="monhoc" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            @foreach ($monhoc as $item)
                                                <option  @if ($item->id == old('monhoc')) selected @endif value="{{$item->id}}">{{$item->TenMH}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"> <i class="fas fa-caret-down"></i></div>
                                    </div>
                                    @if ($errors->has('monhoc')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('monhoc')}} </div>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submmit" class="adminFormAddBtn">Thêm</button>
                        <a href = "admin/chophepnhapdiem" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
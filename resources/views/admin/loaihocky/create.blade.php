@extends('admin/layouts/index')
@section('title')Thêm loại học kì @endsection
@section('adminContent')
    @include('admin/nienkhoa/tab')
    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-plus-circle adminBoxTitleIcon mr-2"></i>Thêm loại học kì </h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
             </div>
            <div class="adminFormAddBox">
                <form action="{{route('loaihocky.store')}}" method = "post" class="adminFormAdd" >
                    @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Niên khóa</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="nienkhoa" id = "yeaOfCourse" class="formSelect">
                                            <option  selected  value="{{$nienkhoa->id}}">{{$nienkhoa->NamBatDau . ' - ' .$nienkhoa->NamKetThuc}}</option>
                                        </select>
                                        <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                    </div>
                                    @if ($errors->has('nienkhoa')) 
                                        <div class="notiFail" role="alert">{{$errors->first('nienkhoa')}}</div>
                                     @endif
                                </td>
                                <td><p class="adminFormAddText">Học kì</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="hocky" id="semester"  class="formSelect">
                                        @foreach ($nienkhoa->HocKy as $hk)
                                            <option @if ($hk->TrangThai == 1) selected @endif
                                                value="{{$hk->id}}">{{$hk->TenHK}}</option>
                                        @endforeach
                                        </select>
                                        <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                    </div>
                                    @if ($errors->has('hocky')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('hocky')}} </div>
                                     @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Mã loại học kì</p></td>
                                <td><input type="text" name="MaLoaiHK" value="{{$text_id}}" class="formInput formInputMa codeTypeSemester">
                                    @if ($errors->has('MaLoaiHK')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('MaLoaiHK')}} </div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Tên loại học kì</p></td>
                                <td><input type="text" name="TenLoaiHK" class="formInput ">
                                    @if ($errors->has('TenLoaiHK')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('TenLoaiHK')}} </div>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submit" class="px-2 py-1 border-0 rounded modalBtn mr-1">Thực hiện</button>
                        <a href = "admin/loaihocky" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
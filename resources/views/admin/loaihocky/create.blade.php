@extends('admin/layouts/index')
@section('title')Thêm loại học kỳ @endsection
@section('adminContent')
    @include('admin/nienkhoa/tab')
    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-plus-circle adminBoxTitleIcon mr-2"></i>Thêm loại học kỳ </h6>
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
                                            @foreach ($nienkhoa as $item)
                                                <option @if ($item->TrangThai == 1) selected @endif value="{{$item->id}}">{{$item->NamBatDau . ' - ' .$item->NamKetThuc}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                    </div>
                                    @if ($errors->has('nienkhoa')) 
                                        <div class="notiFail" role="alert">{{$errors->first('nienkhoa')}}</div>
                                     @endif
                                </td>
                                <td><p class="adminFormAddText">Học kỳ</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="hocky" id="semester"  class="formSelect">
                                            @foreach ($nienkhoa as $nk)
                                                @if ($nk->TrangThai == 1)
                                                    @foreach ($nk->HocKy as $hk)
                                                        <option class = "formBoxSelectOption"  @if ($hk->TrangThai == 1) selected @endif value="{{$hk->id}}">{{$hk->TenHK}}</option>
                                                    @endforeach
                                                @endif
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
                                <td><p class="adminFormAddText">Mã loại học kỳ</p></td>
                                <td><input type="text" name="MaLoaiHK" value="{{$text_id}}" class="formInput formInputMa codeTypeSemester">
                                    @if ($errors->has('MaLoaiHK')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('MaLoaiHK')}} </div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Tên loại học kỳ</p></td>
                                <td><input type="text" name="TenLoaiHK" class="formInput ">
                                    @if ($errors->has('TenLoaiHK')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('TenLoaiHK')}} </div>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submmit" class="adminFormAddBtn">Thêm</button>
                        <a href = "admin/loaihocky" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
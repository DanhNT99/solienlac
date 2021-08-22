@extends('admin/layouts/index')
@section('title')Chỉnh sửa loại học kì @endsection
@section('adminContent')
    @include('admin/nienkhoa/tab')
    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-edit adminBoxTitleIcon"></i>chỉnh sửa loại học kì</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
             </div>

            <div class="adminFormAddBox">
                <form action="{{route('loaihocky.update', '')}}/ {{$loaihocky->id}}" method = "post" class="adminFormAdd" >
                   @method('PATCH') @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Niên khóa</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="nienkhoa" id = "yeaOfCourse" class="formSelect">
                                            @foreach ($nienkhoa as $item)
                                            @if ($item->id == $loaihocky->HocKy->NienKhoa->id)
                                                <option  value="{{$item->id}}">{{$item->NamBatDau . ' - ' .$item->NamKetThuc}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                    </div>
                                </td>
                                <td><p class="adminFormAddText">Học kì</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="hocky" id="semester"  class="formSelect">
                                            <option class = "formBoxSelectOption" value="{{$loaihocky->HocKy->id}}">{{$loaihocky->HocKy->TenHK}}</option>
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
                                <td><input type="text" name="MaLoaiHK" value="{{$loaihocky->MaLoaiHK}}" class="formInput formInputMa codeTypeSemester">
                                </td>
                                <td><p class="adminFormAddText">Tên loại học kì</p></td>
                                <td>
                                    <input type="text" name="TenLoaiHK"  value = "{{$loaihocky->TenLoaiHK}}"class="formInput">
                                    @if ($errors->has('TenLoaiHK')) 
                                        <div class="notiFail" role="alert">{{$errors->first('TenLoaiHK')}}</div>
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
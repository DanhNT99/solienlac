@extends('admin/layouts/index')
@section('title')Chỉnh sửa loại học kỳ @endsection
@section('adminContent')
    @include('admin/nienkhoa/tab')
    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-edit adminBoxTitleIcon"></i>chỉnh sửa loại học kỳ</h6>
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
                                                <option @if ($item->id == $loaihocky->HocKy->NienKhoa->id) selected @endif value="{{$item->id}}">{{$item->NamBatDau . ' - ' .$item->NamKetThuc}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                    </div>
                                </td>
                                <td><p class="adminFormAddText">Học kỳ</p></td>
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
                                <td><p class="adminFormAddText">Mã loại học kỳ</p></td>
                                <td><input type="text" name="MaLoaiHK" value="{{$loaihocky->MaLoaiHK}}" class="formInput formInputMa codeTypeSemester">
                                </td>
                                <td><p class="adminFormAddText">Tên loại học kỳ</p></td>
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
                        <button type="submit" class="px-3 py-1 border-0 rounded modalBtn mr-2">Thực hiện</button>
                        <a href = "admin/loaihocky" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
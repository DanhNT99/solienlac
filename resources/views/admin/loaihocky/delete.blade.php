@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/nienkhoa/tab')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Xóa loại học kỳ
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="{{route('loaihocky.destroy', '')}}/{{$loaihocky->id}}" method = "post" class="adminFormAdd" >
                    @method('DelETE') @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Niên khóa</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="nienkhoa" id = "yeaOfCourse" class="formSelect formInputMa">
                                                <option>{{$loaihocky->HocKy->NienKhoa->NamBatDau . ' - ' .$loaihocky->hocKy->NienKhoa->NamKetThuc}}</option>
                                        </select>
                                        <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                    </div>
                                </td>
                                <td><p class="adminFormAddText">Học kỳ</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="hocky" id="semester"  class="formSelect formInputMa">
                                            <option>{{$loaihocky->HocKy->TenHK}}</option>
                                        </select>
                                        <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Mã loại học kỳ</p></td>
                                <td><input type="text" value="{{$loaihocky->MaLoaiHK}}" class="formInput formInputMa"> </td>
                                <td><p class="adminFormAddText">Tên loại học kỳ</p></td>
                                <td><input type="text" value="{{$loaihocky->TenLoaiHK}}" class="formInput formInputMa"></td>
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
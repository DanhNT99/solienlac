@extends('admin/layouts/index')
@section('title')Xóa môn học @endsection
@section('adminContent')
    @include('admin/khoi/tab')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Chỉnh sửa lớp
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="{{route('monhoc.destroy', '')}}/{{$monhoc->id}}" method = "post" class="adminFormAdd" >
                     @method('DELETE') @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã môn học</p></td>
                                <td><input type="text" value="{{$monhoc->MaMH}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Tên môn học</p></td>
                                <td>
                                    <input type="text" value="{{$monhoc->TenMH}}" class="formInput formInputMa">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submit" class="px-3 py-1 border-0 rounded modalBtn mr-2">Thực hiện</button>

                        <a href = "admin/monhoc" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
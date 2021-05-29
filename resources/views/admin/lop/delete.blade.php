@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/khoi/tab')

    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Chi tiết lớp
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">

                <form action="{{route('lop.destroy', '')}}/{{$lop->id}}" method="post" class = "adminFormAdd">
                    @method('DELETE') @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã lớp</p></td>
                                <td> <input disabled type="text" name="MaKhoi" value="{{$lop->MaLop}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Tên lớp</p></td>
                                <td>
                                    <input disabled type="text" name="TenLop" value = "{{$lop->TenLop}}" class="formInput capitalize">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submit" class="px-3 py-1 border-0 rounded modalBtn mr-2">Thực hiện</button>
                        <a href = "admin/khoi" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
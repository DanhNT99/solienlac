@extends('admin/layouts/index')
@section('title')Chi tiết lớp @endsection
@section('adminContent')
    @include('admin/banhoc/tab')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Chi tiết lớp
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form class = "adminFormAdd">
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã lớp</p></td>
                                <td> <input disabled type="text" name="MaLop" value="{{$lop->MaLop}}" class="formInput"></td>
                                <td><p class="adminFormAddText">Tên lớp</p></td>
                                <td>
                                    <input disabled type="text" name="TenLop" value = "{{$lop->TenLop}}" class="formInput capitalize">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <a href = "admin/lop" class="adminFormAddLink">Quay lại</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
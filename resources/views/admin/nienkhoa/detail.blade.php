@extends('admin/layouts/index')
@section('title') Chi tiết niên khóa @endsection
@section('adminContent')
    @include('admin/layouts/tab')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Chi tiết niên khóa
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form class = "adminFormAdd">
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                 <td><p class="adminFormAddText">Năm kết thúc</p></td>
                                <td><input disabled type="text" value="{{$nienkhoa->NamKetThuc}}" class="formInput"></td>
                                <td><p class="adminFormAddText">Năm bất đầu</p></td>
                                <td>
                                    <input disabled type="text" value = "{{$nienkhoa->NamBatDau}}" class="formInput capitalize">
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Mã niên khóa</p></td>
                                <td> <input disabled type="text" value="{{$nienkhoa->MaNK}}" class="formInput"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <a href = "admin/nienkhoa" class="adminFormAddLink">Quay lại</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
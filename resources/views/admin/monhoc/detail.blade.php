@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/banhoc/tab')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Chi tiết môn học
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form class = "adminFormAdd">
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã môn học</p></td>
                                <td> <input disabled type="text" name="MaMH" value="{{$monhoc->MaMH}}" class="formInput"></td>
                                <td><p class="adminFormAddText">Tên môn học</p></td>
                                <td>
                                    <input disabled type="text" name="TenMH" value = "{{$monhoc->TenMH}}" class="formInput capitalize">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <a href = "admin/monhoc" class="adminFormAddLink">Quay lại</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
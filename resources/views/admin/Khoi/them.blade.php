@extends('admin/layouts/index')

@section('adminContent')

    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Thêm khối
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="" class="adminFormAdd">
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã khối</p></td>
                                <td> <input type="text" name="" class="adminFormSearchInput" placeholder="Mã khối..." id=""></td>
                                <td><p class="adminFormAddText">Tên khối</p></td>
                                <td> <input type="text" name="" class="adminFormSearchInput" placeholder="Tên khối..." id=""></td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submmit" class="adminFormAddBtn">Thêm</button>
                        <a href = "admin/khoi/danhsach" class="adminFormAddLink">Quay lại</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@extends('admin/layouts/index')

@section('adminContent')

    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Thêm lớp học
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="" class="adminFormAdd">
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã lớp</p></td>
                                <td> <input type="text" name="" class="adminFormSearchInput" placeholder="Mã lớp..." id=""></td>
                                <td><p class="adminFormAddText">Tên lớp</p></td>
                                <td> <input type="text" name="" class="adminFormSearchInput" placeholder="Tên lớp..." id=""></td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Khối</p></td>
                                <td>
                                    <div class="adminFormSearchBoxSelect">
                                        <select name="Khoi" id="" class="adminFormSelect">
                                            <option selected disabled>Tất cả</option>
                                            <option value="1">Khối 1</option>
                                            <option value="2">Khối 2</option>
                                            <option value="3">Khối 3</option>
                                            <option value="4">Khối 4</option>
                                            <option value="5">Khối 5</option>
                                        </select>
                                        <div class="adminFormSelectIcon">
                                            <i class="fas fa-caret-down"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submmit" class="adminFormAddBtn">Thêm</button>
                        <a href = "admin/lop/danhsach" class="adminFormAddLink">Quay lại</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@extends('admin/layouts/index')

@section('adminContent')

    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Thêm phụ huynh
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="" class="adminFormAdd">
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Mã phụ huynh</p></td>
                                <td> <input type="text" name="" class="adminFormSearchInput" placeholder="Mã phụ huynh..." id=""></td>
                                <td><p class="adminFormAddText">Họ và tên</p></td>
                                <td> <input type="text" name="" class="adminFormSearchInput" placeholder="Họ và tên..." id=""></td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Giới tính</p></td>
                                <td>
                                    <div class="adminFormSearchBoxSelect">
                                        <select name="GioiTinh" id="" class="adminFormSelect">
                                            <option value="1">Nam</option>
                                            <option value="2">Nữ</option>
                                        </select>
                                        <div class="adminFormSelectIcon">
                                            <i class="fas fa-caret-down"></i>
                                        </div>
                                    </div>
                                </td>
                                <td><p class="adminFormAddText">Số điện thoại</p></td>
                                <td> <input type="text" name="" class="adminFormSearchInput" placeholder="Số điện thoại..." id=""></td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Nghề nghiệp</p></td>
                                <td> <input type="text" name="" class="adminFormSearchInput" placeholder="Nghề nghiệp..." id=""></td>
                                <td><p class="adminFormAddText">Nơi làm việc</p></td>
                                <td> <input type="text" name="" class="adminFormSearchInput" placeholder="Nơi làm việc..." id=""></td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submmit" class="adminFormAddBtn">Thêm</button>
                        <a href = "admin/phuhuynh/danhsach" class="adminFormAddLink">Quay lại</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
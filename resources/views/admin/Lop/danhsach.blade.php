@extends('admin/layouts/index')

@section('adminContent')

    <section class="adminForm">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-search-plus"></i>
                Tìm kiếm thông tin Lớp
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span></h3>
            <div class="adminContainsFormSearch">
                <form action="" class="adminFormSearch">
                    <table class="adminFormSeachTable">
                        <tr>
                            <td><p class="adminFormSearchText">Khối</p></td>
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
                            <td><p class="adminFormSearchText">Tên lớp</p></td>
                            <td> <input type="text" name="" class="adminFormSearchInput" placeholder="Tên lớp..." id=""></td>
                        </tr>
                        <tr>
                            <td><p class="adminFormSearchText">Mã lớp</p></td>
                            <td> <input type="text" name="" class="adminFormSearchInput" placeholder="Mã lớp..." id=""></td>
                        </tr>
                    </table>
                    <div class="adminFormSearchContainsBtn">
                        <button class="adminFormSearchBtn">Tìm kiếm</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Danh sách lớp học</h3>
            <div class="adminActive">
                <a href="admin/lop/them" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Thêm</a>
                <a href="#" class="adminActiveItem"><i class="far fa-times-circle"></i> Xóa</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã lớp</th>
                    <th>Tên lớp</th>
                    <th>Tên khối</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>L01</td>
                    <td>Lớp 4A1</td>
                    <td>Khối 4</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>L02</td>
                    <td>Lớp 3A1</td>
                    <td>Khối 3</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>L03</td>
                    <td>Lớp 2A1</td>
                    <td>Khối 2</td>
                </tr>
            </table>
        </div>
    </section>
@endsection
@extends('admin/layouts/index')

@section('adminContent')

    <section class="adminForm">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-search-plus"></i>
                Tìm kiếm thông tin khối
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span></h3>
            <div class="adminContainsFormSearch">
                <form action="" class="adminFormSearch">
                    <table class="adminFormSeachTable">
                        <tr>
                            <td><p class="adminFormSearchText">Khối</p></td>
                            <td>
                                <input type="text" name="" class="adminFormSearchInput" placeholder="Tên khối..." id=""></td>
                            </td>
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
            <h3 class="adminListTitle">Danh sách khối</h3>
            <div class="adminActive">
                <a href="admin/khoi/them" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Thêm</a>
                <a href="#" class="adminActiveItem"><i class="far fa-times-circle"></i> Xóa</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã khối</th>
                    <th>Tên khối</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>K01</td>
                    <td>Khối 4</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>K02</td>
                    <td>Khối 3</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>K03</td>
                    <td>Khối 2</td>
                </tr>
            </table>
        </div>
    </section>
@endsection
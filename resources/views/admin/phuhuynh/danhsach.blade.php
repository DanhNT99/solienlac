@extends('admin/layouts/index')

@section('adminContent')

    <section class="adminForm">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-search-plus"></i>
                Tìm kiếm thông tin phụ huynh
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span></h3>
            <div class="adminContainsFormSearch">
                <form action="" class="adminFormSearch">
                    <table class="adminFormSeachTable">
                        <tr>
                            <td><p class="adminFormSearchText">Mã phụ huynh</p></td>
                            <td>                 
                                <input type="text" name="" class="adminFormSearchInput" placeholder="Mã phụ huynh..." id="">
                            </td>
                            <td><p class="adminFormSearchText">Họ và tên</p></td>
                            <td> <input type="text" name="" class="adminFormSearchInput" placeholder="Họ và tên..." id=""></td>
                        </tr>
                        <tr>
                            <td><p class="adminFormSearchText">Giới Tính</p></td>
                            <td>
                                <div class="adminFormSearchBoxSelect">
                                    <select name="Lop" id="" class="adminFormSelect">
                                        <option selected disabled>Tất cả</option>
                                        <option value="1">Nam</option>
                                        <option value="2">Nữ</option>
                                    </select>
                                    <div class="adminFormSelectIcon">
                                        <i class="fas fa-caret-down"></i>
                                    </div>
                                </div>
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
            <h3 class="adminListTitle">Danh sách phụ huynh</h3>
            <div class="adminActive">
                <a href="admin/phuhuynh/them" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Thêm</a>
                <a href="#" class="adminActiveItem"><i class="far fa-times-circle"></i> Xóa</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã phụ huynh</th>
                    <th>Họ và tên</th>
                    <th>Giới tính</th>
                    <th>Địa chỉ</th>
                    <th>Xem chi tiết</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>PH01</td>
                    <td>Nguyễn Thị Nhật Trinh</td>
                    <td>Nam</td>
                    <td>253 Lê Quý Đôn, Tp. Nha trang</td>
                    <td><a href="#">Chi tiết</a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>PH02</td>
                    <td> Nguyễn Thị Tùng</td>
                    <td>Nam</td>
                    <td>15 Cao Bá Quát, Tp. Nha trang</td>
                    <td><a href="#">Chi tiết</a></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>PH03</td>
                    <td>Nguyễn Đức Anh </td>
                    <td>Nữ</td>
                    <td>15 Cao Bá Quát, Tp. Nha trang</td>
                    <td><a href="#">Chi tiết</a></td>
                </tr>
            </table>
        </div>
    </section>
@endsection
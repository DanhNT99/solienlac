@extends('admin/layouts/index')

@section('adminContent')

    <section class="adminForm">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-search-plus adminBoxTitleIcon"></i>
                Tìm kiếm thông tin học sinh
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span></h3>
            <div class="adminContainsFormSearch">
                <form action="" class="adminFormSearch">
                    <table class="adminFormSeachTable">
                        <tr>
                            <td class=""><p class="adminFormSearchText">Khối</p></td>
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
                            <td><p class="adminFormSearchText">Lớp</p></td>
                            <td>
                                <div class="adminFormSearchBoxSelect">
                                    <select name="Lop" id="" class="adminFormSelect">
                                        <option selected disabled>Tất cả</option>
                                        <option value="1">Lớp 4A1</option>
                                        <option value="2">Lớp 3A1</option>
                                        <option value="3">Lớp 2A1</option>
                                        <option value="4">Lớp 3A1</option>
                                        <option value="5">Lớp 4A1</option>
                                    </select>
                                    <div class="adminFormSelectIcon">
                                        <i class="fas fa-caret-down"></i>
                                    </div>
                                </div>
                            </td>
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
                            <td><p class="adminFormSearchText">Họ và tên</p></td>
                            <td> <input type="text" name="" class="adminFormSearchInput" placeholder="Họ và tên..." id=""></td>
                        </tr>
                        <tr>
                            <td><p class="adminFormSearchText">Mã học sinh</p></td>
                            <td>                 
                                <input type="text" name="" class="adminFormSearchInput" placeholder="Mã học sinh..." id="">
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
            <h3 class="adminListTitle">Danh sách học sinh</h3>
            <div class="adminActive">
                <a href="admin/hocsinh/them" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Thêm</a>
                <a href="#" class="adminActiveItem"><i class="far fa-times-circle"></i> Xóa</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã học sinh</th>
                    <th>Họ và tên</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Lớp</th>
                    <th>Địa chỉ</th>
                    <th>Xem chi tiết</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>HS01</td>
                    <td>Nguyễn Tài Danh</td>
                    <td>Nam</td>
                    <td>15/07/1999</td>
                    <td>4A1</td>
                    <td>253 Lê Quý Đôn, Tp. Nha trang</td>
                    <td><a href="#">Chi tiết</a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>HS02</td>
                    <td>Lê Viết	Phê</td>
                    <td>Nam</td>
                    <td>08-10-1997</td>
                    <td>5B1</td>
                    <td>15 Cao Bá Quát, Tp. Nha trang</td>
                    <td><a href="#">Chi tiết</a></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>HS03</td>
                    <td>Bạch Quý Châu</td>
                    <td>Nữ</td>
                    <td>28-01-1997</td>
                    <td>3B1</td>
                    <td>15 Cao Bá Quát, Tp. Nha trang</td>
                    <td><a href="#">Chi tiết</a></td>
                </tr>
            </table>
        </div>
    </section>
@endsection
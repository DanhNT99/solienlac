@extends('admin/layouts/index')

@section('adminContent')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Thêm giáo viên
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="" class="adminFormAdd">
                    <div class="adminFormAddContains">
                        <div class="adminFormAddContainsImg wrapImgResize">
                            <img src="{{asset('assets/images/iconAva.jpg')}}" class="adminFormAddImg" alt="">
                            <div class="adminFormAddContainsIcon">
                                <p><i class="fas fa-camera-retro"></i> Tải hình</p>
                            </div>
                        </div>
                        <input type="file" class="adminFormAddFileImg">
                        <table class="adminFormAddTable">
                            <tr>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Mã giáo viên</p></td>
                                <td> <input type="text" name="" class="adminFormSearchInput" placeholder="Mã giáo viên..." id=""></td>
                                <td><p class="adminFormAddText">Họ và tên</p></td>
                                <td> <input type="text" name="" class="adminFormSearchInput" placeholder="Họ và tên..." id=""></td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Ngày sinh</p></td>
                                <td> <input type="date" name="" class="adminFormSearchInput" placeholder="Họ và tên..." id=""></td>
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
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Địa chỉ</p></td>
                                <td> <input type="text" name="" class="adminFormSearchInput" placeholder="Địa chỉ..." id=""></td>
                                <td><p class="adminFormAddText">Số điện thoại</p></td>
                                <td> <input type="text" name="" class="adminFormSearchInput" placeholder="Số điện thoại..." id=""></td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submmit" class="adminFormAddBtn">Thêm</button>
                        <a href = "admin/giaovien/danhsach" class="adminFormAddLink">Quay lại</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
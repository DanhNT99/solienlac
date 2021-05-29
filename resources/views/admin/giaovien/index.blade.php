@extends('admin/layouts/index')

@section('adminContent')

    @include('admin/giaovien/tab')
    <section class="adminForm">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-search-plus"></i>
                Tìm kiếm thông tin giáo viên
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span></h3>
            <div class="adminContainsFormSearch">
                <form action="{{route('searchTeach')}}" class="adminFormSearch">
                    <table class="adminFormSeachTable">
                        <tr>
                            {{-- <td><p class="adminFormSearchText">Lớp</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="Lop" id="" class="formSelect">
                                        <option selected disabled>Tất cả</option>
                                        @foreach ($lop as $item)
                                             <option value="{{$item->id}}">{{$item->TenLop}}</option>
                                        @endforeach
                                    </select>
                                    <div class="formSelectIcon">
                                        <i class="fas fa-caret-down"></i>
                                    </div>
                                </div>
                            </td> --}}
                            {{-- <td><p class="adminFormSearchText">Giới Tính</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="GioiTinh" id="" class="formSelect">
                                        <option selected disabled>Tất cả</option>
                                        <option value="Nam">Nam</option>
                                        <option value="Nu">Nữ</option>
                                    </select>
                                    <div class="formSelectIcon">
                                        <i class="fas fa-caret-down"></i>
                                    </div>
                                </div>
                            </td> --}}
                        </tr>
                        <tr>
                            <td><p class="adminFormSearchText">Mã Giáo viên</p></td>
                            <td>                 
                                <input type="text" name="MaGV" class="formInput" placeholder="Mã giáo viên">
                            </td>
                            <td><p class="adminFormSearchText">Tên giáo viên</p></td>
                            <td> <input type="text" name="TenGV" class="formInput" placeholder="Họ và tên"></td>
                        </tr>
                        <tr>
                          

                            <td><p class="adminFormSearchText">Giới Tính</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="GioiTinh" id="" class="formSelect">
                                        <option selected disabled>Tất cả</option>
                                        <option value="Nam">Nam</option>
                                        <option value="Nu">Nữ</option>
                                    </select>
                                    <div class="formSelectIcon">
                                        <i class="fas fa-caret-down"></i>
                                    </div>
                                </div>
                            </td>
                              <td><p class="adminFormSearchText">Phường</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="Phuong" id="" class="formSelect">
                                        <option selected disabled>Lựa chọn</option>
                                        @foreach ($phuong as $item)
                                            <option value="{{$item->id}}">{{$item->TenPhuong}}</option>
                                        @endforeach
                                    </select>
                                    <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
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
            <h3 class="adminListTitle">Danh sách giáo viên</h3>
            <div class="adminActive">
                <a href="admin/giaovien/create" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Thêm</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã giáo viên</th>
                    <th>Họ và tên</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Chọn</th>
                </tr>
                @foreach ($giaovien as $item)
                <tr class="trContainsBox">
                    <td>{{$stt++}}</td>
                    <td>{{$item->MaGV}}</td>
                    <td>{{$item->HoGV . ' ' . $item->TenGV}}</td>
                    <td>@if ($item->GioiTinh == 'Nu') Nữ
                        @else Nam @endif</td>
                    <td>{{$item->NgaySinh}}</td>
                    <td>{{$item->DiaChi}}</td>
                    <td>{{$item->SoDT}}</td>
                    <td>
                        <a href="admin/giaovien/{{$item->id}}"><i class="fas fa-info-circle"></i></a>
                        <a href="admin/giaovien/{{$item->id}}/edit"><i class="fas fa-edit"></i></a>
                        <a href="admin/giaovien/{{$item->id}}/delete"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </table>
            {!!$giaovien->Links()!!}
        </div>
    </section>
@endsection
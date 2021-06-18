@extends('admin/layouts/index')
@section('title') Sổ liên lạc @endsection
@section('adminContent')
    @include('admin/layouts/tab')
    <section class="adminForm">
       
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-search-plus adminBoxTitleIcon"></i>
                    Tìm kiếm thông tin học sinh</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
             </div>
        </div>
    </section>

    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Sổ liên lạc học sinh</h3>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã SLL</th>
                    <th>Mã học sinh</th>
                    <th>Tên học sinh</th>
                    <th>Niên khóa</th>
                    <th>Học lực</th>
                    <th>Nhận xét</th>
                    <th>Chọn</th>
                </tr>
                @if (Auth::guard('giao_vien')->user()->hasrole('Giáo viên chủ nhiệm'))
                    @foreach ($giaovien->Hoc->where('id_nienkhoa', $nienkhoa->id) as $item)
                        <tr>
                            <td>{{$stt++}}</td>
                            <td>{{$item->HocSinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->MaSLL}}</td>
                            <td>{{$item->HocSinh->MaHS}}</td>
                            <td>{{$item->HocSinh->HoHS . ' ' . $item->HocSinh->TenHS}}</td>
                            <td>{{$item->HocSinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->NienKhoa->NamBatDau . '-' .
                                $item->HocSinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->NienKhoa->NamKetThuc}}</td>
                            <td>
                                @if(count($item->HocSinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->NhanXet))
                                    @if ($item->HocSinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->NhanXet->first()->HocLuc)
                                        Đã đánh giá
                                    @else Chưa đánh giá @endif
                                @else Chưa đánh giá @endif
                            </td>
                            <td>
                                @if(count($item->HocSinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->NhanXet))
                                    @if ($item->HocSinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->NhanXet->first()->NhanXet)
                                        Đã đánh giá
                                    @else Chưa đánh giá @endif
                                @else Chưa đánh giá @endif
                            </td>
                            <td>
                                <a href="admin/solienlac/{{$item->HocSinh->id}}/edit">đánh giá</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if (Auth::guard('giao_vien')->user()->hasrole('Quản trị viên'))
                    @foreach ($solienlac->where('id_nienkhoa', $nienkhoa->id) as $item)
                        <tr>
                            <td>{{$stt++}}</td>
                            <td>{{$item->MaSLL}}</td>
                            <td>{{$item->HocSinh->MaHS}}</td>
                            <td>{{$item->HocSinh->HoHS . ' ' . $item->HocSinh->TenHS}}</td>
                            <td>{{$item->NienKhoa->NamBatDau . '- ' . $item->NienKhoa->NamKetThuc}}</td>
                            <td>
                                @if ($item->NhanXet->first()) Đã nhập
                                @else Chưa nhập @endif
                            </td>
                            <td>
                                @if ($item->NhanXet->first()) Đã nhập @else Chưa nhập @endif
                            </td>
                            <td>
                                <a href="admin/solienlac/{{$item->HocSinh->id}}">Xem chi tiết</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </section>

    @if (Session::has('noti'))
        <div class="notiBox">
        <h4 class="notiBoxTitle">Thông báo <button class="notiBoxBtn"><i class="far fa-window-close"></i></button></h4>
        <p class="notiBoxContent"> {{Session('noti')}}!</p>
        </div>
    @endif
@endsection
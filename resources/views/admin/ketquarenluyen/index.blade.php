@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/layouts/tab')

    <section class="adminForm">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-search-plus adminBoxTitleIcon"></i>
                Tìm kiếm thông tin học sinh
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span></h3>
            <div class="adminContainsFormSearch">
                <form action="{{route('searchStudent')}}" class="adminFormSearch" method = "get">
                    <table class="adminFormSeachTable">
                        <tr>
                            <td><p class="adminFormSearchText">Khối</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="" class="formSelect formInputMa">
                                       @foreach ($giaovien->Lop as $item)
                                            <option class="formBoxSelectOption" value="{{$item->Khoi->id}}">{{$item->Khoi->TenKhoi}}</option>
                                        @endforeach
                                    </select>
                                    <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                </div>
                            </td>
                            </td>
                            <td><p class="adminFormSearchText">Lớp</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="" class="formSelect formInputMa">
                                    @foreach ($giaovien->Lop as $item)
                                        <option class="formBoxSelectOption" value="{{$item->id}}">{{$item->TenLop}}</option>
                                    @endforeach
                                    </select>
                                    <div class="formSelectIcon"><i class="fas fa-caret-down"></i> </div>
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
            <h3 class="adminListTitle">Danh sách kết quả rèn luyện</h3>
            <div class="adminActive">
                <a href="admin/ketquarenluyen/create" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Đánh giá</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã học sinh</th>
                    <th>Họ tên học sinh</th>
                    <th>Tên PCNL</th>
                    <th>Loai PCNL</th>
                    <th>Học kỳ</th>
                    <th>Mức đạt được</th>
                </tr>
                @foreach ($giaovien->Hoc as $hoc)
                    @foreach ($hoc->HocSinh->SoLienLac->KetQuaRenLuyen as $item)
                        <tr>
                            <td>{{$stt++}}</td>
                            <td>
                                {{$item->SoLienLac->HocSinh->MaHS}}
                            </td>
                            <td>
                                {{$item->SoLienLac->HocSinh->HoHS . ' ' . $item->SoLienLac->HocSinh->TenHS}}
                            </td>
                            <td>{{$item->PCNL->TenPCNL}}</td>
                            <td>@if ($item->PCNL->LoaiPCNL)Năng lực @else Phầm chất @endif</td>
                            <td>@if ($item->id_loaihocky) {{$item->LoaiHK->TenLoaiHK}} 
                                @else Chưa có @endif</td>
                            <td>{{$item->XepLoai}}</td>
                        </tr>
                    @endforeach
                @endforeach
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
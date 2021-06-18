@extends('admin/layouts/index')
@section('title')Kết quả rèn luyện @endsection
@section('adminContent')
    @include('admin/layouts/tab')
    <section class="adminForm">
        <div class="container">
            <div class="adminBoxTitle">
                <div class="yearOfCourse">Năm học: {{$nienkhoa->NamBatDau . '- ' . $nienkhoa->NamKetThuc}}</div>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="adminContainsFormSearch">
                <div class="px-4 d-flex">
                    <div class="mr-2 mt-0 mx-0 btnClass">
                        Lớp : {{$giaovien->Lop->TenLop}}
                        <input type = "text" class = "d-none inputClass" value = "{{$giaovien->Lop->id}}"/>
                    </div>
                    @foreach ($nienkhoa->HocKy as $item)
                        @if ($item->TrangThai)<div class = "mt-0 mx-0 btnClass d-flex">{{$item->TenHK}}</div>@endif
                    @endforeach
                </div>
                {{-- <form action="{{route('searchStudent')}}" class="adminFormSearch" method = "get">
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
                </form> --}}
            </div>
        </div>
    </section>

    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Danh sách đánh giá rèn luyện</h3>
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
                    <th>Loại học kỳ</th>
                    <th>Mức đạt được</th>
                </tr>
                @foreach ($giaovien->Hoc->where('id_nienkhoa', $nienkhoa->id) as $hoc)
                    @foreach ($hoc->HocSinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->KetQuaRenLuyen as $item)
                        <tr>
                            <td>{{$stt++}}</td>
                            <td>
                                {{$item->SoLienLac->HocSinh->MaHS}}
                            </td>
                            <td>
                                {{$item->SoLienLac->HocSinh->HoHS . ' ' . $item->SoLienLac->HocSinh->TenHS}}
                            </td>
                            <td>{{$item->PCNL->TenPCNL}}</td>
                            <td>@if ($item->PCNL->LoaiPCNL == 1) Năng lực @else Phẩm chất @endif</td>
                            <td>{{$item->LoaiHK->TenLoaiHK}}</td>
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
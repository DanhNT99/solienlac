@extends('admin/layouts/index')
@section('title') Kết quả học tập @endsection
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
                        Lớp : {{$giaovien->Lop->first()->TenLop}}
                        <input type = "text" class = "d-none inputClass" value = "{{$giaovien->Lop->first()->id}}"/>
                    </div>
                    <div class = "mt-0 mx-0 btnClass d-flex">
                        @foreach ($nienkhoa->HocKy as $item)
                            @if ($item->TrangThai) 
                                <div >{{$item->TenHK}}</div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="mt-2">
                    <p class = "px-4">Chọn môn học: </p>
                    <ul class="d-flex w-90 px-5 flex-wrap mx-auto">
                        @foreach ($giaovien->Lop->Khoi->PhanMonHoc as $item)
                            <li class="mr-2">
                                <a href = "admin/timkiemketquahoctap/{{$item->MonHoc->id}}"  @if ($item->MonHoc->id == $idSubject) class = "btnSubject boxSubjectActive " 
                                    @else class = "btnSubject"  @endif>{{$item->MonHoc->TenMH}}</a>
                            </li>
                        @endforeach   
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Danh sách kết quả học tập</h3>
            <div class="adminActive">
                <a href="admin/ketquahoctap/create" class="adminActiveItem"><i class="fas fa-plus-circle"></i>Nhập điểm</a>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th rowspan="2">Mã học sinh</th>
                    <th rowspan="2">Tên học sinh</th>
                    @foreach ($nienkhoa->HocKy as $hk)
                        @if ($hk->TrangThai)
                            @foreach ($hk->LoaiHocKy as $lhk)
                                <th colspan="2">{{$lhk->TenLoaiHK}}</option>
                            @endforeach
                        @endif
                   @endforeach
                </tr>
                <tr>
                    @foreach ($nienkhoa->HocKy as $hk)
                        @if ($hk->TrangThai)
                            @foreach ($hk->LoaiHocKY as $lhk)
                                <th>Mức đạt được</th>
                                <th>Điểm KTHK</th>
                            @endforeach
                        @endif
                    @endforeach
                </tr>
                @foreach ($giaovien->Hoc as $hoc)
                    <tr>
                        <td>{{$hoc->HocSinh->MaHS}}</td>
                        <td>
                            {{$hoc->HocSinh->HoHS . ' ' . $hoc->HocSinh->TenHS}}
                        </td>

                        @foreach ($nienkhoa->HocKy as $hk)
                            @if ($hk->TrangThai)
                                @foreach ($hk->LoaiHocKy as $lhk)
                                    <td class = "mucdatduoc">
                                        {{-- in ra điểm --}}
                                        @foreach ($kqht as $kq)
                                            @if ($kq->id_loaihocky == $lhk->id && $kq->id_sll == $hoc->HocSinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->id)
                                                @if ($kq->MucDatDuoc)
                                                    {{$kq->MucDatDuoc}}
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class = "diem">
                                        @foreach ($kqht as $kq)
                                            @if ($kq->id_loaihocky == $lhk->id && $kq->id_sll == $hoc->HocSinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->id)
                                                {{$kq->Diem}}
                                            @endif
                                        @endforeach
                                    </td>
                                @endforeach
                            @endif
                         @endforeach
                    </tr>
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
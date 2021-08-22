@extends('admin/layouts/index')
@section('title') Kết quả học tập @endsection
@section('adminContent')
    @include('admin/layouts/tab')
    <section class="adminForm">
        <div class="container-xl">
            <div class="adminBoxTitle py-1 px-2 mb-2" style="width: fit-content;">
                <span>Năm học : {{$nienkhoa->NamBatDau . ' - ' . $nienkhoa->NamKetThuc}}</span>
                <span class="mx-2">|</span>
                <span>{{$hocky->TenHK}}</span>
                <span class="mx-2">|</span>
                <span> Lớp: {{$giaovien->Lop->TenLop}}</span>
            </div>

            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="far fa-eye adminBoxTitleIcon mr-1"></i>Xem điểm</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="adminContainsFormSearch">
                <div class="mt-2">
                    <p class = "px-xl-4">Chọn môn học: </p>
                    <ul class="d-flex w-90 px-0 px-xl-5 flex-wrap mx-auto">
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
        <div class="container-xl">
            <h3 class="adminListTitle">Danh sách kết quả học tập</h3>
            <div class="adminActive">
                 <form action="admin/ketquahoctap/create" method = "get">
                    <input type="text" name="idSubject" value="{{$idSubject}}" class="d-none">
                    <button class="adminActiveItem  border-0 outline-none">
                        <i class="fas fa-plus-circle"></i> Nhập điểm
                    </button>
                </form>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th rowspan="2">Stt</th>
                    <th rowspan="2">Mã học sinh</th>
                    <th rowspan="2">Tên học sinh</th>
                    @foreach ($hocky->LoaiHocKy as $lhk)
                    <th colspan="2">{{$lhk->TenLoaiHK}}</option>
                    @endforeach
                </tr>
                <tr>
                    @foreach ($hocky->LoaiHocKY as $lhk)
                    <th>Mức đạt được</th>
                    <th>Điểm KTHK</th>
                    @endforeach
                </tr>
                @foreach ($giaovien->Hoc->where('id_nienkhoa', $nienkhoa->id) as $hoc)
                <tr>
                    <td>{{$stt++}}</td>
                    <td>{{$hoc->HocSinh->MaHS}}</td>
                    <td class = "text-left pl-3">{{$hoc->HocSinh->HoHS . ' ' . $hoc->HocSinh->TenHS}}</td>
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
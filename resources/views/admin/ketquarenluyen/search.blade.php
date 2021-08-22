@extends('admin/layouts/index')
@section('title') Kết quả rèn luyện @endsection
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
            <div class="adminContainsFormSearch">
                <div class="mt-2">
                    <p class = "px-4">Chọn phẩm chất năng lực: </p>
                     <ul class="d-flex w-90 px-5 flex-wrap mx-auto">
                         @foreach ($pcnl as $item)
                            <li class="mr-2">
                                <a href = "admin/timkiemketquarenluyen/{{$item->id}}"@if ($item->id == $idPCNL)
                                class = "btnSubject boxSubjectActive" @endif class = "btnSubject">{{$item->TenPCNL}}</a>
                            </li>
                         @endforeach   
                     </ul>
                 </div>
            </div>
        </div>
    </section>
    <section class="adminList">
        <div class="container-xl">
            <h3 class="adminListTitle">Danh sách kết quả rèn luyện</h3>
            <div class="adminActive">
                <form action="admin/ketquarenluyen/create" method = "get">
                    <input type="text" name="idPCNL" value="{{$idPCNL}}" class="d-none">
                    <button href="admin/ketquarenluyen/create" class="adminActiveItem  border-0 outline-none"><i class="fas fa-plus-circle"></i>Đánh giá</button>
                </form>
            </div>
            <table class="adminTable" border="1">
                <tr>
                    <th rowspan="2">Mã học sinh</th>
                    <th rowspan="2">Tên học sinh</th>
                    @foreach ($nienkhoa->HocKy as $hk)
                        @if ($hk->TrangThai)
                            @foreach ($hk->LoaiHocKy as $lhk)
                                <th>{{$lhk->TenLoaiHK}}</option>
                            @endforeach
                        @endif
                   @endforeach
                </tr>
                <tr>
                    @foreach ($nienkhoa->HocKy as $hk)
                        @if ($hk->TrangThai)
                            @foreach ($hk->LoaiHocKY as $lhk)
                                <th>Mức đạt được</th>
                            @endforeach
                        @endif
                    @endforeach
                </tr>
                @foreach ($giaovien->Hoc->where('id_nienkhoa', $nienkhoa->id) as $hoc)
                    <tr>
                        <td>{{$hoc->HocSinh->MaHS}}</td>
                        <td class="text-left pl-3">{{$hoc->HocSinh->HoHS . ' ' . $hoc->HocSinh->TenHS}}</td>

                        @foreach ($nienkhoa->HocKy as $hk)
                            @if ($hk->TrangThai)
                                @foreach ($hk->LoaiHocKy as $lhk)
                                    <td class = "mucdatduoc">
                                        {{-- in ra điểm --}}
                                        @foreach ($kqrl as $kq)
                                            @if ($kq->id_loaihocky == $lhk->id && $kq->id_sll == $hoc->HocSinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->id)
                                                @if ($kq->XepLoai)
                                                    {{$kq->XepLoai}}
                                                @endif
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
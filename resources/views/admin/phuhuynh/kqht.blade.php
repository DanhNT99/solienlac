@extends('admin/layouts/index')
@section('title') Xem kết quả học tập @endsection
@section('adminContent')
    <section class="scores">
        <div class="container">  
            <div class="adminContainsFormSearch">
                <form action="{{route('searchResultStudy')}}" class="adminFormSearch" method = "get">
                    <table class = "mx-auto my-2">
                        <tr>
                            <td><p class="adminFormAddText mx-3">Năm học</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="nienkhoa" class="formSelect formSelectSmall">
                                        @foreach ($dsNienKhoa as $item)
                                            <option @if ($item->TrangThai) selected @endif   value="{{$item->id}}"> 
                                                {{$item->NamBatDau . ' - ' . $item->NamKetThuc}}</option>
                                        @endforeach
                                    </select>
                                    <div class="formSelectIcon">
                                        <i class="fas fa-caret-down"></i>
                                    </div>
                                </div>
                            </td>
                            <td class="d-none">
                                <input type="text" name="idStudent" value =  {{$hocsinh->id}}>
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
    
    <section class="scores">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-edit adminBoxTitleIcon mr-1"></i>Chi tiết kết quả học tập của học sinh</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="col-12 scoresBox pt-2">
                <div class = "text-right"><a href="phuhuynh/index" class="btnClass ml-auto"><i class="fas fa-undo-alt mr-1"></i>Quay lại</a></div>
                <h3 class="title_main mt-2">Kết quả học tập các môn học</h3>
                <table  class="scores_table">
                    <tr>
                        <th rowspan="2">Môn học</th>
                        @foreach ($nienKhoaHienTai->HocKy as $hk)
                            @if ($hk->TrangThai == 1)
                                @foreach ($hocky->LoaiHocKy as $lhk)
                                    <th colspan="2">{{$lhk->TenLoaiHK}}</option>
                                @endforeach
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                    @foreach ($nienKhoaHienTai->HocKy as $hk)
                            @if ($hk->TrangThai == 1)
                                @foreach ($hk->LoaiHocKy as $lhk)
                                    <th>Mức đạt được</th>
                                    <th>Điểm KTHK</th>
                                @endforeach
                            @endif
                        @endforeach
                    </tr>
                {{-- in ra các môn hoc --}}
                    @foreach ($hocsinh->Hoc->where('id_nienkhoa', $nienKhoaHienTai->id)->first()->Lop->Khoi->MonHoc as $mh)
                        <tr>
                            <td>{{$mh->TenMH}}</td>
                            {{-- in ra điểm theo học kỳ --}}
                            @foreach ($nienKhoaHienTai->HocKy as $hk)
                                @if ($hk->TrangThai == 1)
                                    @foreach ($hk->LoaiHocKy as $lhk)
                                        <td>
                                        {{-- in ra điểm --}}
                                        @foreach ($SoLienLac->KetQuaHocTap as $kqht)
                                            @if ($kqht->id_loaihocky == $lhk->id && $mh->id == $kqht->id_monhoc)
                                            {{$kqht->MucDatDuoc}}
                                            @endif
                                        @endforeach
                                        </td>
                                        <td>
                                            @foreach ($SoLienLac->KetQuaHocTap as $kqht)
                                            @if ($kqht->id_loaihocky == $lhk->id && $mh->id == $kqht->id_monhoc)
                                                    {{$kqht->Diem}}
                                            @endif 
                                        @endforeach
                                        </td>
                                    @endforeach
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </table>
                <h3 class="title_main mt-3">Kết quả rèn luyện</h3>
                <table border = "1" class="scores_table">
                    <tr>
                        <th colspan="2">Nội dung</th>
                        @foreach ($hocky->LoaiHocKy as $item)
                            <th>{{$item->TenLoaiHK}}</option>
                        @endforeach
                    </tr>

                {{-- in ra các môn hoc --}}
                    <tr>
                        <td rowspan="{{$countNL + 1 }}">Năng lực</td>
                    </tr>
                    @foreach ($listPCNL as $pcnl)
                        @if ($pcnl->LoaiPCNL == 1)
                        <tr>
                            <td>{{$pcnl->TenPCNL}}</td>
                            @foreach ($nienKhoaHienTai->HocKy as $hk)
                                @if ($hk->TrangThai == 1)
                                    @foreach ($hk->LoaiHocKy as $lhk)
                                    {{-- in ra rating by semester --}}
                                    <td>
                                        @foreach ($SoLienLac->KetQuaRenLuyen as $kqrl)
                                            @if ($kqrl->id_loaihocky == $lhk->id && $pcnl->id == $kqrl->id_pcnl)
                                                @if ($kqrl->XepLoai)  {{$kqrl->XepLoai}} @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                        @endif
                    @endforeach
                    <tr>
                        <td rowspan="{{$countPC + 1 }}">Phẩm chất</td>
                    </tr>
                    @foreach ($listPCNL as $pcnl)
                        @if ($pcnl->LoaiPCNL == 2)
                            <tr>
                                <td>{{$pcnl->TenPCNL}}</td>
                                @foreach ($hk->LoaiHocKy as $lhk)
                                    <td>
                                        {{-- in ra rating by semester --}}
                                        @foreach ($SoLienLac->KetQuaRenLuyen as $kqrl)
                                            @if ($kqrl->id_loaihocky == $lhk->id && $pcnl->id == $kqrl->id_pcnl)
                                                @if ($kqrl->XepLoai)  {{$kqrl->XepLoai}} @endif
                                            @endif
                                        @endforeach
                                    </td>
                                @endforeach
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
        </div>
    </section>
@endsection
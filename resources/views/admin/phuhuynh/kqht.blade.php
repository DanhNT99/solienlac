@extends('admin/layouts/index')

@section('adminContent')
 <table class = "mx-auto my-2">
    <tr>
        <td><p class="adminFormAddText mx-3">Năm học</p></td>
        <td>
            <div class="formBoxSelect">
                <select name="" class="formSelect formSelectSmall formInputMa">
                    <option selected  value="{{$nienkhoa->id}}"> {{$nienkhoa->NamBatDau . ' - ' . $nienkhoa->NamKetThuc}}</option>
                </select>
                <div class="formSelectIcon">
                    <i class="fas fa-caret-down"></i>
                </div>
            </div>
        </td>
        <td><p class="adminFormAddText  mx-3">Học kỳ</p></td>
        <td>
            <div class="formBoxSelect">
                <select name="" class="formSelect formSelectSmall formInputMa">
                    @foreach ($nienkhoa->HocKy as $hk)
                        <option @if ($hk->TrangThai == 1) selected @endif  value="{{$hk->id}}">{{$hk->TenHK}}</option>
                    @endforeach
                </select>
                <div class="formSelectIcon"><i class="fas fa-caret-down"></i> </div>
            </div>
        </td>
    </tr>
</table>
<a href="phuhuynh/index" class="adminActiveItem">Quay lại</a>
<section class="scores">
    <div class="container">
        <div class="row">
        <div class="col-12 scoresBox">
                <h3 class="title_main">Kết quả học tập các môn học</h3>
                <table border = "1" class="scores_table">
                    <tr>
                        <th rowspan="2">Môn học</th>
                         @foreach ($hocky->LoaiHocKy as $lhk)
                            <th colspan="2">{{$lhk->TenLoaiHK}}</option>
                        @endforeach
                    </tr>
                    <tr>
                        <th>Mức đạt được</th>
                        <th>Điểm KTHK</th>
                        <th>Mức đạt được</th>
                        <th>Điểm KTHK</th>
                    </tr>
                {{-- in ra các môn hoc --}}
                @foreach ($hocsinh->Hoc->Lop->Khoi->PhanMonHoc as $mh)
                        <tr>
                            <td>{{$mh->MonHoc->TenMH}}</td>
                            {{-- in ra điểm theo học kỳ --}}
                            @foreach ($hocky->LoaiHocKy as $lhk)
                                 <td>
                                     {{-- in ra điểm --}}
                                    @foreach ($SoLienLac->KetQuaHocTap as $kqht)
                                        @if ($kqht->id_loaihocky == $lhk->id && $mh->MonHoc->id == $kqht->id_monhoc)
                                            @if ($kqht->MucDatDuoc)
                                                {{$kqht->MucDatDuoc}}
                                            @endif
                                        @endif
                                     @endforeach
                                </td>
                                <td>
                                    @foreach ($SoLienLac->KetQuaHocTap as $kqht)
                                        @if ($kqht->id_loaihocky == $lhk->id && $mh->MonHoc->id == $kqht->id_monhoc)
                                                {{$kqht->Diem}}
                                        @endif 
                                    @endforeach
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="col-12 scoresBox my-5">
            <h3 class="title_main">Kết quả rèn luyện</h3>
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
                        @foreach ($hocky->LoaiHocKy as $lhk)
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
                <tr>
                    <td rowspan="{{$countPC + 1 }}">Phẩm chất</td>
                </tr>
                @foreach ($listPCNL as $pcnl)
                    @if ($pcnl->LoaiPCNL == 2)
                        <tr>
                            <td>{{$pcnl->TenPCNL}}</td>
                            @foreach ($hocky->LoaiHocKy as $lhk)
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
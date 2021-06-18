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
                                        @foreach ($listNienKhoa as $item)
                                            <option @if ($item->id == Request::get('nienkhoa')) selected @endif value="{{$item->id}}"> 
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
                @foreach ($nienkhoaSearch->HocKy as $hk)
                    <span class="mr-2 mx-0 btnClass mt-0" style="font-size: 14px">
                        Niên khóa : {{$nienkhoaSearch->NamBatDau . ' - ' . $nienkhoaSearch->NamKetThuc}}
                        <span class="mx-1">|</span>
                        {{$hk->TenHK}}
                    </span>
                    <h3 class="title_main mt-2">Kết quả học tập các môn học</h3>
                    <table  class="scores_table">
                        <tr>
                            <th rowspan="2">Môn học</th>
                        @foreach ($hk->LoaiHocKy as $lhk)
                            <th colspan="2">{{$lhk->TenLoaiHK}}</option>
                        @endforeach
                        </tr>
                        <tr>
                        @foreach ($hk->LoaiHocKy as $lhk)
                            <th>Mức đạt được</th>
                            <th>Điểm KTHK</th>
                        @endforeach
                        </tr>
                        @foreach ($hocsinh->Hoc->where('id_nienkhoa', $nienkhoaSearch->id)->first()->Lop->Khoi->MonHoc as $mh)
                        <tr>
                            <td>{{$mh->TenMH}}</td>
                            @foreach ($hk->LoaiHocKy as $lhk)
                                <td class = "mucdatduoc">
                                    @foreach ($SoLienLac->KetQuaHocTap as $kqht)
                                        @if ($kqht->id_loaihocky == $lhk->id && $mh->id == $kqht->id_monhoc)
                                            @if ($kqht->MucDatDuoc)
                                                {{$kqht->MucDatDuoc}}
                                            @endif
                                        @endif
                                    @endforeach
                                </td>
                                <td class = "diem">
                                    @foreach ($SoLienLac->KetQuaHocTap as $kqht)
                                        @if ($kqht->id_loaihocky == $lhk->id && $mh->id == $kqht->id_monhoc)
                                                {{$kqht->Diem}}
                                        @endif 
                                    @endforeach
                                </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </table>
                    <h3 class="title_main mt-3">Kết quả rèn luyện</h3>
                    <table class="scores_table">
                        <tr>
                            <th colspan="2">Nội dung</th>
                        @foreach ($hk->LoaiHocKy as $lhk)
                            <th>{{$lhk->TenLoaiHK}}</option>
                        @endforeach
                        </tr>
                        <tr>
                            <td rowspan="{{$countNL + 1 }}">Năng lực</td>
                        </tr>
                @foreach ($listPCNL as $pcnl)
                    @if ($pcnl->LoaiPCNL == 1)
                        <tr>
                            <td>{{$pcnl->TenPCNL}}</td>
                        @foreach ($hk->LoaiHocKy as $lhk)
                            <td>
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
                        @foreach ($hk->LoaiHocKy as $lhk)
                            <td>
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
                    <div class="d-flex">
                        <div class="d-flex px-2 w-50">
                            <h5 class="title_main text-left" style="font-size: 20px">Học lực của học sinh : 
                        @if ($SoLienLac->NhanXet->where('id_hocky', $hk->id)->first())
                            <span style="color: red;">{{$SoLienLac->NhanXet->where('id_hocky', $hk->id)->first()->HocLuc}}</span>
                        @endif
                            </h5>
                            
                        </div>
                        <div class="px-2 w-50">
                        <h5 class="title_main text-left" style="font-size: 20px">Nhận xét của giáo viên</h5>
                    @if ($SoLienLac->NhanXet->where('id_hocky', $hk->id)->first())
                        <textarea name="NhanXet" class="mx-auto textarea p-2 w-100 formInputMa" placeholder="Nhập vào nhận xét">{{$SoLienLac->NhanXet->where('id_hocky', $hk->id)->first()->NhanXet}}</textarea>
                    @endif
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        </div>
    </section>
@endsection
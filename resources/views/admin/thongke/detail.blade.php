@extends('admin/layouts/index')
@section('title') Chi tiết sổ liên lạc @endsection
@section('adminContent')
    @include('admin/layouts/tab')
    <section class="adminList pt-0">
        {{-- detail student --}}
        <div class="container">
            <h3 class="adminListTitle">Chi tiết Sổ liên lạc học sinh</h3>
            
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-user adminBoxTitleIcon mr-1"></i>Thông tin chi tiết học sinh</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <form class="adminFormAdd">
                <div class="adminFormAddBox">
                    <div class="adminFormAddContains">
                        <div class="adminFormAddContainsImg wrapImgResize">
                            <div class="wrapImgResize">
                                <img src="{{asset('assets/images')}}/{{$hocsinh->Hinh}}" class="adminFormAddImg" alt="">
                            </div>
                        </div>
                        
                        <table class="adminFormAddTable">
                            <tr>
                                <td><p class="adminFormAddText">Mã học sinh</p></td>
                                <td> <input type="text" value = "{{$hocsinh->MaHS}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Họ và tên</p></td>
                                <td><input type="text" value = "{{$hocsinh->HoHS . ' ' . $hocsinh->TenHS}}" class="formInput formInputMa"></td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Giới tính</p></td>
                                <td>
                                    @if($hocsinh->GioiTinh == 'Nam')
                                        <input type="text" value  = "Nam"  class="formInput formInputMa">
                                    @else
                                        <input type="text" value = "Nữ"  class="formInput formInputMa">
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Ngày sinh</p></td>
                                <td><input type="date" value = "{{$hocsinh->NgaySinh}}" class="formInput formInputMa">
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Địa chỉ</p></td>
                                <td><input type="text" value = "{{$hocsinh->DiaChi}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Phường</p></td>
                                <td><input type="text" value = "{{$hocsinh->Phuong->TenPhuong}}" class="formInput formInputMa"></td>
                            </tr>
                             <tr>
                                <td><p class="adminFormAddText">Khối</p></td>
                                <td><input type="text" value = "{{$khoi->TenKhoi}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Lớp</p></td>
                                <td><input type="text" value = "{{$khoi->TenLop}}" class="formInput formInputMa"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>

        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-book adminBoxTitleIcon mr-1"></i>Kết quả học tập</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="adminFormAddBox">
               
                @foreach ($nienkhoa->HocKy as $hk)
                <span class="mr-2 mx-0 btnClass mt-0" style="font-size: 14px">
                    Niên khóa : {{$nienkhoa->NamBatDau . ' - ' . $nienkhoa->NamKetThuc}}
                    <span class="mx-1">|</span>
                    {{$hk->TenHK}}
                </span>

                <h3 class="title_main mt-0">Kết quả học tập các môn học</h3>
                <table  class="adminTable">
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
                    @foreach ($monhoc as $mh)
                    <tr>
                        <td>{{$mh->TenMH}}</td>
                        @foreach ($hk->LoaiHocKy as $lhk)
                        <td class = "mucdatduoc">
                            @foreach ($solienlac->KetQuaHocTap as $kqht)
                                @if ($kqht->id_loaihocky == $lhk->id && $mh->id == $kqht->id_monhoc)
                                    @if ($kqht->MucDatDuoc) {{$kqht->MucDatDuoc}} @endif
                                @endif
                            @endforeach
                        </td>
                        <td class = "diem">
                            @foreach ($solienlac->KetQuaHocTap as $kqht)
                                @if ($kqht->id_loaihocky == $lhk->id && $mh->id == $kqht->id_monhoc) 
                                    @if ($kqht->Diem) {{$kqht->MucDatDuoc}} @endif
                                @endif 
                            @endforeach
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </table>

                <h3 class="title_main mt-3">Kết quả rèn luyện</h3>
                <table class="adminTable">
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
                            @foreach ($solienlac->KetQuaRenLuyen as $kqrl)
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
                            @foreach ($solienlac->KetQuaRenLuyen as $kqrl)
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
                        @if ($solienlac->NhanXet->where('id_hocky', $hk->id)->first())
                            <span style="color: red;">{{$solienlac->NhanXet->where('id_hocky', $hk->id)->first()->HocLuc}}</span>
                        @endif
                        </h5>
                    </div>
                    <div class="px-2 w-50">
                        <h5 class="title_main text-left" style="font-size: 20px">Nhận xét của giáo viên</h5>
                    @if ($solienlac->NhanXet->where('id_hocky', $hk->id)->first())
                        <textarea name="NhanXet" class="mx-auto textarea p-2 w-100 formInputMa" placeholder="Nhập vào nhận xét">
                            {{$solienlac->NhanXet->where('id_hocky', $hk->id)->first()->NoiDungNhanXet}}
                        </textarea>
                    @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
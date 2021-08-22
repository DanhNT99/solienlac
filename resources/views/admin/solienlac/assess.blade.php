@extends('admin/layouts/index')
@section('title') Chỉnh sửa sổ liên lạc @endsection
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
                            {{-- <tr>
                                <td><p class="adminFormAddText">Khối</p></td>
                                <td><input type="text" value = "{{$hocsinh->Hoc->where('id_nienkhoa', $nienkhoa->id)->Lop->Khoi->TenKhoi}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Lớp</p></td>
                                <td><input type="text" value = "{{$hocsinh->Hoc->where('id_nienkhoa', $nienkhoa->id)->Lop->TenLop}}" class="formInput formInputMa"></td>
                            </tr> --}}
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
                                <td><input type="text" value = "{{$hocsinh->Hoc->where('id_nienkhoa', $nienkhoa->id)->first()->Lop->Khoi->TenKhoi}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Lớp</p></td>
                                <td><input type="text" value = "{{$hocsinh->Hoc->where('id_nienkhoa', $nienkhoa->id)->first()->Lop->TenLop}}" class="formInput formInputMa"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>

        {{-- detail result study of student --}}
        <div class="container">
             
            <div class="adminBoxTitle py-1 px-2">
            <h6 class = "m-0"><i class="fas fa-book adminBoxTitleIcon mr-1"></i>Kết quả học tập</h6>
            <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>

            <form class="adminFormAdd">
                <div class="adminFormAddBox  px-5">
                    <h3 class="title_main">Kết quả học tập các môn học</h3>

                    <table  class="adminTable">
                        <tr>
                            <th rowspan="2">Môn học</th>
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
                    {{-- in ra các môn hoc --}}
                        @foreach ($monhoc as $mh)
                        <tr>
                            <td>
                                {{$mh->TenMH}}
                            </td>
                                {{-- in ra điểm theo học kỳ --}}
                            @foreach ($nienkhoa->HocKy as $hk)
                                @if ($hk->TrangThai)
                                    @foreach ($hk->LoaiHocKy as $lhk)
                                        <td class = "mucdatduoc">
                                            @foreach ($hocsinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->KetQuaHocTap as $kqht)
                                                @if ($kqht->id_loaihocky == $lhk->id && $mh->id == $kqht->id_monhoc)
                                                    @if ($kqht->MucDatDuoc)
                                                        {{$kqht->MucDatDuoc}}
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class = "diem">
                                            @foreach ($hocsinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->KetQuaHocTap as $kqht)
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
                    <h3 class="title_main">Kết quả rèn luyện</h3>
                    <table class="adminTable">
                        <tr>
                            <th colspan="2">Nội dung</th>
                            @foreach ($nienkhoa->HocKy as $hk)
                                @if ($hk->TrangThai)
                                    @foreach ($hk->LoaiHocKy as $lhk)
                                        <th>{{$lhk->TenLoaiHK}}</option>
                                    @endforeach
                                @endif
                             @endforeach
                        </tr>
                        <tr>
                            <td rowspan="{{$countNL + 1 }}">Năng lực</td>
                        </tr>
                        @foreach ($listPCNL as $pcnl)
                            @if ($pcnl->LoaiPCNL == 1)
                            <tr>
                                <td>{{$pcnl->TenPCNL}}</td>
                                @foreach ($nienkhoa->HocKy as $hk)
                                    @if ($hk->TrangThai)
                                        @foreach ($hk->LoaiHocKy as $lhk)
                                            <td>
                                                @foreach ($hocsinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->KetQuaRenLuyen as $kqrl)
                                                    @if ($kqrl->id_loaihocky == $lhk->id && $pcnl->id == $kqrl->id_pcnl)
                                                        @if ($kqrl->XepLoai)  {{$kqrl->XepLoai}} @endif
                                                    @endif
                                                @endforeach
                                            </td>
                                        @endforeach
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
                                    @foreach ($nienkhoa->HocKy as $hk)
                                        @if ($hk->TrangThai)
                                            @foreach ($hk->LoaiHocKy as $lhk)
                                                <td>
                                                    @foreach ($hocsinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->KetQuaRenLuyen as $kqrl)
                                                        @if ($kqrl->id_loaihocky == $lhk->id && $pcnl->id == $kqrl->id_pcnl)
                                                            @if ($kqrl->XepLoai)  {{$kqrl->XepLoai}} @endif
                                                        @endif
                                                    @endforeach
                                                </td>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            </form>
        </div>

        <div class="container mt-1">    
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-edit adminBoxTitleIcon mr-1"></i>Nhận xét giáo viên</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
           <form action="{{route('solienlac.update', '')}}/{{$hocsinh->id}}" method = "post" class="adminFormAdd">
            @method('PATCH') @csrf
                <div class="adminFormAddBox">
                    <input type="text" name="IdKhoi" value = "{{$hocsinh->Hoc->where('id_nienkhoa', $nienkhoa->id)->first()->Lop->Khoi->id}}" class="d-none">
                    @foreach ($nienkhoa->HocKy as $hk)
                        @if ($hk->TrangThai && strpos($hk->TenHK, '2'))
                              <div class="d-flex px-5">
                            <h5 class="title_main text-left" style = "font-size: 20px">Học lực của học sinh : </h5>
                                <input type="text" name="HocLuc" style = 'color: red; font-size: 18px;' value = "{{$text}}" class = "border-0 ml-2 formInputMa">       
                        </div>
                        @endif
                    @endforeach
                <div class="px-5">
                    <h5 class="title_main text-left" style = "font-size: 20px">Nhận xét của giáo viên</h3>
                        <textarea name="NhanXet" spellcheck="false" class="mx-auto textarea p-2" id="" cols="100" rows="5" placeholder="Nhập vào nhận xét">
                        @if (count($hocsinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->NhanXet))
                            @if (count($hocsinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->NhanXet->where('id_hocky', $hocky->id)))
                                {{$hocsinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->NhanXet->where('id_hocky', $hocky->id)->first()->NoiDungNhanXet}}
                            @endif
                        @endif
                        </textarea>
                        <div  class="py-1 mt-1">
                            <button type="submit" class="px-3 py-1 border-0 rounded modalBtn ml-2 mb-2">
                                <i class="fas fa-save mr-1"></i>Lưu
                            </button>
                            <button type="button" onclick="window.print()" class="px-3 py-1 border-0 rounded modalBtn ml-2 mb-2">
                               <i class="fas fa-file-download mr-1"></i> Xuất Pdf
                            </button>
                        </div>
                    </div>
                </div>
           </form>
       </div>
    </section>

    @if (Session::has('noti'))
        <div class="notiBox">
        <h4 class="notiBoxTitle">Thông báo <button class="notiBoxBtn"><i class="far fa-window-close"></i></button></h4>
        <p class="notiBoxContent"> {{Session('noti')}}!</p>
        </div>
    @endif
@endsection
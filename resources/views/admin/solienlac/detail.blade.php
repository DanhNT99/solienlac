@extends('admin/layouts/index')
@section('title') Chỉnh sửa sổ liên lạc @endsection
@section('adminContent')
    @include('admin/layouts/tab');

    <section class="adminList pt-0">
        {{-- detail student --}}
        <div class="container">
            <h3 class="adminListTitle">Chi tiết Sổ liên lạc học sinh</h3>
             <h3 class="adminBoxTitle"><i class="fas fa-address-book adminBoxTitleIcon"></i>Thông tin chi tiết học sinh
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
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
                                <td><p class="adminFormAddText">Khối</p></td>
                                <td><input type="text" value = "{{$hocsinh->Hoc->Lop->Khoi->TenKhoi}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Lớp</p></td>
                                <td><input type="text" value = "{{$hocsinh->Hoc->Lop->TenLop}}" class="formInput formInputMa"></td>
                            </tr>
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
                                <td><p class="adminFormAddText">Tỉnh</p></td>
                                <td><input type="text" value = "{{$hocsinh->Phuong->Tinh->TenTinh}}" class="formInput formInputMa"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>

        {{-- detail result study of student --}}
        <div class="container">
             <h3 class="adminBoxTitle"><i class="fas fa-book adminBoxTitleIcon"></i>Chi tiết sổ liên lạc
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>

            <form class="adminFormAdd">
                <div class="adminFormAddBox  px-5">
                    <h3 class="title_main">Kết quả học tập các môn học</h3>

                    <table  class="adminTable">
                        <tr>
                            <th rowspan="2">Môn học</th>
                             @foreach ($hocky->LoaiHocKy as $lhk)
                                <th colspan="2">{{$lhk->TenLoaiHK}}</option>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($hocky->LoaiHocKy as $lhk)
                                <th>Mức đạt được</th>
                                <th>Điểm KTHK</th>
                            @endforeach

                        </tr>
                    {{-- in ra các môn hoc --}}
                        @foreach ($monhoc as $mh)
                            <tr>
                                <td>
                                    {{$mh->TenMH}}
                                </td>
                                {{-- in ra điểm theo học kỳ --}}
                                @foreach ($hocky->LoaiHocKy as $lhk)
                                    <td>
                                        {{-- in ra điểm --}}
                                        @foreach ($hocsinh->SoLienLac->KetQuaHocTap as $kqht)
                                            @if ($kqht->id_loaihocky == $lhk->id && $mh->id == $kqht->id_monhoc)
                                                @if ($kqht->MucDatDuoc)
                                                    {{$kqht->MucDatDuoc}}
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($hocsinh->SoLienLac->KetQuaHocTap as $kqht)
                                            @if ($kqht->id_loaihocky == $lhk->id && $mh->id == $kqht->id_monhoc)
                                                    {{$kqht->Diem}}
                                            @endif 
                                        @endforeach
                                    </td>
                                @endforeach
                            </tr>
                            @endforeach
                    </table>

                    <h3 class="title_main mt-5">Kết quả rèn luyện</h3>

                    <table class="adminTable">
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
                                        @foreach ($hocsinh->SoLienLac->KetQuaRenLuyen as $kqrl)
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
                                            @foreach ($hocsinh->SoLienLac->KetQuaRenLuyen as $kqrl)
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
            </form>
        </div>

        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-book adminBoxTitleIcon"></i>Nhận xét giáo viên
               <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
           </h3>
           <form action="{{route('solienlac.update', '')}}/{{$hocsinh->id}}" method = "post" class="adminFormAdd">
            @method('PATCH') @csrf
                <input type="text" name="IdKhoi" value = "{{$hocsinh->Hoc->Lop->Khoi->id}}" class="d-none">
                <div class="adminFormAddBox px-5">
                    <h3 class="title_main text-left">Học lực của học sinh</h3>
                    <textarea name="HocLuc" class="mx-auto textarea formInputMa p-2" id="" cols="100" rows="2" placeholder="">{{$text}}</textarea>
                </div>
               <div class="adminFormAddBox px-5">
                   <h3 class="title_main text-left">Nhận xét của giáo viên</h3>
                    <textarea name="NhanXet" class="mx-auto textarea p-2" id="" cols="100" rows="5" placeholder="Nhập vào nhận xét">{{$hocsinh->SoLienLac->NhanXet}}</textarea>
                    <div  class="adminFormAddBox py-1 ">
                        <button type="submit" class="px-3 py-1 border-0 rounded modalBtn ml-2 mb-2">Lưu</button>
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
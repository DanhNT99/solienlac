@extends('admin/layouts/index')
@section('title')Đánh gia rèn luyện @endsection
@section('adminContent')
    @include('admin/layouts/tab')
    <section class="adminAdd">
        <div class="container-xl">
           <div class="adminBoxTitle py-1 px-2 mb-2" style="width: fit-content;">
                <span>Năm học : {{$nienkhoa->NamBatDau . ' - ' . $nienkhoa->NamKetThuc}}</span>
                <span class="mx-2">|</span>
                <span>{{$hocky->TenHK}}</span>
                <span class="mx-2">|</span>
                <span> Lớp: {{$giaovien->Lop->TenLop}}</span>
            </div>
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-plus-circle adminBoxTitleIcon mr-1"></i>Đánh giá rèn luyện học sinh</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="adminFormAddBox">
                <form action="{{route('ketquarenluyen.store')}}" method="post" class="adminFormAdd">
                    @csrf
                    <table class="adminFormAddTable adminFormAddTableSmall">
                        <tr>
                            <td><p class="adminFormAddText">Phẩm chất năng lực</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="PCNL" id = "pcnl" class="formSelect">
                                        <option selected disabled>Lựa chọn</option>
                                        @foreach ($pcnl as $item)
                                            <option @if ($item->id == Request::get('idPCNL')) selected
                                            @endif class="formBoxSelectOption" value="{{$item->id}}">{{$item->TenPCNL}}</option>
                                        @endforeach       
                                    </select>
                                    <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                </div>
                                @if ($errors->has('PCNL')) 
                                        <div class="notiFail" role="alert">{{$errors->first('PCNL')}}</div>
                                @endif
                            </td>
                            <td><p class="adminFormAddText">Loại học kỳ</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="LoaiHK" id = "loaiHK" class="formSelect">
                                        <option selected disabled>Lựa chọn</option>
                                            @foreach ($nienkhoa->HocKy as $hocky)
                                                @if ($hocky->TrangThai)
                                                    @foreach ($hocky->LoaiHocKy as $loaihk)
                                                        <option @if ($loaihk->id == old('LoaiHK')) selected
                                                            @endif value="{{$loaihk->id}}"> {{$loaihk->TenLoaiHK}}</option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                    </select>
                                    <div class="formSelectIcon">
                                        <i class="fas fa-caret-down"></i>
                                    </div>
                                </div>
                                @if ($errors->has('LoaiHK')) 
                                    <div class="notiFail" role="alert">{{$errors->first('LoaiHK')}}</div>
                                @endif
                            </td>
                        </tr>
                    </table>
                    
                    <table border = "1" class="adminTable w-75 mt-5">
                        <tr>
                            <th>stt</th>
                            <th>Tên học sinh</th>
                            <th>Mức đạt được</th>
                        </tr>
                         @foreach ($giaovien->Hoc->where('id_nienkhoa', $nienkhoa->id) as $item)
                            <tr>
                                <td>{{$stt++}}</td>
                                <td class="text-left pl-3">
                                    <input type="text" class="d-none solienlac" name="SoLienLac[]" 
                                            value = "{{$item->HocSinh->SoLienLac->where('id_nienkhoa', $nienkhoa->id)->first()->id}}" >
                                    {{$item->HocSinh->HoHS . ' ' .$item->HocSinh->TenHS}}</td>
                                <td>
                                   <div class="formBoxSelect">
                                        <select name="XepLoai[]" class="xeploai formSelect formSelectSmall">
                                            <option selected value="" >Lựa chọn</option>
                                            <option value="T">T</option>
                                            <option value="Đ">Đ</option>
                                            <option value="C">C</option>      
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="adminFormSearchContainsBtn adminFormAddGroup">
                        <button type="submit" class="px-2 py-1 border-0 rounded modalBtn mr-1">Thực hiện</button>
                        <a href = "admin/ketquarenluyen" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

  
    {{-- <script type="text/javascript">
       function clickTr(id) {
        console.log('đã click');
    }
    </script> --}}
@endsection
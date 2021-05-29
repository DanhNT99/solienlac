@extends('admin/layouts/index')
@section('adminContent')
    @include('admin/layouts/tab')
    
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-search-plus adminBoxTitleIcon"></i>
                Nhập điểm
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="{{route('ketquarenluyen.store')}}" method="post" class="adminFormAdd">
                    @csrf

                    <table >
                        <tr>
                            <td class=""><p class="adminFormAddText z">Năm học</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="" class="formSelect formSelectSmall formInputMa">
                                        @foreach ($nienkhoas as $item)
                                            @if ($item->TrangThai)
                                                <option selected  value="{{$item->id}}"> {{$item->NamBatDau . ' - ' . $item->NamKetThuc}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="formSelectIcon">
                                        <i class="fas fa-caret-down"></i>
                                    </div>
                                </div>
                            </td>
                            <td><p class="adminFormAddText">Học kỳ</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="" class="formSelect formSelectSmall formInputMa">
                                        @foreach ($nienkhoas as $nienkhoa)
                                            @foreach ($nienkhoa->HocKy as $item)
                                                @if ($item->TrangThai)
                                                    <option selected  value="{{$item->id}}"> {{$item->TenHK}}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                    <div class="formSelectIcon">
                      
                                        <i class="fas fa-caret-down"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <table class="adminFormAddTable adminFormAddTableSmall">
                        <tr>
                            <td><p class="adminFormAddText">Khối</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select class="formSelect formInputMa">
                                        @foreach ($giaovien->Lop as $item)
                                            <option class="formBoxSelectOption" value="{{$item->Khoi->id}}">{{$item->Khoi->TenKhoi}}</option>
                                        @endforeach
                                    </select>
                                    <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                </div>
                            </td>
                            <td><p class="adminFormAddText">Lớp</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select class="formSelect formInputMa">
                                    @foreach ($giaovien->Lop as $item)
                                        <option class="formBoxSelectOption" value="{{$item->id}}">{{$item->TenLop}}</option>
                                    @endforeach
                                    </select>
                                    <div class="formSelectIcon"><i class="fas fa-caret-down"></i> </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><p class="adminFormAddText">Phẩm chất năng lực</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="PCNL" id = "pcnl" class="formSelect">
                                        <option selected disabled>Lựa chọn</option>
                                        @foreach ($pcnl as $item)
                                            <option class="formBoxSelectOption" value="{{$item->id}}">{{$item->TenPCNL}}</option>
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
                                        @foreach ($nienkhoas as $nienkhoa)
                                            @foreach ($nienkhoa->HocKy as $hocky)
                                                @if ($hocky->TrangThai)
                                                    @foreach ($hocky->LoaiHocKy as $loaihk)
                                                        <option value="{{$loaihk->id}}"> {{$loaihk->TenLoaiHK}}</option>
                                                    @endforeach
                                                @endif
                                            @endforeach
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
                    
                    <table border = "1" class="adminTable  mt-5">
                        <tr>
                            <th>stt</th>
                            <th>Tên học sinh</th>
                            <th>Mức đạt được</th>
                        </tr>
                         @foreach ($giaovien->Hoc as $item)
                            <tr>
                                <td>{{$stt++}}</td>
                                <td><input type="text" class="d-none solienlac" name="SoLienLac[]" value = "{{$item->HocSinh->SoLienLac->id}}" >
                                    {{$item->HocSinh->HoHS . ' ' .$item->HocSinh->TenHS}}</td>
                                <td>
                                    <input type="text" name="XepLoai[]" value = '' class="formInput XepLoai">
                                </td>

                            </tr>
                        @endforeach
                    </table>
                    <div class="adminFormSearchContainsBtn adminFormAddGroup">
                        <button class="adminFormAddBtn" name = "luu">lưu</button>
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
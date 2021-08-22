@extends('admin/layouts/index')
@section('title')Phân công học tập @endsection
@section('adminContent')
    @include('admin/hocsinh/tab')

    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-plus-circle adminBoxTitleIcon mr-1"></i>Phân công học tập</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="adminFormAddBox">
                <form action="{{route('hoc.store')}}" method = "post" class="adminFormAdd" >
                     @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Niên khóa</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="nienkhoa" id="" class="formSelect">
                                            <option value="{{$nienkhoa->id}}">{{$nienkhoa->NamBatDau . '- '. $nienkhoa->NamKetThuc}}</option>
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                    @if ($errors->has('nienkhoa')) 
                                    <div class="notiFail" role="alert"> {{$errors->first('nienkhoa')}} </div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Lớp</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="lop" id="" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            @foreach ($lop as $item)
                                            <option @if (Request::get('Lop') == $item->id) selected
                                                    @endif  value="{{$item->id}}">{{$item->TenLop}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                    @if ($errors->has('lop')) 
                                    <div class="notiFail" role="alert"> {{$errors->first('lop')}}</div>
                                    @endif
                               </td>
                            </tr>
                        </table>
                    </div>
                    <div class="container px-5">
                        <h4 class="adminListTitle mt-4 mb-3 text-center">Danh sách học sinh chưa có lớp</h4>
                        <div class="input-group mb-1">
                            <input type="checkbox" class="inputCheckAll" hidden />
                            <label for="checkbox" class="checkbox m-0">
                                <span class="icon"></span>
                                <span class="text">Check all</span>
                            </label>
                        </div> 
                        <table class="adminTable w-100" border="1">
                            <tr>
                                <th>Stt</th>
                                <th>Mã học sinh</th>
                                <th>Họ và tên</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Địa chỉ</th>
                                <th>Chọn</th>
                            </tr>
                            @foreach ($hocsinh as $item)
                                @if (count($item->Hoc) == 0)
                                    <tr>
                                        <td>{{$stt++}}</td>
                                        <td>{{$item->MaHS}}</td>
                                        <td>{{$item->HoHS . ' ' . $item->TenHS}}</td>
                                        <td>@if ($item->GioiTinh == 'Nu') Nữ
                                            @else Nam @endif</td>
                                        <td>{{$item->NgaySinh}}</td>
                                        <td>{{$item->DiaChi}}</td>
                                        <td>
                                            <input type="checkbox" name="TrangThai[]" class = 'checkBoxStudent' value="{{$item->id}}">
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submit" class="px-2 py-1 border-0 rounded modalBtn mr-1">Thực hiện</button>
                        <a href = "{{url()->previous()}}" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
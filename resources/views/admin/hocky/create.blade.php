@extends('admin/layouts/index')
@section('title')Thêm học kì @endsection
@section('adminContent')
    @include('admin/nienkhoa/tab')
    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-plus-circle adminBoxTitleIcon mr-1"></i>Thêm học kì</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="adminFormAddBox">
                <form action="{{route('hocky.store')}}" method = "post" class="adminFormAdd" >
                    @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Niên khóa</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                    <select name="nienkhoa" id = "nienkhoa" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            @foreach ($nienkhoa as $item)
                                                @if ($item->TrangThai == 1)
                                                    <option value="{{$item->id}}">{{$item->NamBatDau . ' - ' .$item->NamKetThuc}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                    </div>
                                    @if ($errors->has('nienkhoa')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('nienkhoa')}} </div>
                                     @endif
                                </td>
                                <td><p class="adminFormAddText">Mã học kì</p></td>
                                <td>
                                    <input type="text" name="MaHK" value  = "{{old('MaHK')}}" class="formInput capitalize filterMaHK formInputMa">
                                    @if ($errors->has('MaHK')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('MaHK')}} </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Tên học kì</p></td>
                                <td>
                                    <input type="text" name="TenHK"  value  = "{{old('TenHK')}}" class="formInput capitalize" placeholder="Tên học kì">
                                    @if ($errors->has('TenHK')) 
                                        <div class="notiFail" role="alert">  {{$errors->first('TenHK')}} </div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Trạng thái</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="TrangThai" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            <option @if (old('TrangThai') == 1) selected @endif  value="1">Hiện tại</option>
                                            <option @if (old('TrangThai') != null && old('TrangThai') != 1) selected @endif  value="0">Bỏ trống</option>
                                        </select>
                                        <div class="formSelectIcon"> <i class="fas fa-caret-down"></i></div>
                                    </div>
                                    @if ($errors->has('TrangThai')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('TrangThai')}} </div>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submit" class="px-2 py-1 border-0 rounded modalBtn mr-1">Thực hiện</button>
                        <a href = "admin/hocky" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
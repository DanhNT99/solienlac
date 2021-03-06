@extends('admin/layouts/index')
@section('title')Thêm lớp @endsection
@section('adminContent')
    @include('admin/khoi/tab')
    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-plus-circle adminBoxTitleIcon mr-1"></i>Thêm lớp</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="adminFormAddBox">
                <form action="{{route('lop.store')}}" method = "post" class="adminFormAdd" >
                    @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã lớp</p></td>
                                <td><input type="text" name="MaLop" value="{{$text_id}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Tên lớp</p></td>
                                <td>
                                    <input type="text" name="TenLop" value = "{{old('TenLop')}}" class="formInput capitalize" placeholder="Tên lớp">
                                    @if ($errors->has('TenLop')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('TenLop')}} </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Tên giáo viên</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="giaovien" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            @foreach ($giaovien as $item)
                                                <option @if ($item['id'] == old('giaovien')) selected @endif value="{{$item['id']}}">{{$item['HoGV'] . ' '. $item['TenGV']}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                    </div>
                                    @if ($errors->has('giaovien')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('giaovien')}} </div>
                                     @endif
                                </td>
                                <td><p class="adminFormAddText">Khối</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="khoi" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            @foreach ($khoi as $item)
                                                <option @if ($item->id == old('khoi')) selected @endif value="{{$item->id}}">{{$item->TenKhoi}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                    </div>
                                    @if ($errors->has('khoi')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('khoi')}} </div>
                                     @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submit" class="px-2 py-1 border-0 rounded modalBtn mr-1">Thực hiện</button>
                        <a href = "admin/lop" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
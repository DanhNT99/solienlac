@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/giaovien/tab')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Thêm môn học
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="{{route('phanconggiangday.store')}}" method = "post" class="adminFormAdd" >
                    @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Tên giáo viên</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="giaovien" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            @foreach ($giaovien as $item)
                                                <option value="{{$item->id}}">{{$item->HoGV . ' ' .$item->TenGV}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon">
                                            <i class="fas fa-caret-down"></i>
                                        </div>
                                    </div>
                                    @if ($errors->has('giaovien')) 
                                        <div class="notiFail" role="alert">
                                        {{$errors->first('giaovien')}}
                                        </div>
                                     @endif
                                </td>
                                <td><p class="adminFormAddText">Tên lớp</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="lop" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            @foreach ($lop as $item)
                                                <option value="{{$item->id}}">{{$item->TenLop}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon">
                                            <i class="fas fa-caret-down"></i>
                                        </div>
                                    </div>
                                    @if ($errors->has('lop')) 
                                        <div class="notiFail" role="alert">
                                        {{$errors->first('lop')}}
                                        </div>
                                     @endif
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Tên môn học</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="monhoc" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            @foreach ($monhoc as $item)
                                                <option value="{{$item->id}}">{{$item->TenMH}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon">
                                            <i class="fas fa-caret-down"></i>
                                        </div>
                                    </div>
                                    @if ($errors->has('monhoc')) 
                                        <div class="notiFail" role="alert">
                                        {{$errors->first('monhoc')}}
                                        </div>
                                     @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submmit" class="adminFormAddBtn">Thêm</button>
                        <a href = "admin/phanconggiangday" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
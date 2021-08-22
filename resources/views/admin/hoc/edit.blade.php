@extends('admin/layouts/index')
@section('title') Chỉnh sửa phân công học tập @endsection
@section('adminContent')
    @include('admin/hocsinh/tab')

    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-edit adminBoxTitleIcon mr-1"></i>Chỉnh sữa học tập</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="adminFormAddBox">
                <form action="{{route('hoc.update','')}}/{{$hoc->id}}" method = "post" class="adminFormAdd" >
                    @method('PATCH') @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Niên khóa</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="nienkhoa" id="" class="formSelect">
                                            <option value="{{$hoc->NienKhoa->id}}">{{$hoc->NienKhoa->NamBatDau . '- '. $hoc->NienKhoa->NamKetThuc}}</option>
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                </td>
                                <td><p class="adminFormAddText">Học sinh</p></td>
                                <td>
                                 <input type="text" class="formInput formInputMa capitalize" 
                                        value= "{{$hocsinh->HoHS. ' ' . $hocsinh->TenHS}}">
                               </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Lớp</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="lop" id="" class="formSelect">
                                            @foreach ($lop as $item)
                                                <option @if ($item->id == $hoc->id_lop) selected @endif 
                                                    value="{{$item->id}}">{{$item->TenLop}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                               </td>
                            </tr>
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
@extends('admin/layouts/index')
@section('title') Chỉnh sửa môn học @endsection
@section('adminContent')
    @include('admin/khoi/tab')
    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-edit adminBoxTitleIcon mr-1"></i>Chỉnh sửa môn học</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="adminFormAddBox">
                <form action="{{route('monhoc.update', '')}}/{{$monhoc->id}}" method = "post" class="adminFormAdd" >
                     @method('PATCH') @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã môn học</p></td>
                                <td><input type="text" name="MaMH" value="{{$monhoc->MaMH}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Tên môn học</p></td>
                                <td>
                                    <input type="text" name="TenMH" value="{{$monhoc->TenMH}}" class="formInput ">
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Được phép nhập điểm</p></td>
                                  <td>
                                    <div class="formBoxSelect">
                                        <select name="ChoPhepNhapDiem" class="formSelect">
                                            <option @if ($monhoc->ChoPhepNhapDiem == 1) selected @endif  
                                                value="1">Được phép</option>
                                            <option @if ($monhoc->ChoPhepNhapDiem == 0) selected @endif  
                                                value="0">Không được phép</option>
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
                          <button type="submmit" class="px-2 py-1 border-0 rounded modalBtn mr-1">Thực hiện</button>
                        <a href = "admin/monhoc" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
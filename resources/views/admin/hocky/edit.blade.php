@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/nienkhoa/tab')
    <section class="adminAdd">
        <div class="container">    
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-edit adminBoxTitleIcon mr-1"></i>Chỉnh sửa học kỳ</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="adminFormAddBox">
                <form action="{{route('hocky.update', '')}}/{{$hocky->id}}" method = "post" class="adminFormAdd" >
                   @method('PATCH') @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Niên khóa</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="nienkhoa" id = "nienkhoa" class="formSelect">
                                            @foreach ($nienkhoa as $item)
                                                <option @if ($item->id == $hocky->id_nienkhoa) selected
                                                @endif value="{{$item->id}}">{{$item->NamBatDau . ' - ' .$item->NamKetThuc}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                    </div>
                                </td>
                                <td><p class="adminFormAddText">Mã học kỳ</p></td>
                                <td>
                                    <input type="text" name="MaHK" value = "{{$hocky->MaHK}}" class="formInput formInputMa">
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Tên học kỳ</p></td>
                                <td>
                                    <input type="text" name="TenHK" value="{{$hocky->TenHK}}" class="formInput capitalize">
                                    @if ($errors->has('TenHK')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('TenHK')}}</div>
                                    @endif
                                </td>
                                <td><p class="adminFormAddText">Trạng thái</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="TrangThai" class="formSelect">
                                            <option @if ($hocky->TrangThai  == 1) selected @endif value="1">Hiện tại</option>
                                            <option @if ($hocky->TrangThai  == 0) selected @endif value="0">Bỏ trống</option>
                                        </select>
                                        <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submit" class="px-3 py-1 border-0 rounded modalBtn mr-2">Thực hiện</button>
                        <a href = "admin/hocky" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
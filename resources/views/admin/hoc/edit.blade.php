@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/hocsinh/tab')

    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Chỉnh sữa học tập
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="{{route('hoc.update','')}}/{{$hoc->id}}" method = "post" class="adminFormAdd" >
                    @method('PATCH') @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Niên khóa</p></td>
                                {{-- <td><input type="text" name="MaBH" value="{{$hoc->id_nienkhoa}}" class="formInput formInputMa"></td> --}}
                               <td>
                                    <div class="formBoxSelect">
                                        <select name="nienkhoa" id="" class="formSelect">
                                            @foreach ($nienkhoa as $item)
                                                <option @if ($item->id == $hoc->id_nienkhoa) selected @endif 
                                                    value="{{$item->id}}">{{$item->NamBatDau . '- '. $item->NamKetThuc}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                               </td>
                                <td><p class="adminFormAddText">Học sinh</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="hocsinh" id="" class="formSelect">
                                            @foreach ($hocsinh as $item)
                                                <option @if ($item->id == $hoc->id_hocsinh) selected @endif 
                                                    value="{{$item->id}}">{{$item->HoHS . ' '. $item->TenHS}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
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
                        <button type="submit" class="px-3 py-1 border-0 rounded modalBtn mr-2">Thực hiện</button>
                        <a href = "admin/hoc" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
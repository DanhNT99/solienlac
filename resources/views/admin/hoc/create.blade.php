@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/hocsinh/tab')

    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Phân công học tập
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="{{route('hoc.store')}}" method = "post" class="adminFormAdd" >
                     @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Niên khóa</p></td>
                                {{-- <td><input type="text" name="MaBH" value="{{$hoc->id_nienkhoa}}" class="formInput formInputMa"></td> --}}
                               <td>
                                    <div class="formBoxSelect">
                                        <select name="nienkhoa" id="" class="formSelect">
                                            @foreach ($nienkhoa as $item)
                                                <option @if ($item->TrangThai == 1) selected @endif value="{{$item->id}}">{{$item->NamBatDau . '- '. $item->NamKetThuc}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                    @if ($errors->has('nienkhoa')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('nienkhoa')}} </div>
                                    @endif
                               </td>
                                <td><p class="adminFormAddText">Học sinh</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="hocsinh" id="" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            @foreach ($hocsinh as $item)
                                                @if (!$item->Hoc)
                                                    <option value="{{$item->id}}">{{$item->HoHS . ' '. $item->TenHS}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                    @if ($errors->has('hocsinh')) 
                                        <div class="notiFail" role="alert"> {{$errors->first('hocsinh')}}</div>
                                    @endif
                               </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Lớp</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="lop" id="" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            @foreach ($lop as $item)
                                                <option value="{{$item->id}}">{{$item->TenLop}}</option>
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
                    <div class="adminFormAddGroup">
                        <button type="submit" class="px-3 py-1 border-0 rounded modalBtn mr-2">Thực hiện</button>
                        <a href = "admin/hoc" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
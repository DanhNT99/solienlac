@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/banhoc/tab')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Phân ban học học
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="{{route('phanbanhoc.store')}}" method = "post" class="adminFormAdd" >
                    @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Khối</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="khoi" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            @foreach ($khoi as $item)
                                                <option value="{{$item->id}}">{{$item->TenKhoi}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                    @if ($errors->has('khoi')) 
                                        <div class="notiFail" role="alert">{{$errors->first('khoi')}}</div>
                                     @endif
                                </td>
                                <td><p class="adminFormAddText">Ban học</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="banhoc" class="formSelect">
                                            <option selected disabled>Lựa chọn</option>
                                            @foreach ($banhoc as $item)
                                                <option value="{{$item->id}}">{{$item->TenBH}}</option>
                                            @endforeach
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                                    @if ($errors->has('banhoc')) 
                                        <div class="notiFail" role="alert">{{$errors->first('banhoc')}}</div>
                                     @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submmit" class="adminFormAddBtn">Thêm</button>
                        <a href = "admin/phanbanhoc" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/banhoc/tab')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Chỉnh sữa ban học
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="{{route('banhoc.update','')}}/{{$banhoc->id}}" method = "post" class="adminFormAdd" >
                    @method('PATCH') @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã ban học</p></td>
                                <td><input type="text" name="MaBH" value="{{$banhoc->MaBH}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Tên ban học</p></td>
                                <td><input type="text" name="TenBH" value="{{$banhoc->TenBH}}" class="formInput"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submmit" class="adminFormAddBtn">Thực hiện</button>
                        <a href = "admin/banhoc" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
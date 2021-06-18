@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/tinh/tab')
    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-plus-circle adminBoxTitleIcon mr-2"></i>Thêm tỉnh</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
             </div>

            <div class="adminFormAddBox">
                <form action="{{route('tinh.store')}}" method = "post" class="adminFormAdd" >
                    @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã tỉnh</p></td>
                                <td><input type="text" name="MaTinh" value="{{$text_id}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Tên tỉnh</p></td>
                                <td>
                                    <input type="text" name="TenTinh" class="formInput capitalize" placeholder="Tên tỉnh">
                                    @if ($errors->has('TenTinh')) 
                                        <div class="notiFail" role="alert">
                                            {{$errors->first('TenTinh')}}
                                        </div>
                                    @endif
                                </td>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submmit" class="adminFormAddBtn">Thêm</button>
                        <a href = "admin/tinh" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
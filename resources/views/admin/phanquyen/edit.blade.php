@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/quyen/tab')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Phân công môn học
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="{{route('phanquyen.update', '')}}/{{$phanquyen->model_id}}" method = "post" class="adminFormAdd" >
                    @method('PATCH') @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Tên giáo viên</p></td>
                                <td>
                                    <td><input type="text" value="{{$phanquyen->GiaoVien->HoGV . ' ' . $phanquyen->GiaoVien->TenGV}}" class="formInput formInputMa"></td>
                                </td>
                                  <td><p class="adminFormAddText">Tên quyền</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="TenQuyen" class="formSelect">
                                            @foreach ($quyen as $item)
                                            <option @if ($item->id == $phanquyen->role_id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                         
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submit" class="px-3 py-1 border-0 rounded modalBtn mr-2">Thực hiện</button>
                        <a href = "admin/phanquyen" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
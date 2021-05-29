@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/khoi/tab')

    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Chi tiết khôi
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">

                <form action="{{route('khoi.destroy', '')}}/{{$khoi->id}}" method="post" class = "adminFormAdd">
                    @method('DELETE') @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Mã khối</p></td>
                                <td> <input  type="text" name="MaKhoi" value="{{$khoi->MaKhoi}}" class="formInput formInputMa"></td>
                                <td><p class="adminFormAddText">Tên khối</p></td>
                                <td>
                                    <input  type="text" name="TenKhoi" value = "{{$khoi->TenKhoi}}" class="formInput formInputMa capitalize">
                                </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Được phép</p></td>
                                <td>
                                    <div class="formBoxSelect">
                                        <select name="DuocPhep" class="formSelect formInputMa">
                                            <option @if ($khoi->DuocPhep == 1) selected @endif value="1">Được</option>
                                            <option @if ($khoi->DuocPhep == 0) selected @endif value="0">Không</option>
                                        </select>
                                        <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                    </div>
                            </tr>
                        </table>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submit" class="px-3 py-1 border-0 rounded modalBtn mr-2">Thực hiện</button>
                        <a href = "admin/khoi" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
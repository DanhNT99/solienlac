@extends('admin/layouts/index')

@section('adminContent')
    @include('admin/hocsinh/tab')

    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Chỉnh sữa học tập
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="{{route('hoc.destroy','')}}/{{$hoc->id}}" method = "post" class="adminFormAdd" >
                    @method('DELETE') @csrf
                    <div class="adminFormAddContains">
                        <table class="adminFormAddTable adminFormAddTableSmall">
                            <tr>
                                <td><p class="adminFormAddText">Niên khóa</p></td>
                               <td> <input type="text" class="formInput formInputMa" value="{{$hoc->NienKhoa->NamBatDau . '-'. $hoc->NienKhoa->NamBatDau}}"> </td>
                                <td><p class="adminFormAddText">Học sinh</p></td>
                                <td> <input type="text" class="formInput formInputMa" value="{{$hoc->HocSinh->HoHS . ' '. $hoc->HocSinh->TenHS}}"> </td>
                            </tr>
                            <tr>
                                <td><p class="adminFormAddText">Lớp</p></td>
                                <td>
                                    <input type="text" class="formInput formInputMa" value="{{$hoc->Lop->TenLop}}">
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
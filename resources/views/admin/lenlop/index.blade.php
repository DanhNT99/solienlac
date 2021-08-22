@extends('admin/layouts/index')
@section('title')Lên Lớp @endsection
@section('adminContent')
    @include('admin/layouts/tab')
<form action="{{route('lenlop.store')}}" class="adminFormSearch" method = "post">
    @csrf
    <section class="adminForm">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0">Đánh giá cuối năm</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="adminContainsFormSearch">
                <ul class="d-flex w-90 px-5 flex-wrap mx-auto">
                    <li class="mr-2">
                        <p class="btnUpClass btnSubject boxSubjectActive ">Lên lớp</p>
                    </li>
                    <li class="mr-2">
                        <p class="btnNoUpClass btnSubject">Ở lại lớp</p>
                    </li>
                </ul>
                <table class="adminFormSeachTable">
                  <tr>
                    <td><p class="adminFormSearchText">Lớp hiện tại</p></td>
                    <td>
                        <div class="formBoxSelect">
                            <select name="" class="formSelect" id = "currentClass">
                                @foreach ($lop as $item)
                                    @if (Request::get('Lop') == $item->id)
                                        <option selected value="{{$item->id}}">{{$item->TenLop}}</option>
                                    @endif 
                                @endforeach
                            </select>
                            <div class="formSelectIcon">
                                <i class="fas fa-caret-down"></i>
                            </div>
                        </div>
                    </td>
                      <td><p class="adminFormSearchText mr-2">Niên khóa</p></td>
                      <td>
                            <div class="formBoxSelect">
                              <select name="NienKhoa" class="formSelect ">
                              @foreach ($nienkhoa as $item)
                                @if (($item->NamBatDau - $nienkhoaHT) == 1)
                                    <option value="{{$item->id}}">{{$item->NamBatDau . ' - ' . $item->NamKetThuc}}</option>
                                @endif
                              @endforeach
                              </select>
                              <div class="formSelectIcon"> <i class="fas fa-caret-down"></i></div>
                            </div>
                            @if ($errors->has('NienKhoa')) 
                                <div class="notiFail" role="alert"> {{$errors->first('NienKhoa')}}</div>
                            @endif
                      </td>
                  </tr>
                  <tr>
                    <td><p class="adminFormSearchText">Chọn lớp</p></td>
                    <td>
                        <div class="formBoxSelect">
                            <select name="Lop" class="formSelect" id = "lop">
                            </select>
                            <div class="formSelectIcon"> <i class="fas fa-caret-down"></i> </div>
                        </div>
                        @if ($errors->has('Lop')) 
                            <div class="notiFail" role="alert"> {{$errors->first('Lop')}}</div>
                        @endif
                    </td>
                  </tr>
                </table>
                <div class="adminFormAdd">
                    <div class="adminFormAddGroup">
                        <button type="submmit" name = "LenLop" class="px-2 py-1 border-0 rounded modalBtn mr-1">Thực hiện</button>
                        <a href="admin/lenlopchonlopvakhoi" class="adminFormAddLink">Làm mới</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="adminList">
        <div class="container">
            <h3 class="adminListTitle">Danh sách học sinh được lên lớp</h3>
            <div class="input-group mb-1">
                <input type="checkbox" class="inputCheckAll" hidden />
                <label for="checkbox" class="checkbox m-0">
                    <span class="icon"></span>
                    <span class="text">Check all</span>
                </label>
            </div> 
            <table class="adminTable studentUpClass" border="1">
                <tr class = "adminTableTitle">
                    <th>Stt</th>
                    <th>Mã học sinh</th>
                    <th>Tên học sinh</th>
                    <th>Tên lớp</th>
                    <th>Niên khóa</th>
                    <th>Học lực</th>
                    <th>Chọn</th>
                </tr>
                @foreach ($hocsinhlenlop as $item)
                    <tr class = "adminTableContent">
                        <td>{{$stt++}}</td>
                        <td>{{$item->HocSinh->MaHS}}</td>
                        <td class = "text-left pl-3">{{$item->HocSinh->HoHS . ' ' . $item->HocSinh->TenHS}}</td>
                        <td>{{$item->Lop->TenLop}}</td>
                        <td>{{$item->NienKhoa->NamBatDau .'-' .$item->NienKhoa->NamKetThuc}}</td>
                        <td class = "text-left pl-3">{{$item->HocLuc}}</td>
                        <td>
                            <input type="checkbox" name="idStudent[]" class="checkBoxStudent" value="{{$item->HocSinh->id}}">
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </section>
</form>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
        //HANDLE ACTIVE TAB UP CLASSC AND NO UP CLASS
            $('.btnSubject').click(function (e) { 
                e.preventDefault();
                 $('.btnSubject').removeClass('boxSubjectActive');
                 $(this).addClass('boxSubjectActive')
            });
        //END
            let nameClassCurrent = parseInt($('#currentClass').text().trim().substr('0', 1));
            let listClass = {!! json_encode($lop) !!}

            let listClassBigger = listClass.filter(item => {
                let nameClass = item.TenLop.substr('0', 1);
                return nameClass - nameClassCurrent == 1;
            })
            listClassBigger = listClassBigger.map(item => {
                return `<option value = ${item.id}>${item.TenLop}</option>`
            })
            $('#lop').html(listClassBigger.join(''));
        $('.btnUpClass').click(function () { 
            location.reload()
        });
        //HANLDE STUDENT NO UP CLASS
        $('.btnNoUpClass').click(function () { 
            //GET CLASS EQUAL CLASS CURRENT
                let listClassEqual = listClass.filter(item => {
                let nameClass = item.TenLop.substr('0', 1);
                    return nameClass - nameClassCurrent == 0;
                })
                listClassEqual = listClassEqual.map(item => {
                    return `<option value = ${item.id}>${item.TenLop}</option>`
                })
                $('#lop').html(listClassEqual.join(''));
            //END

            //CHANGE BTN UPCLASS -> DON'T UP CLASS
                $('.modalBtn').attr('name', 'KhongLenLop');
                $('.adminListTitle').text('Danh sách học sinh không được lên lớp');
            //END

            //GET STUDENT NO UP CLASS
                let listStudentNoUpClass = {!! json_encode($hocsinhkhonglenlop) !!}
                let listYear = {!! json_encode($nienkhoa) !!}
                let stt = 1;
                listStudentNoUpClass = listStudentNoUpClass.map(item => {
                        return `<tr class = adminTableContent>
                            <td>${stt++}</td>
                            <td>${item.MaHS}</td>
                            <td>${item.HoHS + ' ' + item.TenHS}</td>
                            <td>${
                                listClass.filter(lop => lop.id == item.id_lop)[0].TenLop
                            }</td>
                            <td>${
                                listYear.filter(year => year.id == item.id_nienkhoa)[0].NamBatDau + '-' + 
                                listYear.filter(year => year.id == item.id_nienkhoa)[0].NamKetThuc
                            }</td>
                            <td>${item.HocLuc}</td>
                            <td>
                                <input type="checkbox" name="idStudent[]" class="checkBoxStudent" value="${item.id_hocsinh}">
                            </td>
                        </tr>`
                })
                $('.adminTableContent').remove();
                $('.studentUpClass').append(listStudentNoUpClass.join(''));
            //END
            });
        //END
        });
    </script>
@endsection
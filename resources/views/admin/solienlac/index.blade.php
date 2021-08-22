@extends('admin/layouts/index')
@section('title') Sổ liên lạc @endsection
@section('adminContent')
    @include('admin/layouts/tab')
    <section class="adminForm">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2 mb-2" style="width: fit-content;">
                <div>
                    <span>Năm học : {{$nienkhoa->NamBatDau . ' - ' . $nienkhoa->NamKetThuc}}</span>
                    <span class="mx-2">|</span>
                    <span>{{$hocky->TenHK}}</span>
                    @if (Auth::guard('giao_vien')->user()->hasrole('Giáo viên chủ nhiệm'))
                    <span class="mx-2">|</span>
                    <span>
                        Lớp: {{Auth::guard('giao_vien')->user()->Lop->TenLop}}
                    </span>
                    @endif
                </div>
            </div>
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-search-plus adminBoxTitleIcon"></i>
                    Tìm kiếm thông tin học sinh</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
             </div>
             <div class="adminContainsFormSearch">
                <form action="{{route('timkiemsolienlac')}}" class="adminFormSearch" method = "get">
                    <table class="adminFormSeachTable">
                        @if (Auth::guard('giao_vien')->user()->hasrole('Quản trị viên'))
                        <tr>
                            <td><p class="adminFormSearchText ml-0">Niên khóa</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="nienkhoa" class="formSelect formSelectSmall ">
                                        <option value="{{$nienkhoa->id}}">{{$nienkhoa->NamBatDau . ' - ' . $nienkhoa->NamKetThuc}}</option>
                                    </select>
                                    <div class="formSelectIcon"><i class="fas fa-caret-down"></i></div>
                                </div>
                            </td>
                            <td class=""><p class="adminFormSearchText ml-0">Khối</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="Khoi" id="khoi" class="formSelect formSelectSmall">
                                        <option value = "NULL">Tất cả</option>
                                        @foreach ($khoi as $item)
                                            <option @if (Request::get('Khoi') == $item->id) selected
                                            @endif value="{{$item->id}}">{{$item->TenKhoi}}</option>
                                        @endforeach
                                    </select>
                                    <div class="formSelectIcon">
                                        <i class="fas fa-caret-down"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                        <tr>
                            @if (Auth::guard('giao_vien')->user()->hasrole('Quản trị viên'))
                            <td><p class="adminFormSearchText ml-0">Lớp</p></td>
                            <td>
                                <div class="formBoxSelect">
                                    <select name="Lop" class="formSelect formSelectSmall" id = "lop">
                                        <option value = "NULL">Tất cả</option>
                                        @foreach ($lop as $item)
                                            <option @if (Request::get('Lop') == $item->id) selected
                                              @endif  class="formBoxSelectOption" value="{{$item->id}}">{{$item->TenLop}}</option>
                                        @endforeach
                                    </select>
                                    <div class="formSelectIcon">
                                        <i class="fas fa-caret-down"></i>
                                    </div>
                                </div>
                            </td>
                            @endif
                            <td><p class="adminFormSearchText">Mã học sinh</p></td>
                            <td>
                                <input type="text" name = "MaHS" class = "formInput" placeholder="Mã học sinh">
                            </td>
                        </tr>
                        <tr>
                            <td><p class="adminFormSearchText">Tên học sinh</p></td>
                            <td>
                                <input type="text" name = "TenHS" class = "formInput" placeholder="Tên học sinh">
                            </td>
                        </tr>
                  </table>
                  <div class="adminFormSearchContainsBtn">
                    <button class="adminFormSearchBtn">Tìm kiếm</button>
                  </div>
                </form>
            </div>
        </div>
    </section>

    <section class="adminList">
        <div class="container">
            @if (Auth::guard('giao_vien')->user()->hasrole('Giáo viên chủ nhiệm'))
                <h3 class="adminListTitle">Thống kê sổ liên lạc</h3>
                <table class="adminTable my-2 mb-2" border = "1">
                    <tr>
                        <th>Tên học lực</th>
                        <th>Hoàn thành xuất sắc</th>
                        <th>Hoàn thành tốt</th>
                        <th>Hoàn thành</th>
                        <th>Chưa hoàn thành</th>
                    </tr>
                    <tr>
                        <th>Số lượng</th>
                        <td>{{$DemXuatSac}}</td>
                        <td>{{$DemHTT}}</td>
                        <td>{{$DemHT}}</td>
                        <td>{{$DemCHT}}</td>
                    </tr>
                </table>
            @endif
            <h3 class="adminListTitle">Sổ liên lạc học sinh</h3>
            <table class="adminTable" border="1">
                <tr>
                    <th>Stt</th>
                    <th>Mã SLL</th>
                    <th>Mã học sinh</th>
                    <th>Tên học sinh</th>
                    <th>Niên khóa</th>
                    <th>Học lực</th>
                    <th>Nhận xét</th>
                    <th>Chọn</th>
                </tr>
                    @foreach ($solienlac as $item)
                        <tr>
                            <td>{{$stt++}}</td>
                            <td>{{$item->MaSLL}}</td>
                            <td>{{$item->HocSinh->MaHS}}</td>
                            <td class = "text-left pl-2">{{$item->HocSinh->HoHS . ' ' . $item->HocSinh->TenHS}}</td>
                            <td>{{$item->NienKhoa->NamBatDau . '-' . $item->NienKhoa->NamKetThuc}}</td>
                            <td class = "text-left pl-3">
                                @if(count($item->NhanXet->where('id_hocky', $hocky->id)))
                                    @if ($item->NhanXet->where('id_hocky', $hocky->id)->first()->HocLuc)
                                        {{$item->NhanXet->where('id_hocky', $hocky->id)->first()->HocLuc}}
                                    @else Chưa đánh giá @endif
                                @else Chưa đánh giá @endif
                            </td>
                            <td class = "containNhanXet text-left pl-3">
                                @if(count($item->NhanXet->where('id_hocky', $hocky->id)))
                                    @if ($item->NhanXet->where('id_hocky', $hocky->id)->first()->NoiDungNhanXet)
                                        {{$item->NhanXet->where('id_hocky', $hocky->id)->first()->NoiDungNhanXet}}
                                    @else Chưa đánh giá @endif
                                @else Chưa đánh giá @endif
                            </td>
                            <td>
                                @if (Auth::guard('giao_vien')->user()->hasrole('Quản trị viên'))
                                    <a href="admin/solienlac/{{$item->id_hocsinh}}" class="px-2 py-1 border-0 rounded modalBtn">Xem chi tiết</a>
                                @else 
                                    <a href="admin/solienlac/{{$item->id_hocsinh}}/edit" class="px-2 py-1 border-0 rounded modalBtn">Nhận xét</a>
                                @endif

                            </td>
                        </tr>
                    @endforeach
            </table>
        </div>
    </section>

    @if (Session::has('noti'))
        <div class="notiBox">
        <h4 class="notiBoxTitle">Thông báo <button class="notiBoxBtn"><i class="far fa-window-close"></i></button></h4>
        <p class="notiBoxContent"> {{Session('noti')}}!</p>
        </div>
    @endif
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#khoi').change(function (e) { 
                let idGrade = $(this).val();
                let listClass = {!! json_encode($lop)!!}
                listClass = listClass.filter(item => {
                    return item.id_khoi == idGrade;
                })

                listClass = listClass.map(item => {
                    return `<option value = ${item.id}>${item.TenLop}</option>`;
                })
                $('#lop').html(listClass.join(''));
            });
        });
    </script>
@endsection
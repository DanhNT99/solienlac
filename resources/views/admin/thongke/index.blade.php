@extends('admin/layouts/index')
@section('title')Thông kê sổ liên lạc @endsection
@section('adminContent')
    @include('admin/layouts/tab')

    @section('css')
        <style>

         @media print {
             body {
                 background: white;
             }
            .hidden-lg {
                position: absolute;
                top: 0;
                left: 50%;
                transform: translateX(-50%);
            }
            .adminContainsFormSearch {
                margin-top: 40px;
            }
            .adminFormSearch .adminFormSeachTable .adminFormSearchText {
                font-size: 20px;
            }
            .formBoxSelect .formSelect {
                background: transparent;
                border: none;
                width: fit-content;
                font-size: 20px;
            }
            .formBoxSelect .formSelect.formSelectSmall {
                text-align-last: left;
            }
            .formBoxSelect .formSelectIcon {
               background: white;
            }
           .adminFormSearch .adminFormSeachTable {
                width: fit-content;
            }
            .rowNone {
                display: none;
            }
         }
        </style>
    @endsection
    <section class="adminForm">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-address-book"></i>
                    Thống kê sổ liên lạc</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="adminContainsFormSearch">
                <form action="{{route('timkiemthongke')}}" class="adminFormSearch" method = "get">
                  <table class="adminFormSeachTable tableSmall">
                    <tr>
                        <td><p class="adminFormSearchText ml-0">Niên khóa</p></td>
                        <td>
                            <div class="formBoxSelect">
                                <select name="nienkhoa" class="formSelect formSelectSmall ">
                                    <option selected disabled>Lựa chọn</option>
                                @foreach ($nienkhoa as $item)
                                    <option @if ($item->id == Request::get('nienkhoa')) selected 
                                    @endif value="{{$item->id}}">{{$item->NamBatDau . ' - ' . $item->NamKetThuc}}</option>
                                @endforeach
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
            <h3 class="adminListTitle hidden-lg">Thống kê Sổ liên lạc học sinh</h3>
            <button type="button" onclick="window.print()" class="px-3 py-1 border-0 rounded modalBtn mb-2">
                               <i class="fas fa-file-download mr-1"></i> Xuất Pdf
                            </button>
            <table class="adminTable my-2" border = "1">
                <tr>
                    <th>Tên học lực</th>
                    <th>Hoàn thành xuất sắc</th>
                    <th>Hoàn thành tốt</th>
                    <th>Hoàn thành</th>
                    <th>Chưa hoàn thành</th>
                </tr>
                <tr>
                    <th>Số lượng</th>
                    <td class = "text-center">{{$DemXuatSac}}</td>
                    <td class = "text-center">{{$DemHTT}}</td>
                    <td class = "text-center">{{$DemHT}}</td>
                    <td class = "text-center">{{$DemCHT}}</td>
                </tr>
            </table>
            <table class="adminTable mt-3" border="1">
                <tr>
                    <th>Stt</th>
                    <th class="rowNone">Mã SLL</th>
                    <th class="rowNone">Mã học sinh</th>
                    <th>Tên học sinh</th>
                    <th>Học lực</th>
                    <th>Nhận xét</th>
                    <th class="rowNone">Chọn</th>
                </tr>
                @foreach ($solienlac as $item)
                    <tr>
                        <td class = "text-center">{{$stt++}}</td>
                        <td class="rowNone">{{$item->MaSLL}}</td>
                        <td class="rowNone">{{$item->HocSinh->MaHS}}</td>
                        <td class = "text-left pl-3">{{$item->HocSinh->HoHS . ' ' . $item->HocSinh->TenHS}}</td>
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
                        <td class="rowNone text-center">
                           <a href="admin/thongke/{{$item->HocSinh->id}}?nienkhoa={{$item->NienKhoa->id}}" class="px-2 py-1 border-0 rounded modalBtn">Xem chi tiết</a>
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
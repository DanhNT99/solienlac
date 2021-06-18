@extends('admin/layouts/index')
@section('title') Phân môn học @endsection
@section('adminContent')
    @include('admin/khoi/tab')
    <section class="adminAdd">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><i class="fas fa-plus-circle adminBoxTitleIcon mr-1"></i>Phân môn học</h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="adminFormAddBox">
                <form action="{{route('phanmonhoc.store')}}" method = "post" class="adminFormAdd" >
                    @csrf
                    <div class="adminFormAddContain ">
                        <p class = "px-4">Chọn môn học: </p>
                        <ul class="d-flex w-90 px-5 flex-wrap mx-auto">
                            @foreach ($monhoc as $item)
                            <li class="mr-2">
                                    <div class = "boxSubject">{{$item->TenMH}}</div>
                                    <input type="checkbox" class = "d-none"  value="{{$item->id}}" name = "monhoc[]">
                            </li>
                         @endforeach
                        </ul>
                        <p class = "px-4 mt-2">Chọn khối: </p>
                        <ul class="d-flex w-90 px-5 flex-wrap mx-auto">
                            @foreach ($khoi as $item)
                            <li class="mr-2">
                                     <div class = "boxSubject">{{$item->TenKhoi}}</div>
                                    <input type="checkbox" class = "d-none" value="{{$item->id}}" name = "khoi[]">
                            </li>
                         @endforeach
                        </ul>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submmit" class="adminFormAddBtn">Thêm</button>
                        <a href = "admin/phanmonhoc" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
               @if (Session::has('loiphanmonhoc'))
                  <div class="notiFail" role="alert">
                        @foreach(Session('loiphanmonhoc') as $key => $value)
                            <p>{{'Môn ' . $value['TenMH'] . ' đã phân cho ' . $value['TenKhoi'] . ' rồi'}}</p>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
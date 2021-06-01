@extends('admin/layouts/index')
@section('title') Phân môn học @endsection
@section('adminContent')
    @include('admin/khoi/tab')
    <section class="adminAdd">
        <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-user-plus adminBoxTitleIcon"></i>Phân công môn học
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </h3>
            <div class="adminFormAddBox">
                <form action="{{route('phanmonhoc.store')}}" method = "post" class="adminFormAdd" >
                    @csrf
                    <div class="adminFormAddContain ">
                        <p>Chọn lớp: </p>
                        <ul class="d-flex w-90 flex-wrap mx-auto">
                            @foreach ($monhoc as $item)
                            <li class="ml-5">
                                    <label for="">{{$item->TenMH}}</label>
                                    <input type="checkbox" value="{{$item->id}}" name = "monhoc[]">
                            </li>
                         @endforeach
                        </ul>
                        <p>Chọn khối: </p>
                        <ul class="d-flex w-90 flex-wrap mx-auto">
                            @foreach ($khoi as $item)
                            <li class="ml-5">
                                    <label for="">{{$item->TenKhoi}}</label>
                                    <input type="checkbox" value="{{$item->id}}" name = "khoi[]">
                            </li>
                         @endforeach
                        </ul>
                    </div>
                    <div class="adminFormAddGroup">
                        <button type="submmit" class="adminFormAddBtn">Thêm</button>
                        <a href = "admin/phanmonhoc" class="adminFormAddLink">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
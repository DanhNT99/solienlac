<section class="adminTab">
    <div class="container-xl">
        <div class="adminBoxTitle py-1 px-2">
            <h6 class="m-0"><i class="fas fa-house-user adminBoxTitleIcon mr-1"></i>Hệ thống</h6>
            <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
        </div>
    
        <div class="adminMainTab">
            <div class="row flex-wrap ml-2">
                <div class="adminTabItem mb-4">
                    <a href="admin/hocsinh" class="adminTabItemLink py-2 px-2">
                        <img src = "{{asset('assets/images/iconStudent.png')}}" class = "adminTabItemIcon">
                        <p class = "mt-1">Quản lý học sinh</p>
                    </a>
                </div>

                @if (Auth::guard('giao_vien')->user()->hasrole('Quản trị viên'))
            
                <div class="adminTabItem">
                    <a href = "admin/giaovien" class="adminTabItemLink py-2 px-2">
                        <img src = "{{asset('assets/images/iconTeacher.png')}}" class = "adminTabItemIcon">
                        <p class = "mt-1">Quản lý giáo viên</p>
                    </a>
                </div>
                <div class="adminTabItem">
                    <a href = "admin/solienlacchonkhoivalop" class="adminTabItemLink tabBtn  py-2 px-2">
                    <img src = "{{asset('assets/images/iconContactBook.png')}}" class = "adminTabItemIcon">
                        <p class = "mt-1">Quản lý Sổ liên lạc</p>
                    </a>
                </div>
                <div class="adminTabItem">
                    <a href="admin/khoi" class="adminTabItemLink py-2 px-2">
                        <img src = "{{asset('assets/images/iconSchool.png')}}" class = "adminTabItemIcon">
                        <p class = "mt-1">Quản lý trường học</p>
                    </a>
                </div>
                <div class="adminTabItem">
                    <a href="admin/nienkhoa" class="adminTabItemLink py-2 px-2">
                    <img src = "{{asset('assets/images/iconCalendar.png')}}" class = "adminTabItemIcon">
                        <p class = "mt-1">Quản lý niên khóa</p>
                    </a>
                </div>
                <div class="adminTabItem mb-4">
                    <a href="admin/phuong" class="adminTabItemLink py-2 px-2">
                    <img src = "{{asset('assets/images/iconMap.png')}}" class = "adminTabItemIcon">
                        <p class = "mt-1">Quản lý phường</p>
                    </a>
                </div>
                 <div class="adminTabItem">
                    <a href="admin/quyen" class="adminTabItemLink py-2 px-2">
                        <img src = "{{asset('assets/images/iconDecentralized.png')}}" class = "adminTabItemIcon">
                        <p class = "mt-1">Quản lý phân quyên</p>
                    </a>
                 </div>
                 <div class="adminTabItem">
                    <a href="admin/phamchatnangluc" class="adminTabItemLink py-2 px-2">
                        <img src = "{{asset('assets/images/iconAbility.png')}}" class = "adminTabItemIcon">
                        <p class = "mt-1">Quản lý phẩm chất</p>
                    </a>
                </div>
                <div class="adminTabItem">
                    <a href="admin/chophepnhapdiem" class="adminTabItemLink py-2 px-2 ">
                        <img src = "{{asset('assets/images/iconSetting.png')}}" class = "adminTabItemIcon">
                        <p class = "mt-1">Quy định nhập điểm</p>
                    </a>
                </div>
                <div class="adminTabItem ">
                    <a href="admin/lenlopchonlopvakhoi" class="adminTabItemLink py-2 px-2 ">
                        <img src = "{{asset('assets/images/graduation.png')}}" class = "adminTabItemIcon">
                        <p class = "mt-1">Lên Lớp</p>
                    </a>
                </div>
                <div class="adminTabItem mr-0">
                    <a href = "admin/thongkechonkhoivalop" class="adminTabItemLink tabBtn  py-2 px-2">
                    <img src = "{{asset('assets/images/iconContactBook.png')}}" class = "adminTabItemIcon">
                        <p class = "mt-1">Thống kê</p>
                    </a>
                </div>
                @endif
                
                @if (Auth::guard('giao_vien')->user()->hasrole('Giáo viên chủ nhiệm'))
                <div class="adminTabItem">
                    <a href = "admin/solienlac" class="adminTabItemLink tabBtn  py-2 px-2">
                    <img src = "{{asset('assets/images/iconContactBook.png')}}" class = "adminTabItemIcon">
                        <p class = "mt-1">Quản lý Sổ liên lạc</p>
                    </a>
                </div>
                    <div class="adminTabItem">
                        <a href="admin/ketquahoctap"  class="adminTabItemLink  py-2 px-2">
                         <img src = "{{asset('assets/images/iconStudy.png')}}" class = "adminTabItemIcon">
                            <p class = "mt-1">Nhập điểm học sinh</p>
                        </a>
                    </div> 
                    <div class="adminTabItem">
                        <a href="admin/ketquarenluyen"  class="adminTabItemLink py-2 px-2">
                          <img src = "{{asset('assets/images/iconStudy.png')}}" class = "adminTabItemIcon">
                            <p class = "mt-1">Đánh giá rèn luyện</p>
                        </a>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</section>
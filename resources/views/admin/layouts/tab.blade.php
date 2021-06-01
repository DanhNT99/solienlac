<section class="adminTab">
    <div class="container">
            <h3 class="adminBoxTitle"><i class="fas fa-house-user adminBoxTitleIcon"></i> Hệ thống
            <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span></h3>
        <div class="adminMainTab">
            <div class="row flex-wrap">
                <div class="adminTabItem">
                    <a href="admin/hocsinh" class="adminTabItemLink py-2 px-2">
                        {{-- <i class="fas fa-user-graduate adminTabItemIcon"></i> --}}
                        <img src = "{{asset('assets/images/iconStudent.png')}}" class = "adminTabItemIcon">
                        <p class = "mt-1">Quản lý học sinh</p>
                    </a>
                </div>
                @if (Auth::guard('giao_vien')->user()->hasrole('Quản trị viên'))
                <div class="adminTabItem py-2 px-2">
                    <a href="admin/giaovien" class="adminTabItemLink">
                    <img src = "{{asset('assets/images/iconTeacher.png')}}" class = "adminTabItemIcon">
                        <p class = "mt-1">Quản lý giáo viên</p>
                    </a>
                </div>
                <div class="adminTabItem">
                    <a href="admin/khoi" class="adminTabItemLink py-2 px-2">
                        <img src = "{{asset('assets/images/iconSchool.png')}}" class = "adminTabItemIcon">
                        <p class = "mt-1">Trường học</p>
                    </a>
                </div>
                <div class="adminTabItem">
                    <a href="admin/nienkhoa" class="adminTabItemLink py-2 px-2">
                    <img src = "{{asset('assets/images/iconCalendar.png')}}" class = "adminTabItemIcon">
                        <p class = "mt-1">Niên khóa</p>
                    </a>
                </div>
                <div class="adminTabItem">
                    <a href="admin/tinh" class="adminTabItemLink py-2 px-2">
                    <img src = "{{asset('assets/images/iconMap.png')}}" class = "adminTabItemIcon">
                        <p class = "mt-1">Địa chỉ</p>
                    </a>
                </div>
                 <div class="adminTabItem">
                    <a href="admin/quyen" class="adminTabItemLink py-2 px-2">
                        <img src = "{{asset('assets/images/iconDecentralized.png')}}" class = "adminTabItemIcon">
                        <p class = "mt-1">Phân quyên</p>
                    </a>
                 </div>
                 <div class="adminTabItem mr-0">
                    <a href="admin/phamchatnangluc" class="adminTabItemLink py-2 px-2">
                        <img src = "{{asset('assets/images/iconAbility.png')}}" class = "adminTabItemIcon">
                        <p class = "mt-1">Phẩm chất năng lực</p>
                    </a>
                </div>
                <div class="adminTabItem mr-0 mt-2">
                    <a href="admin/chophepnhapdiem" class="adminTabItemLink py-2 px-2 ">
                        <p class = "mt-1">Cho Phép nhập điểm</p>
                    </a>
                </div>
                @endif
                
                @if (Auth::guard('giao_vien')->user()->hasrole('Giáo viên chủ nhiệm'))
                    <div class="adminTabItem">
                        <a href="admin/ketquahoctap"  class="adminTabItemLink  py-2 px-2">
                         <img src = "{{asset('assets/images/iconStudy.png')}}" class = "adminTabItemIcon">
                            <p class = "mt-1">Nhập điểm học sinh</p>
                        </a>
                    </div> 
                    
                    <div class="adminTabItem">
                        <a href="admin/solienlac"  class="adminTabItemLink  py-2 px-2">
                        <img src = "{{asset('assets/images/iconContactBook.png')}}" class = "adminTabItemIcon">
                            <p class = "mt-1">Quản lý Sổ liên lạc</p>
                        </a>
                    </div>
                    <div class="adminTabItem">
                        <a href="admin/ketquarenluyen"  class="adminTabItemLink py-2 px-2">
                          <img src = "{{asset('assets/images/iconStudy.png')}}" class = "adminTabItemIcon">
                            <p class = "mt-1">Quản lý rèn luyện</p>
                        </a>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</section>
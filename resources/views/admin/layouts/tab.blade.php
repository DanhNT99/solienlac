<section class="adminTab">
    <div class="container">
        <h3 class="adminBoxTitle"><i class="fas fa-house-user adminBoxTitleIcon"></i> Hệ thống
            <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span></h3>
        <div class="adminMainTab">
            <div class="row flex-wrap">
                <div class="adminTabItem">
                    <a href="admin/hocsinh" class="adminTabItemLink  py-2 px-4">
                        {{-- <i class="fas fa-user-graduate adminTabItemIcon"></i> --}}
                        <img src = "{{asset('assets/images/iconStudent.png')}}" class = "adminTabItemIcon">
                        <p>Học sinh</p>
                    </a>
                </div>
                @if (Auth::guard('giao_vien')->user()->hasrole('Quản trị viên'))
                <div class="adminTabItem py-2 px-4">
                    <a href="admin/giaovien" class="adminTabItemLink">
                    <img src = "{{asset('assets/images/iconTeacher.png')}}" class = "adminTabItemIcon">
                        <p>Giáo viên</p>
                    </a>
                </div>
                <div class="adminTabItem">
                    <a href="admin/khoi" class="adminTabItemLink py-2 px-4">
                        <img src = "{{asset('assets/images/iconSchool.png')}}" class = "adminTabItemIcon">
                        <p>Trường học</p>
                    </a>
                </div>
                <div class="adminTabItem">
                    <a href="admin/nienkhoa" class="adminTabItemLink py-2 px-4">
                    <img src = "{{asset('assets/images/iconCalendar.png')}}" class = "adminTabItemIcon">
                        <p>Niên khóa</p>
                    </a>
                </div>
                <div class="adminTabItem">
                    <a href="admin/tinh" class="adminTabItemLink py-2 px-4">
                    <img src = "{{asset('assets/images/iconMap.png')}}" class = "adminTabItemIcon">
                        <p>Địa chỉ</p>
                    </a>
                </div>
                 <div class="adminTabItem">
                        <a href="admin/quyen" class="adminTabItemLink py-2 px-4">
                        <img src = "{{asset('assets/images/iconDecentralized.png')}}" class = "adminTabItemIcon">
                        <p>Phân quyên</p>
                        </a>
                 </div>
                 <div class="adminTabItem mr-0">
                    <a href="admin/phamchatnangluc" class="adminTabItemLink py-2 px-4">
                        <img src = "{{asset('assets/images/iconAbility.png')}}" class = "adminTabItemIcon">
                        <p>Phẩm chất</p>
                    </a>
                </div>
                @endif
                
                @if (Auth::guard('giao_vien')->user()->hasrole('Giáo viên chủ nhiệm'))
                    <div class="adminTabItem">
                        <a href="admin/ketquahoctap"  class="adminTabItemLink py-2 px-4">
                            <p>Quản lý học tập</p>
                        </a>
                    </div> 
                    
                    <div class="adminTabItem">
                        <a href="admin/solienlac"  class="adminTabItemLink py-2 px-4">
                            <p>Sổ liên lạc</p>
                        </a>
                    </div>
                    <div class="adminTabItem">
                        <a href="admin/ketquarenluyen"  class="adminTabItemLink py-2 px-4">
                            <p>Quản lý rèn luyện</p>
                        </a>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</section>
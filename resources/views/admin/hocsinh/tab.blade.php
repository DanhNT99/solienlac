<section class="adminTab">
    <div class="container">
        <h3 class="adminBoxTitle">
            <a href = "admin/index"><i class="fas fa-house-user adminBoxTitleIcon"></i> Hệ thống</a>
            <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span></h3>
        <div class="row adminMainTab">
            <div class="adminTabItem">
                <a href="admin/hocsinh" class="adminTabItemLink  py-2 px-4">
                    <img src = "{{asset('assets/images/iconStudent.png')}}" class = "adminTabItemIcon">
                    <p>Học sinh</p>
                </a>
            </div>
            @if (Auth::guard('giao_vien')->user()->hasrole('Quản trị viên'))
            <div class="adminTabItem">
                <a href="admin/hoc" class="adminTabItemLink  py-2 px-4">
                    <img src = "{{asset('assets/images/iconBallot.png')}}" class = "adminTabItemIcon">
                    <p>Phân công học tập</p>
                </a>
            </div>
            @endif
        </div>
    </div>
</section>
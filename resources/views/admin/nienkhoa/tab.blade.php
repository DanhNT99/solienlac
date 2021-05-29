    <section class="adminTab">
        <div class="container">
            <h3 class="adminBoxTitle">
                <a href = "admin/index"><i class="fas fa-house-user adminBoxTitleIcon"></i> Hệ thống</a>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span></h3>
            <div class="row adminMainTab">
                <div class="adminTabItem">
                    <a href="admin/nienkhoa" class="adminTabItemLink py-2 px-4">
                        <img src = "{{asset('assets/images/iconCalendar.png')}}" class = "adminTabItemIcon">
                        <p>Niên khóa</p>
                    </a>
                </div>
                <div class="adminTabItem">
                    <a href="admin/hocky" class="adminTabItemLink py-2 px-4">
                        <img src = "{{asset('assets/images/iconSemester.png')}}" class = "adminTabItemIcon">
                        <p>Học kỳ</p>
                    </a>
                </div>
            </div>
        </div>
    </section>
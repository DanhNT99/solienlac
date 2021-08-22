    <section class="adminTab">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><a href = "admin/index" class="amdinBoxTitleLink">
                    <i class="fas fa-house-user adminBoxTitleIcon mr-1"></i>Trang chủ</a></h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
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
                        <p>Học kì</p>
                    </a>
                </div>
            </div>
        </div>
            <script>
        $(document).ready(function () {
            $('.adminMainTab').slideDown(0);
        });
    </script>
    </section>
<section class="adminTab">
    <div class="container">
        <div class="adminBoxTitle py-1 px-2">
            <h6 class = "m-0"><a href = "admin/index" class="amdinBoxTitleLink">
                <i class="fas fa-house-user adminBoxTitleIcon mr-1"></i>Trang chủ</a></h6>
            <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
        </div>
        <div class="row adminMainTab">
            <div class="adminTabItem">
                <a href="admin/hocsinh" class="adminTabItemLink py-2 px-2">
                    <img src = "{{asset('assets/images/iconStudent.png')}}" class = "adminTabItemIcon">
                    <p>Quản lý học sinh</p>
                </a>
            </div>
            @if (Auth::guard('giao_vien')->user()->hasrole('Quản trị viên'))
            <div class="adminTabItem">
                <a href="admin/hocchonkhoivalop" class="adminTabItemLink  py-2 px-2">
                    <img src = "{{asset('assets/images/iconBallot.png')}}" class = "adminTabItemIcon">
                    <p>Phân công học tập</p>
                </a>
            </div>
            @endif
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.adminMainTab').slideDown(0);
        });
    </script>
</section>
    <section class="adminTab">
        <div class="container">
            <div class="adminBoxTitle py-1 px-2">
                <h6 class = "m-0"><a href = "admin/index" class="amdinBoxTitleLink">
                    <i class="fas fa-house-user adminBoxTitleIcon mr-1"></i>Trang chủ</a></h6>
                <span class="adminBoxTitleIconUp"><i class="fas fa-angle-double-down"></i></span>
            </div>
            <div class="row adminMainTab">

                <div class="adminTabItem">
                    <a href="admin/khoi" class="adminTabItemLink py-1 px-2">
                        <p>Quản lý khối</p>
                    </a>
                </div>
                <div class="adminTabItem">
                    <a href="admin/lop" class="adminTabItemLink py-1 px-2">
                        <p>Quản lý lớp</p>
                    </a>
                </div>
                <div class="adminTabItem">
                    <a href="admin/monhoc" class="adminTabItemLink py-1 px-2">
                        <p>Quản lý môn học</p>
                    </a>
                </div>
                <div class="adminTabItem">
                    <a href="admin/phanmonhoc" class="adminTabItemLink py-1 px-2">
                        <p>Phân môn học</p>
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
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <a href="#" class="header_ContainsLogo">
                    <img src="{{asset('assets/images/logo.png')}}" class="header-Logo" title="b-contact">
                </a>
            </div>
            <div class="col-6">
               <div class="header_inforSchool">
                    <h1 class="header_inforSchoolName">
                        Trường Tiểu Học Phương Sơn
                    </h1>
                    <ul class="header_listContact">
                        <li class="header_listContactItem">
                            <a href="#" title="037416657" class="header_listContactItemLink" ><i class="fas fa-phone-alt"></i> 037416657</a>
                        </li>
                        <li class="header_listContactItem">
                            <a href="#" title="037416657" class="header_listContactItemLink">
                                <i class="fas fa-school"></i> 81 Phương sài - Nha Trang - Khánh Hòa</a>
                        </li>
                    </ul>
               </div>
            </div>
            <div class="col-4">
                <div class="header_containsUser">
                    <span class="header_userIcon"><i class="fas fa-user-circle"></i></span>
                    @if (Session::has('LoginUser'))
                         <span class = "header_userName">{{Session('LoginUser')}}</span>
                    @endif
                   
                </div>
                <form action = "{{route('handleLogout')}}" method ="post">
                    @csrf
                    <button>logout</button>
                </form>
            </div>
        </div>
    </div>
</header>
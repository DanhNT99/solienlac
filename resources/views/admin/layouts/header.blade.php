<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-2 pl-0">
                <a href="admin/index" class="header_ContainsLogo wrapImgResize">
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
            <div class="col-4 pr-0">
                <div class="header_containsUser">
                        <div class = "header_userName">
                             <i class="fas fa-user-circle header_userIcon"></i> 
                                @if(Auth::guard('giao_vien')->user())     
                                    {{Auth::guard('giao_vien')->user()->HoGV. ' ' . Auth::guard('giao_vien')->user()->TenGV}}
                                @else 
                                    @if(Auth::guard('phu_huynh')->user())
                                       {{Auth::guard('phu_huynh')->user()->HoTenPH}}
                                    @endif
                                @endif
     

                             <div class="header_containsFormLogout">
                                <a href="changePass/index" class = "header_changePasss">
                                    <i class="fas fa-key header_userDropIcon"></i> Đổi mật khẩu
                                </a>
                                {{-- @if(Auth::guard('giao_vien')->user())     
                                    <a href="admin/giaovien/{{Auth::guard('giao_vien')->user()->id}}" class="header_changePasss">
                                        <i class="fas fa-user header_userDropIcon"></i> Xem thông tin
                                    </a>
                                @endif --}}

                                <form action = "{{route('handleLogout')}}" class="header_formLogout" method ="post">
                                    @csrf
                                    <button class = "header_formLogoutBtn">
                                        <i class="fas fa-sign-out-alt header_userDropIcon"></i> logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    {{-- @endif --}}
                </div>
            </div>
        </div>
    </div>
     
</header>
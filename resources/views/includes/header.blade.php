<nav class="navbar navbar-expand-lg navbar-light header-navbar navbar-fixed">
    <div class="container-fluid navbar-wrapper">
        <div class="navbar-header d-flex">
            <div class="navbar-toggle menu-toggle d-xl-none d-block float-left align-items-center justify-content-center"
                data-toggle="collapse"><i class="ft-menu font-medium-3"></i></div>
            
        </div>
        <div class="navbar-container">
            <div class="collapse navbar-collapse d-block" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    
                    
                    <li class="dropdown nav-item mr-1">
                        <a class="nav-link dropdown-toggle user-dropdown d-flex align-items-end" id="dropdownBasic2" href="javascript:;" data-toggle="dropdown">
                            <div class="user d-md-flex d-none mr-2">
                                <span class="text-right">{{\Auth::user()->full_name}}</span>
                                <img class="avatar" src="{{ asset('app-assets/img/portrait/small/avatar-s-1.png')}}" alt="avatar" height="35"width="35">
                        </a>
                        <div class="dropdown-menu text-left dropdown-menu-right m-0 pb-0"
                            aria-labelledby="dropdownBasic2">
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();   document.getElementById('logout-form').submit();">
                                <div class="d-flex align-items-center">
                                    <i class="ft-power mr-2"></i><span>Logout</span>
                                </div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        </div>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="app-sidebar menu-fixed" data-background-color="man-of-steel"
    data-image="../../../app-assets/img/sidebar-bg/01.jpg" data-scroll-to-active="true">
    <!-- main menu header-->
    <!-- Sidebar Header starts-->
    <div class="sidebar-header">
        <div class="logo clearfix"><a class="logo-text float-left" href="{{route('gallary.index')}}">
                {{-- <div class="logo-img"><img src="{{asset('app-assets/img/logo-finstream.svg')}}" alt="Finstream" /></div> --}}
                <span class="text">Visioniscool</span>
            </a>
        </div>
    </div>
    <!-- Sidebar Header Ends-->
    <!-- / main menu header-->
    <!-- main menu content-->
    <div class="sidebar-content main-menu-content">
        <div class="nav-container">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a href="{{url('/')}}" target="_balnk"><i class="ft-home"></i><span class="dashboarl-title"
                            data-i18n="Dashboard">Visit Website</span></a>
                </li>
                <li class="has-sub nav-item"><a href="#"><i class="ft-list"></i><span class="menu-title" data-i18n="Forms">Gallery</span></a>
                    <ul class="menu-content">
                        <li><a href="{{route('gallary.index')}}"><i class="ft-arrow-right submenu-icon"></i><span class="menu-item"
                                    data-i18n="Gallary list">Gallery </span></a>
                        </li>
                        <li><a href="{{route('gallary.create')}}"><i class="ft-arrow-right submenu-icon"></i><span class="menu-item"
                                    data-i18n="Add Image">Add Image</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- main menu content-->
    <div class="sidebar-background"></div>
    <!-- main menu footer-->
    <!-- include includes/menu-footer-->
    <!-- main menu footer-->
    <!-- / main menu-->
</div>
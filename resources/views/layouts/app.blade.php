<!DOCTYPE html>
<html lang="zxx" class="js">

<head id="not-print">
    <base href="{{url('/')}}">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@@page-discription">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{url('images/favicon.png')}}">
    <!-- Page Title  -->
    <title>Larisso Admin</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{url('/assets/css/dashlite.css?ver=1.4.0')}}">
    <link id="skin-default" rel="stylesheet" href="{{url('assets/css/theme.css?ver=1.4.0')}}">

</head>

<body class="nk-body bg-lighter npc-general has-sidebar">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">

            @include('layouts.sidebar')

            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ml-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="html/crypto/index.html" class="logo-link">
                                    <img class="logo-light logo-img" src="{{url('images/LarissoApps.png')}}" alt="logo">
                                </a>
                            </div><!-- .nk-header-brand -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-md-block">
                                                    <div class="user-status">Administrator</div>
                                                    <div class="user-name dropdown-indicator">{{Auth::user()->name}}</div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span>AB</span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text">{{Auth::user()->name}}</span>
                                                        <span class="sub-text">{{Auth::user()->email}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a onclick="event.preventDefault(); document.getElementById('form1').submit();"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                                    <form id="form1" action="{{ route('logout') }}" method="post">
                                                        @csrf
                                                    </form>
                                                </ul>
                                            </div>
                                        </div>
                                    </li><!-- .dropdown -->
                                </ul><!-- .nk-quick-nav -->
                            </div><!-- .nk-header-tools -->
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>

                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nk-footer" id="not-print">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright"> 2020 Asa Mutiara Informa
                            </div>
                            <div class="nk-footer-links">
                                <ul class="nav nav-sm">
                                    <li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer @e -->
            </div>

        </div>
    </div>
    <!-- wrap @e -->
</div>
<!-- main @e -->
</div>

<!-- app-root @e -->
<!-- JavaScript -->
<script src="{{url('assets/js/bundle.js?ver=1.4.0')}}"></script>
<script src="{{url('assets/js/scripts.js?ver=1.4.0')}}"></script>
<script src="{{url('assets/js/charts/gd-general.js?ver=1.4.0')}}"></script>

<script>
    function setKategori($a, $b) {
        $('#kd_kategori_edit').val($a);
        $('#nm_kategori_edit').val($b);
    }
</script>
@yield('script')
</body>

</html>
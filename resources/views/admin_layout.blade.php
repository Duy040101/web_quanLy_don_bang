<!DOCTYPE html>

<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smar tphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('backend/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('backend/css/style-responsive.css')}}" rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('backend/css/font.css')}}" type="text/css" />
    <link href="{{asset('backend/css/font-awesome.css')}}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{asset('backend/css/morris.css')}}" type="text/css" /> --}}
    <!-- calendar -->
    <link rel="stylesheet" href="{{asset('backend/css/monthly.css')}}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{asset('backend/js/jquery2.0.3.min.js')}}"></script>
    <script src="{{asset('backend/js/raphael-min.js')}}"></script>
     <script src="{{asset('backend/js/morris.js')}}"></script> 
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    


        <script>

                $(document).ready(function() {

                    $("#states").select2({

                            placeholder: "Select a State",

                            /* allowClear: true */

                    });
                    $(document).ready(function() {
                    $('.basic-select').select2();
                    });

                });

        </script>

    
</head>

<body>
@include('sweetalert::alert')

    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="{{route('admin.index')}}" class="logo">
                    
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->

            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <form action="" method="get">
                            <input type="text" name="search" value="{{  $_GET['search'] ?? ''  }}" class="form-control search" placeholder=" Search">
                        </form>
                    </li>
                    <li>
                    <!-- user login dropdown start-->
                        <button class="form-control login"></button>
                        </li>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a  href="{{ route('admin.index') }}" class="{{ Route::currentRouteName() == 'admin.index' ? 'active' : '' }}">
                                <i class="fa fa-dashboard"></i>
                                <span>Tổng quan</span>
                            </a>
                        </li>
                        <!-- Liệt kê -->
                        
                        
                        <!-- Thêm Đơn -->
                        <li class="sub-menu">
                            <a href="javascript:;" class="{{ in_array(Route::currentRouteName(), ['admin.new_category', 'admin.new_don_KD','admin.new_don_GPHI']) ? 'active' : '' }}">
                                
                                <span>Thêm Đơn</span>
                            </a>
                            <ul class="sub" style="{{ in_array(Route::currentRouteName(), ['admin.new_category', 'admin.new_don_KD','admin.new_don_gphi']) ? 'display: block;' : 'display: none;' }}">
                                <li class="{{ Route::currentRouteName() == 'admin.new_category' ? 'active' : '' }}">
                                    <a href="{{ route('admin.new_category') }}">Nhãn hiệu (NH/NHTT/NHCN)</a></li>
                                
                                <li class="{{ Route::currentRouteName() == 'admin.new_don_KD' ? 'active' : '' }}">
                                    <a href="{{ route('admin.new_don_KD') }}">Kiểu dáng/Kiểu dáng công nghiệp (KD/KDCN)</a>
                                </li>
                                <li class="{{ Route::currentRouteName() == 'admin.new_don_GPHI' ? 'active' : '' }}">
                                    <a href="{{ route('admin.new_don_GPHI') }}">Sáng chế/Giải pháp hữu ích (SC/GPHI)</a>
                                </li>
                                
                            </ul>
                        </li>
                        <!-- Thêm Bằng -->
                        <li class="sub-menu">
                            <a href="{{ route('admin.add_brand' )}}">Thêm bằng</a>
                            <!-- <a href="javascript:;" class="{{ in_array(Route::currentRouteName(), ['', 'admin.add_brand']) ? 'active' : '' }}">
                                
                                <span>Thêm Bằng</span>
                            </a>
                            <ul class="sub">
                                <li class="{{ Route::currentRouteName() == 'admin.add_brand' ? 'active': '' }}">
                                    <a href="{{ route('admin.add_brand' )}}">Nhãn hiệu (NH)</a>
                                </li>
                                <li class="{{ Route::currentRouteName() == 'admin.all_brand' ? 'active' : ''}}">
                                    <a href="{{route('admin.all_brand')}}">Nhãn hiệu tập thể (NHTT)</a>
                                </li>
                                <li class="{{ Route::currentRouteName() == 'admin.all_brand' ? 'active' : ''}}">
                                    <a href="{{route('admin.all_brand')}}">Kiểu dáng công nghiệp (KDCN)</a>
                                </li>
                                <li class="{{ Route::currentRouteName() == 'admin.all_brand' ? 'active' : ''}}">
                                    <a href="{{route('admin.all_brand')}}">Sáng chế/Giải pháp hữu ich (SC/GPHI)</a>
                                </li>
                                
                            </ul> -->
                        </li>

                       
                        <!-- thống kê -->
                        <li class="sub-menu">
                            <a href="javascript:;" class="{{ in_array(Route::currentRouteName(), ['admin.all_brand', 'admin.all_category']) ? 'active' : '' }}">
                                
                                <span>Thống kê</span>
                            </a>
                            <ul class="sub" style="{{ in_array(Route::currentRouteName(), ['admin.all_brand', 'admin.all_category']) ? 'display: block;' : 'display: none;' }}">
                                
                                <li class="{{ Route::currentRouteName()=='admin.all_category' ? 'active' : '' }}">
                                    <a href="{{ route('admin.all_category') }}">Tất cả Đơn</a>
                                </li>
                                <li class="{{ Route::currentRouteName()=='admin.all_brand' ? 'active' : '' }}">
                                    <a href="{{ route('admin.all_brand') }}">Tất cả Bằng</a>
                                </li>
                                
                            </ul>
                        </li>
                        
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper" style="color:black;">
				@yield('admin_content')
                
            </section>
            <!-- footer -->
           
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>
    <script src="{{asset('backend/js/bootstrap.js')}}"></script>
    <script src="{{asset('backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('backend/js/scripts.js')}}"></script>
    <script src="{{asset('backend/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('backend/js/jquery.nicescroll.js')}}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{asset('backend/js/jquery.scrollTo.js')}}"></script>
    <!-- morris JavaScript -->
    <script>
    $(document).ready(function() {
        //BOX BUTTON SHOW AND CLOSE
        jQuery('.small-graph-box').hover(function() {
            jQuery(this).find('.box-button').fadeIn('fast');
        }, function() {
            jQuery(this).find('.box-button').fadeOut('fast');
        });
        jQuery('.small-graph-box .box-close').click(function() {
            jQuery(this).closest('.small-graph-box').fadeOut(200);
            return false;
        });

        //CHARTS
        function gd(year, day, month) {
            return new Date(year, month - 1, day).getTime();
        }
    });
    </script>
    <!-- calendar -->
    <script type="text/javascript" src="{{asset('backend/js/monthly.js')}}"></script>
    <script type="text/javascript">
    $(window).load(function() {

        $('#mycalendar').monthly({
            mode: 'event',

        });

        $('#mycalendar2').monthly({
            mode: 'picker',
            target: '#mytarget',
            setWidth: '250px',
            startHidden: true,
            showTrigger: '#mytarget',
            stylePast: true,
            disablePast: true
        });

        switch (window.location.protocol) {
            case 'http:':
            case 'https:':
                // running on a server, should be good.
                break;
            case 'file:':
                alert('Just a heads-up, events will not work when run locally.');
        }

    });
    </script>
    <!-- //calendar -->

    
</body>

</html>
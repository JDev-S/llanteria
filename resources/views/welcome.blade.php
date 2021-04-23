<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">
    <meta name="csrf_token" content="{{ csrf_token() }}" />

    <title>Llantimax</title>

    <link rel="apple-touch-icon" href="\assets\images\apple-touch-icon.png">
    <link rel="shortcut icon" href="\assets\images\favicon.ico">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="\global\css\bootstrap.min.css?v4.0.1">
    <link rel="stylesheet" href="\global\css\bootstrap-extend.min.css?v4.0.1">
    <link rel="stylesheet" href="\assets\css\site.min.css?v4.0.1">

    <!-- Skin tools (demo site only) -->
    <link rel="stylesheet" href="\global\css\skintools.min.css?v4.0.1">
    <script src="\assets\js\Plugin\skintools.min.js?v4.0.1"></script>

    <!-- Plugins -->
    <link rel="stylesheet" href="\global\vendor\animsition\animsition.min.css?v4.0.1">
    <link rel="stylesheet" href="\global\vendor\asscrollable\asScrollable.min.css?v4.0.1">
    <link rel="stylesheet" href="\global\vendor\switchery\switchery.min.css?v4.0.1">
    <link rel="stylesheet" href="\global\vendor\intro-js\introjs.min.css?v4.0.1">
    <link rel="stylesheet" href="\global\vendor\slidepanel\slidePanel.min.css?v4.0.1">
    <link rel="stylesheet" href="\global\vendor\flag-icon-css\flag-icon.min.css?v4.0.1">
    <link rel="stylesheet" href="\global\vendor\waves\waves.min.css?v4.0.1">

    <!-- Plugins For This Page -->
    <link rel="stylesheet" href="\global\vendor\chartist\chartist.min.css?v4.0.1">
    <link rel="stylesheet" href="\global\vendor\jvectormap\jquery-jvectormap.min.css?v4.0.1">
    <link rel="stylesheet" href="\global\vendor\chartist-plugin-tooltip\chartist-plugin-tooltip.min.css?v4.0.1">

    <!-- Page -->
    <link rel="stylesheet" href="\assets\examples\css\dashboard\v1.min.css?v4.0.1">

    <!-- Fonts -->
    <link rel="stylesheet" href="\global\fonts\material-design\material-design.min.css?v4.0.1">
    <link rel="stylesheet" href="\global\fonts\brand-icons\brand-icons.min.css?v4.0.1">
    <link rel='stylesheet' href="css.css?family=Roboto:400,400italic,700">

     @yield('styles')
    <!--[if lt IE 9]>
    <script src="../global/vendor/html5shiv/html5shiv.min.js?v4.0.1"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="../global/vendor/media-match/media.match.min.js?v4.0.1"></script>
    <script src="../global/vendor/respond/respond.min.js?v4.0.1"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="\global\vendor\breakpoints\breakpoints.min.js?v4.0.1"></script>
    <script>
        Breakpoints();

    </script>
</head>

<body class="animsition dashboard">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">

        <div class="navbar-header">
            <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided" data-toggle="menubar">
                <span class="sr-only">Toggle navigation</span>
                <span class="hamburger-bar"></span>
            </button>
            <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse" data-toggle="collapse">
                <i class="icon md-more" aria-hidden="true"></i>
            </button>
            <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
                <img class="navbar-brand-logo" src="assets\images\logo.png" title="Llantimax">
                <span class="navbar-brand-text hidden-xs-down"> Llantimax</span>
            </div>
            <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search" data-toggle="collapse">
                <span class="sr-only">Toggle Search</span>
                <i class="icon md-search" aria-hidden="true"></i>
            </button>
        </div>

        <div class="navbar-container container-fluid">
            <!-- Navbar Collapse -->
            <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
                <!-- Navbar Toolbar -->
                <ul class="nav navbar-toolbar">
                    <li class="nav-item hidden-float" id="toggleMenubar">
                        <a class="nav-link" data-toggle="menubar" href="#" role="button">
                            <i class="icon hamburger hamburger-arrow-left">
                                <span class="sr-only">Toggle menubar</span>
                                <span class="hamburger-bar"></span>
                            </i>
                        </a>
                    </li>
                    <!--<li class="nav-item hidden-sm-down" id="toggleFullscreen">
                        <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                            <span class="sr-only">Toggle fullscreen</span>
                        </a>
                    </li>-->
                    <li class="nav-item hidden-float">
                        <a class="nav-link icon md-search" data-toggle="collapse" href="#" data-target="#site-navbar-search" role="button">
                            <span class="sr-only">Toggle Search</span>
                        </a>
                    </li>

                </ul>
                <!-- End Navbar Toolbar -->

                <!-- Navbar Toolbar Right -->
                <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                    <!--<li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" data-animation="scale-up" aria-expanded="false" role="button">
                            <span class="flag-icon flag-icon-us"></span>
                        </a>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                                <span class="flag-icon flag-icon-gb"></span> English</a>
                            <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                                <span class="flag-icon flag-icon-fr"></span> French</a>
                            <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                                <span class="flag-icon flag-icon-cn"></span> Chinese</a>
                            <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                                <span class="flag-icon flag-icon-de"></span> German</a>
                            <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                                <span class="flag-icon flag-icon-nl"></span> Dutch</a>
                        </div>
                    </li>-->
                    <li class="nav-item dropdown">
                        <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="scale-up" role="button">
                            <span class="avatar avatar-online">
                                <img src="..\global\portraits\5.jpg" alt="...">
                                <i></i>
                            </span>
                        </a>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-account" aria-hidden="true"></i> Perfil</a>
                            <!--<a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-card" aria-hidden="true"></i> Billing</a>
                            <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-settings" aria-hidden="true"></i> Settings</a>
                            <div class="dropdown-divider"></div>-->
                            <a class="dropdown-item" href="/cerrar_sesion" role="menuitem"><i class="icon md-power" aria-hidden="true"></i> Cerrar sesión</a>
                        </div>
                    </li>

                </ul>
                <!-- End Navbar Toolbar Right -->
            </div>
            <!-- End Navbar Collapse -->

            <!-- Site Navbar Seach -->
            <div class="collapse navbar-search-overlap" id="site-navbar-search">
                <form role="search">
                    <div class="form-group">
                        <div class="input-search">
                            <i class="input-search-icon md-search" aria-hidden="true"></i>
                            <input type="text" class="form-control" name="site-search" placeholder="Search...">
                            <button type="button" class="input-search-close icon md-close" data-target="#site-navbar-search" data-toggle="collapse" aria-label="Close"></button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- End Site Navbar Seach -->
        </div>
    </nav>
    <div class="site-menubar site-menubar-light">
        <div class="site-menubar-body">
            <div>
                <div>
                    <ul class="site-menu" data-plugin="menu">
                        <li class="site-menu-category">General</li>
                        <li class="site-menu-item active">
                            <a href="/principal">
                                <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                                <span class="site-menu-title">Inicio</span>
                            </a>
                        </li>
                        <!--  -->
                        <li class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <i class="site-menu-icon md-palette" aria-hidden="true"></i>
                                <span class="site-menu-title">Clientes</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">

                                <li class="site-menu-item">
                                    <a href="/mostrar_clientes">
                                        <span class="site-menu-title">Observar Clientes</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="/agregar_cliente">
                                        <span class="site-menu-title">Agregar Clientes</span>
                                    </a>
                                </li>
                                <!--<li class="site-menu-item">
                                    <a href="uikit\dropdowns.html">
                                        <span class="site-menu-title">Dropdowns</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\icons.html">
                                        <span class="site-menu-title">Icons</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\list.html">
                                        <span class="site-menu-title">List</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\tooltip-popover.html">
                                        <span class="site-menu-title">Tooltip &amp; Popover</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\modals.html">
                                        <span class="site-menu-title">Modals</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\tabs-accordions.html">
                                        <span class="site-menu-title">Tabs &amp; Accordions</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\images.html">
                                        <span class="site-menu-title">Images</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\badges.html">
                                        <span class="site-menu-title">Badges</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\progress-bars.html">
                                        <span class="site-menu-title">Progress Bars</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\carousel.html">
                                        <span class="site-menu-title">Carousel</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\typography.html">
                                        <span class="site-menu-title">Typography</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\colors.html">
                                        <span class="site-menu-title">Colors</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\utilities.html">
                                        <span class="site-menu-title">Utilties</span>
                                    </a>
                                </li>-->
                            </ul>
                        </li>
                        <!-- -->
                                                <li class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <i class="site-menu-icon md-palette" aria-hidden="true"></i>
                                <span class="site-menu-title">Pedidos</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">

                                <li class="site-menu-item">
                                    <a href="/mostrar_clientes">
                                        <span class="site-menu-title">Observar pedidos</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="/agregar_cliente">
                                        <span class="site-menu-title">Hacer pedido</span>
                                    </a>
                                </li>
                                <!--<li class="site-menu-item">
                                    <a href="uikit\dropdowns.html">
                                        <span class="site-menu-title">Dropdowns</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\icons.html">
                                        <span class="site-menu-title">Icons</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\list.html">
                                        <span class="site-menu-title">List</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\tooltip-popover.html">
                                        <span class="site-menu-title">Tooltip &amp; Popover</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\modals.html">
                                        <span class="site-menu-title">Modals</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\tabs-accordions.html">
                                        <span class="site-menu-title">Tabs &amp; Accordions</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\images.html">
                                        <span class="site-menu-title">Images</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\badges.html">
                                        <span class="site-menu-title">Badges</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\progress-bars.html">
                                        <span class="site-menu-title">Progress Bars</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\carousel.html">
                                        <span class="site-menu-title">Carousel</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\typography.html">
                                        <span class="site-menu-title">Typography</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\colors.html">
                                        <span class="site-menu-title">Colors</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\utilities.html">
                                        <span class="site-menu-title">Utilties</span>
                                    </a>
                                </li>-->
                            </ul>
                        </li>
                        <!-- -->
                        <!--  -->


                        <li class="site-menu-category">Inventario</li>
                        <li class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <i class="site-menu-icon md-palette" aria-hidden="true"></i>
                                <span class="site-menu-title">Inventario</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">

                                <li class="site-menu-item">
                                    <a href="/mostrar_inventario">
                                        <span class="site-menu-title">Observar Inventario</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="/agregar_inventario">
                                        <span class="site-menu-title">Agregar producto a Inventario</span>
                                    </a>
                                </li>
                                <!--<li class="site-menu-item">
                                    <a href="uikit\dropdowns.html">
                                        <span class="site-menu-title">Dropdowns</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\icons.html">
                                        <span class="site-menu-title">Icons</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\list.html">
                                        <span class="site-menu-title">List</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\tooltip-popover.html">
                                        <span class="site-menu-title">Tooltip &amp; Popover</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\modals.html">
                                        <span class="site-menu-title">Modals</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\tabs-accordions.html">
                                        <span class="site-menu-title">Tabs &amp; Accordions</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\images.html">
                                        <span class="site-menu-title">Images</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\badges.html">
                                        <span class="site-menu-title">Badges</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\progress-bars.html">
                                        <span class="site-menu-title">Progress Bars</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\carousel.html">
                                        <span class="site-menu-title">Carousel</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\typography.html">
                                        <span class="site-menu-title">Typography</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\colors.html">
                                        <span class="site-menu-title">Colors</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="uikit\utilities.html">
                                        <span class="site-menu-title">Utilties</span>
                                    </a>
                                </li>-->
                            </ul>
                        </li>
                        <li class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <i class="site-menu-icon md-format-color-fill" aria-hidden="true"></i>
                                <span class="site-menu-title">Servicios</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">

                                <li class="site-menu-item">
                                    <a href="/mostrar_servicios">
                                        <span class="site-menu-title">Observar los servicios</span>
                                    </a>
                                </li>

                                <li class="site-menu-item">
                                    <a href="/agregar_servicio">
                                        <span class="site-menu-title">Agregar un servicio</span>
                                    </a>
                                </li>

                                <!--<li class="site-menu-item">
                                    <a href="advanced\lightbox.html">
                                        <span class="site-menu-title">Lightbox</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="advanced\scrollable.html">
                                        <span class="site-menu-title">Scrollable</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="advanced\rating.html">
                                        <span class="site-menu-title">Rating</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="advanced\context-menu.html">
                                        <span class="site-menu-title">Context Menu</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="advanced\alertify.html">
                                        <span class="site-menu-title">Alertify</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="advanced\masonry.html">
                                        <span class="site-menu-title">Masonry</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="advanced\treeview.html">
                                        <span class="site-menu-title">Treeview</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="advanced\toastr.html">
                                        <span class="site-menu-title">Toastr</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="advanced\maps-vector.html">
                                        <span class="site-menu-title">Vector Maps</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="advanced\maps-google.html">
                                        <span class="site-menu-title">Google Maps</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="advanced\sortable-nestable.html">
                                        <span class="site-menu-title">Sortable &amp; Nestable</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="advanced\bootbox-sweetalert.html">
                                        <span class="site-menu-title">Bootbox &amp; Sweetalert</span>
                                    </a>
                                </li>-->
                            </ul>
                        </li>
                        <li class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <i class="site-menu-icon md-puzzle-piece" aria-hidden="true"></i>
                                <span class="site-menu-title">Refacciones</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">
                                <li class="site-menu-item">
                                    <a href="/mostrar_refacciones">
                                        <span class="site-menu-title">Mostrar refacciones</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="/agregar_refaccion">
                                        <span class="site-menu-title">Agregar refacciones</span>
                                    </a>
                                </li>
                                <!--<li class="site-menu-item">
                                    <a href="structure\pricing-tables.html">
                                        <span class="site-menu-title">Pricing Tables</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="structure\overlay.html">
                                        <span class="site-menu-title">Overlay</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="structure\cover.html">
                                        <span class="site-menu-title">Cover</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="structure\timeline-simple.html">
                                        <span class="site-menu-title">Simple Timeline</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="structure\timeline.html">
                                        <span class="site-menu-title">Timeline</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="structure\step.html">
                                        <span class="site-menu-title">Step</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="structure\comments.html">
                                        <span class="site-menu-title">Comments</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="structure\media.html">
                                        <span class="site-menu-title">Media</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="structure\chat.html">
                                        <span class="site-menu-title">Chat</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="structure\testimonials.html">
                                        <span class="site-menu-title">Testimonials</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="structure\nav.html">
                                        <span class="site-menu-title">Nav</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="structure\navbars.html">
                                        <span class="site-menu-title">Navbars</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="structure\blockquotes.html">
                                        <span class="site-menu-title">Blockquotes</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="structure\pagination.html">
                                        <span class="site-menu-title">Pagination</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="structure\breadcrumbs.html">
                                        <span class="site-menu-title">Breadcrumbs</span>
                                    </a>
                                </li>-->
                            </ul>
                        </li>
                        <li class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <i class="site-menu-icon md-widgets" aria-hidden="true"></i>
                                <span class="site-menu-title">Llantas</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">
                                <li class="site-menu-item">
                                    <a href="/mostrar_llantas">
                                        <span class="site-menu-title">Observar llantas</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="/agregar_llanta">
                                        <span class="site-menu-title">Agregar llantas</span>
                                    </a>
                                </li>
                                <!--<li class="site-menu-item">
                                    <a href="widgets\blog.html">
                                        <span class="site-menu-title">Blog Widgets</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="widgets\chart.html">
                                        <span class="site-menu-title">Chart Widgets</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="widgets\social.html">
                                        <span class="site-menu-title">Social Widgets</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="widgets\weather.html">
                                        <span class="site-menu-title">Weather Widgets</span>
                                    </a>
                                </li>-->
                            </ul>
                        </li>
                        <li class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <i class="site-menu-icon md-comment-alt-text" aria-hidden="true"></i>
                                <span class="site-menu-title">Baterias</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">
                                <li class="site-menu-item">
                                    <a href="/mostrar_baterias">
                                        <span class="site-menu-title">Mostrar baterias</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="/agregar_bateria">
                                        <span class="site-menu-title">Agregar baterias</span>
                                    </a>
                                </li>
                                <!--<li class="site-menu-item">
                                    <a href="forms\advanced.html">
                                        <span class="site-menu-title">Advanced Elements</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="forms\layouts.html">
                                        <span class="site-menu-title">Form Layouts</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="forms\wizard.html">
                                        <span class="site-menu-title">Form Wizard</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="forms\validation.html">
                                        <span class="site-menu-title">Form Validation</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="forms\masks.html">
                                        <span class="site-menu-title">Form Masks</span>
                                    </a>
                                </li>
                                <li class="site-menu-item has-sub">
                                    <a href="javascript:void(0)">
                                        <span class="site-menu-title">Editors</span>
                                        <span class="site-menu-arrow"></span>
                                    </a>
                                    <ul class="site-menu-sub">
                                        <li class="site-menu-item">
                                            <a href="forms\editor-summernote.html">
                                                <span class="site-menu-title">Summernote</span>
                                            </a>
                                        </li>
                                        <li class="site-menu-item">
                                            <a href="forms\editor-markdown.html">
                                                <span class="site-menu-title">Markdown</span>
                                            </a>
                                        </li>
                                        <li class="site-menu-item">
                                            <a href="forms\editor-ace.html">
                                                <span class="site-menu-title">Ace Editor</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="site-menu-item">
                                    <a href="forms\image-cropping.html">
                                        <span class="site-menu-title">Image Cropping</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="forms\file-uploads.html">
                                        <span class="site-menu-title">File Uploads</span>
                                    </a>
                                </li>-->
                            </ul>
                        </li>
                        <!--<li class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <i class="site-menu-icon md-border-all" aria-hidden="true"></i>
                                <span class="site-menu-title">Tables</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">
                                <li class="site-menu-item">
                                    <a href="tables\basic.html">
                                        <span class="site-menu-title">Basic Tables</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="tables\bootstrap.html">
                                        <span class="site-menu-title">Bootstrap Tables</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="tables\floatthead.html">
                                        <span class="site-menu-title">floatThead</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="tables\responsive.html">
                                        <span class="site-menu-title">Responsive Tables</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="tables\editable.html">
                                        <span class="site-menu-title">Editable Tables</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="tables\jsgrid.html">
                                        <span class="site-menu-title">jsGrid</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="tables\footable.html">
                                        <span class="site-menu-title">FooTable</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="tables\datatable.html">
                                        <span class="site-menu-title">DataTables</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="tables\jqtabledit.html">
                                        <span class="site-menu-title">Jquery Tabledit</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="tables\table-dragger.html">
                                        <span class="site-menu-title">Table Dragger</span>
                                    </a>
                                </li>
                            </ul>
                        </li>-->
                       <!-- <li class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <i class="site-menu-icon md-chart" aria-hidden="true"></i>
                                <span class="site-menu-title">Chart</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">
                                <li class="site-menu-item">
                                    <a href="charts\chartjs.html">
                                        <span class="site-menu-title">Chart.js</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="charts\gauges.html">
                                        <span class="site-menu-title">Gauges</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="charts\flot.html">
                                        <span class="site-menu-title">Flot</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="charts\peity.html">
                                        <span class="site-menu-title">Peity</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="charts\sparkline.html">
                                        <span class="site-menu-title">Sparkline</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="charts\morris.html">
                                        <span class="site-menu-title">Morris</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="charts\chartist.html">
                                        <span class="site-menu-title">Chartist.js</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="charts\rickshaw.html">
                                        <span class="site-menu-title">Rickshaw</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="charts\pie-progress.html">
                                        <span class="site-menu-title">Pie Progress</span>
                                    </a>
                                </li>
                                <li class="site-menu-item">
                                    <a href="charts\c3.html">
                                        <span class="site-menu-title">C3</span>
                                    </a>
                                </li>
                            </ul>
                        </li>-->

                        <!-- -->
                    <li class="site-menu-category">Ventas</li>
                        <li class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <i class="site-menu-icon md-palette" aria-hidden="true"></i>
                                <span class="site-menu-title">Venta</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">
                                
                                <li class="site-menu-item">
                                    <a href="/mostrar_venta">
                                        <span class="site-menu-title">Mostrar ventas</span>
                                    </a>
                                </li>
                                
                                <li class="site-menu-item">
                                    <a href="/agregar_venta">
                                        <span class="site-menu-title">Generar venta</span>
                                    </a>
                                </li>







                            </ul>
                        </li>






                        <!-- -->
                    </ul>
                </div>
            </div>
        </div>


    </div>
    <div class="site-gridmenu">
        <div>
            <div>
                <ul>
                    <li>
                        <a href="apps\mailbox\mailbox.html">
                            <i class="icon md-email"></i>
                            <span>Mailbox</span>
                        </a>
                    </li>
                    <li>
                        <a href="apps\calendar\calendar.html">
                            <i class="icon md-calendar"></i>
                            <span>Calendar</span>
                        </a>
                    </li>
                    <li>
                        <a href="apps\contacts\contacts.html">
                            <i class="icon md-account"></i>
                            <span>Contacts</span>
                        </a>
                    </li>
                    <li>
                        <a href="apps\media\overview.html">
                            <i class="icon md-videocam"></i>
                            <span>Media</span>
                        </a>
                    </li>
                    <li>
                        <a href="apps\documents\categories.html">
                            <i class="icon md-receipt"></i>
                            <span>Documents</span>
                        </a>
                    </li>
                    <li>
                        <a href="apps\projects\projects.html">
                            <i class="icon md-image"></i>
                            <span>Project</span>
                        </a>
                    </li>
                    <li>
                        <a href="apps\forum\forum.html">
                            <i class="icon md-comments"></i>
                            <span>Forum</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.html">
                            <i class="icon md-view-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>



    @yield('contenido')

    <!-- Footer -->
    <footer class="site-footer">
        <div class="site-footer-legal">© <?php $hoy = getdate();   
                            echo $hoy['year'];
                    ?> Llantimax</div>
        <div class="site-footer-right">
            Desarrollada por <a href="https://jdevs.com.mx/">JDev-S</a>
        </div>
    </footer>
    <!-- Core  -->
    <script data-cfasync="false" src="\cdn-cgi\scripts\5c5dd728\cloudflare-static\email-decode.min.js"></script>
    <script src="\global\vendor\babel-external-helpers\babel-external-helpers.js?v4.0.1"></script>
    <script src="\global\vendor\jquery\jquery.min.js?v4.0.1"></script>
    <script src="\global\vendor\popper-js\umd\popper.min.js?v4.0.1"></script>
    <script src="\global\vendor\bootstrap\bootstrap.min.js?v4.0.1"></script>
    <script src="\global\vendor\animsition\animsition.min.js?v4.0.1"></script>
    <script src="\global\vendor\mousewheel\jquery.mousewheel.min.js?v4.0.1"></script>
    <script src="\global\vendor\asscrollbar\jquery-asScrollbar.min.js?v4.0.1"></script>
    <script src="\global\vendor\asscrollable\jquery-asScrollable.min.js?v4.0.1"></script>
    <script src="\global\vendor\ashoverscroll\jquery-asHoverScroll.min.js?v4.0.1"></script>
    <script src="\global\vendor\waves\waves.min.js?v4.0.1"></script>

    <!-- Plugins -->
    <script src="\global\vendor\switchery\switchery.min.js?v4.0.1"></script>
    <script src="\global\vendor\intro-js\intro.min.js?v4.0.1"></script>
    <script src="\global\vendor\screenfull\screenfull.min.js?v4.0.1"></script>
    <script src="\global\vendor\slidepanel\jquery-slidePanel.min.js?v4.0.1"></script>

    <!-- Plugins For This Page -->
    <script src="\global\vendor\chartist\chartist.min.js?v4.0.1"></script>
    <script src="\global\vendor\chartist-plugin-tooltip\chartist-plugin-tooltip.min.js?v4.0.1"></script>
    <script src="\global\vendor\jvectormap\jquery-jvectormap.min.js?v4.0.1"></script>
    <script src="\global\vendor\jvectormap\maps\jquery-jvectormap-world-mill-en.js?v4.0.1"></script>
    <script src="\global\vendor\matchheight\jquery.matchHeight-min.js?v4.0.1"></script>
    <script src="\global\vendor\peity\jquery.peity.min.js?v4.0.1"></script>

    <!-- Scripts -->
    <script src="\global\js\State.min.js?v4.0.1"></script>
    <script src="\global\js\Component.min.js?v4.0.1"></script>
    <script src="\global\js\Plugin.min.js?v4.0.1"></script>
    <script src="\global\js\Base.min.js?v4.0.1"></script>
    <script src="\global\js\Config.min.js?v4.0.1"></script>

    <script src="\assets\js\Section\Menubar.min.js?v4.0.1"></script>
    <script src="\assets\js\Section\GridMenu.min.js?v4.0.1"></script>
    <script src="\assets\js\Section\Sidebar.min.js?v4.0.1"></script>
    <script src="\assets\js\Section\PageAside.min.js?v4.0.1"></script>
    <script src="\assets\js\Plugin\menu.min.js?v4.0.1"></script>

    <!-- Config -->
    <script src="\global\js\config\colors.min.js?v4.0.1"></script>
    <script src="\assets\js\config\tour.min.js?v4.0.1"></script>
    <script>
        Config.set('assets', 'assets');

    </script>

    <!-- Page -->

    <script src="\assets\js\Site.min.js?v4.0.1"></script>
    <script src="\global\js\Plugin\asscrollable.min.js?v4.0.1"></script>

    <script src="\global\js\Plugin\slidepanel.min.js?v4.0.1"></script>
    <script src="\global\js\Plugin\switchery.min.js?v4.0.1"></script>

    <script src="\global\js\Plugin\matchheight.min.js?v4.0.1"></script>
    <script src="\global\js\Plugin\jvectormap.min.js?v4.0.1"></script>
    <script src="\global\js\Plugin\peity.min.js?v4.0.1"></script>


    <script src="\assets\examples\js\dashboard\v1.min.js?v4.0.1"></script>

    @yield('scripts')
    <!-- Google Analytics -->
    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js',
            'ga');

        ga('create', 'UA-65522665-1', 'auto');
        ga('send', 'pageview');

    </script>

</body>

</html>

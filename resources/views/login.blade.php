<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">

    <title>Iniciar sesión en Llantimax</title>

    <link rel="apple-touch-icon" href="\assets\images\apple-touch-icon.png">
    <link rel="shortcut icon" href="\assets\images\favicon.ico">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="\global\css\bootstrap.min.css?v4.0.1">
    <link rel="stylesheet" href="\global\css\bootstrap-extend.min.css?v4.0.1">
    <link rel="stylesheet" href="\assets\css\site.min.css?v4.0.1">

    <!-- Skin tools (demo site only) -->
    <!--<link rel="stylesheet" href="\global\css\skintools.min.css?v4.0.1">
  <script src="\assets\js\Plugin\skintools.min.js?v4.0.1"></script>-->

    <!-- Plugins -->
    <link rel="stylesheet" href="\global\vendor\animsition\animsition.min.css?v4.0.1">
    <link rel="stylesheet" href="\global\vendor\asscrollable\asScrollable.min.css?v4.0.1">
    <link rel="stylesheet" href="\global\vendor\switchery\switchery.min.css?v4.0.1">
    <link rel="stylesheet" href="\global\vendor\intro-js\introjs.min.css?v4.0.1">
    <link rel="stylesheet" href="\global\vendor\slidepanel\slidePanel.min.css?v4.0.1">
    <link rel="stylesheet" href="\global\vendor\flag-icon-css\flag-icon.min.css?v4.0.1">
    <link rel="stylesheet" href="\global\vendor\waves\waves.min.css?v4.0.1">

    <!-- Page -->
    <link rel="stylesheet" href="\assets\examples\css\pages\login-v2.min.css?v4.0.1">

    <!-- Fonts -->
    <link rel="stylesheet" href="\global\fonts\material-design\material-design.min.css?v4.0.1">
    <link rel="stylesheet" href="\global\fonts\brand-icons\brand-icons.min.css?v4.0.1">
    <link rel='stylesheet' href="\css.css?family=Roboto:400,400italic,700">


    <!--[if lt IE 9]>
    <script src="../../global/vendor/html5shiv/html5shiv.min.js?v4.0.1"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="../../global/vendor/media-match/media.match.min.js?v4.0.1"></script>
    <script src="../../global/vendor/respond/respond.min.js?v4.0.1"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="\global\vendor\breakpoints\breakpoints.min.js?v4.0.1"></script>
    <script>
        Breakpoints();

    </script>
</head>

<body class="animsition page-login-v2 layout-full page-dark">
    <?php
           header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT'); 
           header('Cache-Control: no-store, no-cache, must-revalidate');
           header('Cache-Control: post-check=0, pre-check=0', false);
           header('Pragma: no-cache'); 
    ?>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


    <!-- Page -->
    <div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <div class="page-content">
            <div class="page-brand-info">
                <div class="brand">
                    <img class="brand-img" src="..\assets\images\logo@2x.png" alt="...">
                    <h2 class="brand-text font-size-40">Llantimax</h2>
                </div>
                <!--<p class="font-size-20">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua.</p>-->
            </div>

            <div class="page-login-main">
                <div class="brand hidden-md-up">
                    <img class="brand-img" src="..\assets\images\logo-colored@2x.png" alt="...">
                    <h3 class="brand-text font-size-40">Remark</h3>
                </div>
                <h3 class="font-size-24">Iniciar sesión</h3>
                <p>Ingresa las credenciales para poden entrar a la plataforma.</p>

                <form autocomplete="off" enctype="multipart/form-data" method="POST" action={{route('iniciar_sesion')}}>
                    {{ csrf_field() }}
                    <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="email" class="form-control empty" id="inputEmail" name="email">
                        <label class="floating-label" for="inputEmail">Correo electronico</label>
                    </div>
                    <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="password" class="form-control empty" id="inputPassword" name="contrasenia">
                        <label class="floating-label" for="inputPassword">Contraseña</label>
                    </div>
                    <div class="form-group clearfix">
                        <!--<div class="checkbox-custom checkbox-inline checkbox-primary float-left">
              <input type="checkbox" id="remember" name="checkbox">
              <label for="inputCheckbox">Remember me</label>
            </div>-->
                        <a class="float-right" href="/cambiar_contrasenia">Olvide mi contraseña?</a>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                </form>



                <footer class="page-copyright">
                    <p>Desarrollado por <a href="https://jdevs.com.mx/" target="_blank">JDev-S</a></p>
                    <p>© <?php $hoy = getdate();   
                            echo $hoy['year'];
                    ?>. Llantimax.</p>
                    <div class="social">
                        <a class="btn btn-icon btn-round social-twitter mx-5" href="javascript:void(0)" target="_blank">
                            <i class="icon bd-twitter" aria-hidden="true"></i>
                        </a>
                        <a class="btn btn-icon btn-round social-facebook mx-5" href="javascript:void(0)" target="_blank">
                            <i class="icon bd-facebook" aria-hidden="true"></i>
                        </a>
                        <a class="btn btn-icon btn-round social-google-plus mx-5" href="javascript:void(0)" target="_blank">
                            <i class="icon bd-google-plus" aria-hidden="true"></i>
                        </a>
                    </div>
                </footer>
            </div>

        </div>
    </div>
    <!-- End Page -->


    <!-- Core  -->
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
    <script src="\global\vendor\jquery-placeholder\jquery.placeholder.min.js?v4.0.1"></script>

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
        Config.set('assets', '../assets');

    </script>

    <!-- Page -->

    <script src="\assets\js\Site.min.js?v4.0.1"></script>
    <script src="\global\js\Plugin\asscrollable.min.js?v4.0.1"></script>

    <script src="\global\js\Plugin\slidepanel.min.js?v4.0.1"></script>
    <script src="\global\js\Plugin\switchery.min.js?v4.0.1"></script>

    <script src="\global\js\Plugin\jquery-placeholder.min.js?v4.0.1"></script>
    <script src="\global\js\Plugin\material.min.js?v4.0.1"></script>


    <script>
        (function(document, window, $) {
            'use strict';

            var Site = window.Site;
            $(document).ready(function() {
                Site.run();
            });
        })(document, window, jQuery);

    </script>


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

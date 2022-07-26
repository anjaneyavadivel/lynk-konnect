
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">
    
    <title>Lynk Konnect - Login</title>
    
    <link rel="apple-touch-icon" href="{{ asset('temp/assets/images/apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('temp/assets/images/favicon.ico') }}">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('temp/global/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/global/css/bootstrap-extend.min.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/assets/css/site.min.css') }}">
    
    <!-- Plugins -->
    <link rel="stylesheet" href="{{ asset('temp/global/vendor/animsition/animsition.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/global/vendor/asscrollable/asScrollable.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/global/vendor/switchery/switchery.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/global/vendor/intro-js/introjs.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/global/vendor/slidepanel/slidePanel.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/global/vendor/flag-icon-css/flag-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/global/vendor/waves/waves.css') }}">
        <link rel="stylesheet" href="{{ asset('temp/assets/examples/css/pages/login-v2.css') }}">
    
    
    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('temp/global/fonts/material-design/material-design.min.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/global/fonts/brand-icons/brand-icons.min.css') }}">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    
    <!--[if lt IE 9]>
    <script src="../../../global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
    
    <!--[if lt IE 10]>
    <script src="../../../global/vendor/media-match/media.match.min.js"></script>
    <script src="../../../global/vendor/respond/respond.min.js"></script>
    <![endif]-->
    
    <!-- Scripts -->
    <script src="{{ asset('temp/global/vendor/breakpoints/breakpoints.js') }}"></script>
    <script>
      Breakpoints();
    </script>
  </head>
  <body class="animsition page-login-v2 layout-full page-dark">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


    <!-- Page -->
    <div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
      <div class="page-content">
        <div class="page-brand-info">
          <div class="brand">
            <img class="brand-img" src="{{ asset('temp/assets/images/lynk-konnect-logo.png') }}" alt="...">
            <h2 class="brand-text font-size-40"><!-- Lynk Konnect --></h2>
          </div>
         <!--  <p class="font-size-20">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua.</p> -->
        </div>

        <div class="page-login-main">
          <div class="brand hidden-md-up">
            <img class="brand-img" src="{{ asset('temp/assets/images/logo.png') }}" alt="...">
            <h3 class="brand-text font-size-30">Lynk Konnect</h3>
          </div>
          <h3 class="font-size-24">Sign In</h3>
          <p>-- Lynk Konnect --</p>
           
           <form method="POST" action="{{ url('login') }}">
            @csrf  
            <div class="form-group form-material floating" data-plugin="formMaterial">
              
              <!-- <input type="email" class="form-control empty" id="inputEmail" name="email"> -->

              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              
              <label class="floating-label" for="inputEmail">Email</label>
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              
              <!-- <input type="password" class="form-control empty" id="inputPassword" name="password"> -->
                   <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror     
              <label class="floating-label" for="inputPassword">Password</label>
            </div>
            <div class="form-group clearfix">
              <div class="checkbox-custom checkbox-inline checkbox-primary float-left">
                <input type="checkbox" id="remember" name="checkbox">
                <label for="inputCheckbox">Remember me</label>
              </div>
              <a class="float-right" href="forgot-password.html">Forgot password?</a>
            </div>
            <!-- <button type="submit" class="btn btn-primary btn-block">Sign in</button> -->
            <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
          </form>

          <p>No account? <a href="{{ url('/register')}}">Sign Up</a></p>

          <!-- <footer class="page-copyright">
            <p>WEBSITE BY Creation Studio</p>
            <p>© 2018. All RIGHT RESERVED.</p>
            <div class="social">
              <a class="btn btn-icon btn-round social-twitter mx-5" href="javascript:void(0)">
            <i class="icon bd-twitter" aria-hidden="true"></i>
          </a>
              <a class="btn btn-icon btn-round social-facebook mx-5" href="javascript:void(0)">
            <i class="icon bd-facebook" aria-hidden="true"></i>
          </a>
              <a class="btn btn-icon btn-round social-google-plus mx-5" href="javascript:void(0)">
            <i class="icon bd-google-plus" aria-hidden="true"></i>
          </a>
            </div>
          </footer> -->
        </div>

      </div>
    </div>
    <!-- End Page -->


    <!-- Core  -->
    <script src="{{ asset('temp/global/vendor/babel-external-helpers/babel-external-helpers.js') }}"></script>
    <script src="{{ asset('temp/global/vendor/jquery/jquery.js') }}"></script>
    <script src="{{ asset('temp/global/vendor/popper-js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('temp/global/vendor/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('temp/global/vendor/animsition/animsition.js') }}"></script>
    <script src="{{ asset('temp/global/vendor/mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('temp/global/vendor/asscrollbar/jquery-asScrollbar.js') }}"></script>
    <script src="{{ asset('temp/global/vendor/asscrollable/jquery-asScrollable.js') }}"></script>
    <script src="{{ asset('temp/global/vendor/ashoverscroll/jquery-asHoverScroll.js') }}"></script>
    <script src="{{ asset('temp/global/vendor/waves/waves.js') }}"></script>
    
    <!-- Plugins -->
    <script src="{{ asset('temp/global/vendor/switchery/switchery.js') }}"></script>
    <script src="{{ asset('temp/global/vendor/intro-js/intro.js') }}"></script>
    <script src="{{ asset('temp/global/vendor/screenfull/screenfull.js') }}"></script>
    <script src="{{ asset('temp/global/vendor/slidepanel/jquery-slidePanel.js') }}"></script>
        <script src="{{ asset('temp/global/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>
    
    <!-- Scripts -->
    <script src="{{ asset('temp/global/js/Component.js') }}"></script>
    <script src="{{ asset('temp/global/js/Plugin.js') }}"></script>
    <script src="{{ asset('temp/global/js/Base.js') }}"></script>
    <script src="{{ asset('temp/global/js/Config.js') }}"></script>
    
    <script src="{{ asset('temp/assets/js/Section/Menubar.js') }}"></script>
    <script src="{{ asset('temp/assets/js/Section/GridMenu.js') }}"></script>
    <script src="{{ asset('temp/assets/js/Section/Sidebar.js') }}"></script>
    <script src="{{ asset('temp/assets/js/Section/PageAside.js') }}"></script>
    <script src="{{ asset('temp/assets/js/Plugin/menu.js') }}"></script>
    
    <script src="{{ asset('temp/global/js/config/colors.js') }}"></script>
    <script src="{{ asset('temp/assets/js/config/tour.js') }}"></script>
    <script>Config.set('assets', '../../assets');</script>
    
    <!-- Page -->
    <script src="{{ asset('temp/assets/js/Site.js') }}"></script>
    <script src="{{ asset('temp/global/js/Plugin/asscrollable.js') }}"></script>
    <script src="{{ asset('temp/global/js/Plugin/slidepanel.js') }}"></script>
    <script src="{{ asset('temp/global/js/Plugin/switchery.js') }}"></script>
        <script src="{{ asset('temp/global/js/Plugin/jquery-placeholder.js') }}"></script>
        <script src="{{ asset('temp/global/js/Plugin/material.js') }}"></script>
    
    <script>
      (function(document, window, $){
        'use strict';
    
        var Site = window.Site;
        $(document).ready(function(){
          Site.run();
        });
      })(document, window, jQuery);
    </script>
    
  </body>
</html>

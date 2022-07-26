<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">
    
    <title>Lynk Konnect - Registration</title>
    
    <link rel="apple-touch-icon" href="{{ asset('temp/assets/images/apple-touch-icon.png') }}">
    <!-- <link rel="shortcut icon" href="{{ asset('temp/assets/images/favicon.ico') }}"> -->
    <link rel="shortcut icon" href="{{ asset('temp/assets/images/favicon.png') }}">
    
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
        <link rel="stylesheet" href="{{ asset('temp/assets/examples/css/pages/register-v3.css') }}">
    
    
    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('temp/global/fonts/material-design/material-design.min.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/global/fonts/brand-icons/brand-icons.min.css') }}">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    
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
  <body class="animsition page-register-v3 layout-full">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


    <!-- Page -->
    <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">>
      <div class="page-content vertical-align-middle">
        <div class="panel">
          <div class="panel-body">
            <div class="brand">
              <img class="brand-img" src="{{ asset('temp/assets/images/logo.png') }}" alt="...">
              <h2 class="brand-text font-size-18">Lynk Konnect</h2>
            </div>
            <form method="POST" action="{{ route('register') }}">
              @csrf
              <input type="hidden" name="company_id" value="7">
              <div class="form-group form-material floating" data-plugin="formMaterial">
                <!-- <input type="text" class="form-control" name="name" /> -->
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                <label class="floating-label">Full Name</label>
              </div>
              <div class="form-group form-material floating" data-plugin="formMaterial">
                <!-- <input type="email" class="form-control" name="email" /> -->
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                <label class="floating-label">Email</label>
              </div>
              @php $stateList = \App\Models\State::orderBy('state_name', 'ASC')->get(); 
              $roleList     = \Spatie\Permission\Models\Role::orderBy('name', 'ASC')->get();  
              @endphp
              <!-- <div class="form-group form-material floating" data-plugin="formMaterial">                          
                <select class="form-control county" id="country_id" name="country_id" required>
                    <option value="">Select County</option>
                    @foreach ($stateList as $Sval)
                    <option value="{{ $Sval->id }}">{{ $Sval->state_name }}</option>
                    @endforeach
                </select>                          
              </div> -->

              <div class="form-group form-material floating" data-plugin="formMaterial">                          
                <select class="form-control county" id="role_id" name="role_id" required>
                    <option value="">Select Role</option>
                    @foreach ($roleList as $Sval)
                    <option value="{{ $Sval->id }}">{{ $Sval->name }}</option>
                    @endforeach
                </select>                          
              </div>

              <div class="form-group form-material floating" data-plugin="formMaterial">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password" style="margin-left: 145px;margin-top: -20px; position: absolute;"></span>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label class="floating-label">Password</label>   
                          
              </div>              
              <div class="form-group form-material floating" data-plugin="formMaterial">
                <!-- <input type="password" class="form-control" name="PasswordCheck" /> -->
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password1" style="margin-left: 145px;margin-top: -20px; position: absolute;"></span>
                <label class="floating-label">Re-enter Password</label>
              </div>

              <button type="submit" class="btn btn-primary btn-block btn-lg mt-40">Sign up</button>
            </form>
            <p>Have account already? Please go to <a href="{{url('/')}}">Sign In</a></p>
          </div>
        </div>

        <footer class="page-copyright page-copyright-inverse">
          
          <p>© <?php echo date('Y')?>. All RIGHT RESERVED.</p>
          <!-- <div class="social">
            <a class="btn btn-icon btn-pure" href="javascript:void(0)">
            <i class="icon bd-twitter" aria-hidden="true"></i>
          </a>
            <a class="btn btn-icon btn-pure" href="javascript:void(0)">
            <i class="icon bd-facebook" aria-hidden="true"></i>
          </a>
            <a class="btn btn-icon btn-pure" href="javascript:void(0)">
            <i class="icon bd-google-plus" aria-hidden="true"></i>
          </a>
          </div> -->
        </footer>
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


      $(document).on('click', '.toggle-password', function() {

    $(this).toggleClass("fa-eye fa-eye-slash");

    var input = $("#password");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
    });

    $(document).on('click', '.toggle-password1', function() {

$(this).toggleClass("fa-eye fa-eye-slash");

var input = $("#password-confirm");
input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
    </script>
    
  </body>
</html>

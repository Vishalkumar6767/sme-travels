<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Dorrela Service offers seamless and efficient corporate transportation solutions, ensuring safety, comfort, and punctuality for employees. With over nine years of expertise, our team delivers customized travel services tailored to meet business goals, enhancing every journey with excellence and reliability. ">
      <meta name="keywords" content="Corporate travel solutions, Corporate transportation services, Employee commute management, VIP executive travel, Business travel management, Seamless corporate travel, Corporate travel logistics, Gujarat corporate travel, Tailored corporate travel services, Corporate travel efficiency, Safe corporate travel,
                                     Reliable business transportation, Custom travel solutions for businesses, Professional corporate travel services, Corporate travel company Ahmedabad, Business travel expertise, Executive travel services, Transportation solutions for companies, Corporate travel safety and comfort, Corporate travel excellence.">
      <title>Dorrela Service Pvt.ltd</title>
      <link rel="icon" type="image/x-icon" href="collection/img/logo/favicon.png">
      <link rel="stylesheet" href="{{ asset('collection/css/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('collection/css/all-fontawesome.min.css') }}">
      <link rel="stylesheet" href="{{ asset('collection/css/animate.min.css') }}">
      <link rel="stylesheet" href="{{ asset('collection/css/magnific-popup.min.css') }}">
      <link rel="stylesheet" href="{{ asset('collection/css/owl.carousel.min.css') }}">
      <link rel="stylesheet" href="{{ asset('collection/css/jquery-ui.min.css') }}">
      <link rel="stylesheet" href="{{ asset('collection/css/jquery.timepicker.min.css') }}">
      <link rel="stylesheet" href="{{ asset('collection/css/nice-select.min.css') }}">
      <link rel="stylesheet" href="{{ asset('collection/css/style.css') }}">
      @stack('styles')
   </head>
   <body class="home-2">
      @include('frontend.partials.header')
      <div class="sidebar-popup">
         @include('frontend.partials.sidebar')
      </div>
      
         @yield('content')
      @include('frontend.partials.footer')
    
      <a href="#" id="scroll-top"><i class="far fa-arrow-up"></i></a>
      <script data-cfasync="false"src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
      <script src="{{ asset('collection/js/jquery-3.6.0.min.js') }}"></script>
      <script src="{{ asset('collection/js/modernizr.min.js') }}"></script>
      <script src="{{ asset('collection/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('collection/js/imagesloaded.pkgd.min.js') }}"></script>
      <script src="{{ asset('collection/js/jquery.magnific-popup.min.js') }}"></script>
      <script src="{{ asset('collection/js/isotope.pkgd.min.js') }}"></script>
      <script src="{{ asset('collection/js/jquery.appear.min.js') }}"></script>
      <script src="{{ asset('collection/js/jquery.easing.min.js') }}"></script>
      <script src="{{ asset('collection/js/owl.carousel.min.js') }}"></script>
      <script src="{{ asset('collection/js/counter-up.js') }}"></script>
      <script src="{{ asset('collection/js/jquery-ui.min.js') }}"></script>
      <script src="{{ asset('collection/js/jquery.timepicker.min.js') }}"></script>
      <script src="{{ asset('collection/js/jquery.nice-select.min.js') }}"></script>
      <script src="{{ asset('collection/js/wow.min.js') }}"></script>
      <script src="{{ asset('collection/js/main.js') }}"></script>
      @stack('scripts')
   </body>
</html>
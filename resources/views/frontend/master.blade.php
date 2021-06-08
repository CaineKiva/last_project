
<!DOCTYPE html>
<html lang="en">
   <!-- Basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- Mobile Metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- Site Metas -->
   <title>Life Care - Responsive HTML5 Multi Page Template</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- Site Icons -->
   <link rel="shortcut icon" href="{{ asset('public/images/fevicon.ico.png') }}" type="image/x-icon" />
   <link rel="apple-touch-icon" href="{{ asset('public/images/apple-touch-icon.png') }}">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="{{ asset('public/css2/bootstrap.min.css') }}">
   <!-- Site CSS -->
   <link rel="stylesheet" href="{{ asset('public/css2/style.css') }}">
   <!-- Colors CSS -->
   <link rel="stylesheet" href="{{ asset('public/css2/colors.css') }}">
   <!-- ALL VERSION CSS -->
   <link rel="stylesheet" href="{{ asset('public/css2/versions.css') }}">
   <!-- Responsive CSS -->
   <link rel="stylesheet" href="{{ asset('public/css2/responsive.css') }}">
   <!-- Custom CSS -->
   <link rel="stylesheet" href="{{ asset('public/css2/custom.css') }}">
   <!-- Modernizer for Portfolio -->
   <script src="{{ asset('public/js2/modernizer.js') }}"></script>
   <!-- [if lt IE 9] -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    

    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />

     <!-- Jqr datatables -->
    <link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/jquery.dataTables.min.css') }}"> 
   </head>
   <body class="clinic_version">
      <!-- LOADER -->
    <div id="page">
      <div id="preloader">
         <img class="preloader" src="{{ asset('public/images/loaders/heart-loading2.gif') }}" alt="">
      </div>
      <!-- END LOADER -->
      @include('frontend.header')

      @include('frontend.home')
      
      @include('frontend.about')

      @include('frontend.service')
	  
      @include('frontend.doctors')

      @include('frontend.price')
	  
	  @include('frontend.contact')
      
      <!-- end section -->
     
      @include('frontend.footer')
      <!-- end copyrights -->
      <a href="#home" data-scroll class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>
      <!-- all js files -->
      <script src="{{ asset('public/js2/all.js') }}"></script>
      <!-- all plugins -->
      <script src="{{ asset('public/js2/custom.js') }}"></script>
      <!-- map -->
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNUPWkb4Cjd7Wxo-T4uoUldFjoiUA1fJc&callback=myMap"></script>
     
    <script src="{{ asset('public/js/jquery.min.js') }}"></script>

    <script src="{{ asset('public/vendors/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('public/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/main.js') }}"></script>

    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script>
      $( function() {
        $( "input" ).checkboxradio();
      } );
    </script>
    @stack('js')
   </div>
   </body>
</html>


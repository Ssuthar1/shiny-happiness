<!DOCTYPE html>
<html lang="en" data-x="html" data-x-toggle="html-overflow-hidden">
<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600&amp;display=swap" rel="stylesheet">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{asset('frontend/')}}/css/vendors.css">
  <link rel="stylesheet" href="{{asset('frontend/')}}/css/main.css">
 <link rel="stylesheet" href="{{asset('frontend/')}}/css/custom.css">
  <title>{{env('APP_NAME')}}</title>
  <livewire:styles />
</head> 
<body>
  <div class="preloader js-preloader">
    <div class="">
      <div class="">
        <img src="{{asset('frontend/')}}/img/icons/loder.gif">
           
          </defs>
        </svg>
      </div>
    </div>

    <div class="preloader__title">{{env('APP_NAME')}}</div>
  </div>

  <main>
    @if(!Route::is('homePage') )
      <div class="header-margin"></div>
    @endif
    @include('frontend.includes.header')

      {{ $slot }} 

    @include('frontend.includes.footer')

  </main>


<x-lang-menu   />

<x-currency-menu   />

<x-map-filter   />



  <!-- JavaScript -->
  <script src="https://maps.googleapis.com/maps/api/js?"></script>
   <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>

  <script src="{{asset('frontend/')}}/js/vendors.js"></script>
  <script src="{{asset('frontend/')}}/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <livewire:scripts />
</body> 
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
<link href="{{asset('dashboard/style.css')}}" rel="stylesheet">
<link href="{{asset('dashboard/css/custom.css')}}" rel="stylesheet">


      @php /*  @vite(['resources/css/app.css', 'resources/js/app.js']) */ @endphp
      <livewire:styles />
    </head>
    <body  x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
  x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
  :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">

   <!-- ===== Preloader Start ===== -->
    @include('layouts.includes.preloader')
   
  <!-- ===== Preloader End ===== -->
 
  <!-- ===== Page Wrapper Start ===== -->
  <div class="flex h-screen overflow-hidden">

    <!-- ===== Sidebar Start ===== -->
      @include('layouts.includes.sidebar')
    
    <!-- ===== Sidebar End ===== -->

    <!-- ===== Content Area Start ===== -->
    <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
      <!-- ===== Header Start ===== -->

      @include('layouts.includes.header')
      
      <!-- ===== Header End ===== -->

      <!-- ===== Main Content Start ===== -->
      <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10"> 
              {{ $slot }} 
        </div>
      </main>
      <!-- ===== Main Content End ===== -->
    </div>
    <!-- ===== Content Area End ===== -->
  </div>
  <!-- ===== Page Wrapper End ===== -->
 <script defer src="{{asset('dashboard/bundle.js')}}"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <livewire:scripts />
    </body>
</html>

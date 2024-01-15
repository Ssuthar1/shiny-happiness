

<header data-add-bg="bg-dark-1" class="header @if(Route::is('homePage') ) bg-green @else bg-dark-3 @endif js-header" data-x="header" data-x-toggle="is-menu-opened">
      <div data-anim="fade" class="header__container px-30 sm:px-20 is-in-view">
        <div class="row justify-between items-center">
  
  <div class="col-auto col-auto-menu">
  
  <div class="header-menu " data-x="mobile-menu" data-x-toggle="is-menu-active">
  <div class="mobile-overlay"></div>
  
  <div class="header-menu__content">
  <div class="mobile-bg js-mobile-bg"></div>
  
  <div class="menu js-navList">
  <ul class="menu__nav text-white -is-active">
  
  <li>
  <a data-barba href="{{route('homePage')}}">
  <span class="mr-10">Home</span>
  </a> 
  </li> 
  
  <li class="menu-item-has-children -has-mega-menu">
  <a data-barba href="javascript:void('0');">
  <span class="mr-10">Tours </span>
  <i class="icon icon-chevron-sm-down"></i>
  </a>
  
  <div class="mega">
  <div class="tabs -underline-2 js-tabs">
  <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 pb-30 js-tabs-controls">
  
  @foreach($global_tour_categories as $key=>  $tourCategory)
  <div class="col-auto">
  <button class="tabs__button text-light-1 fw-500 js-tabs-button @if($key==0) is-tab-el-active @endif " 
  data-tab-target=".-tab-{{$tourCategory['slug']}}">{{$tourCategory['title']}}</button>
  </div>
  @endforeach 
  
  </div>
  
  <div class="tabs__content js-tabs-content"> 
    @foreach($global_tour_categories as $key =>  $tourCategory )
    <div class="tabs__pane -tab-{{$tourCategory['slug']}} @if($key==0) is-tab-el-active @endif ">
    <div class="mega__content">
      <div class="mega__grid">
      
            <div class="mega__item">
            <div class="text-15 fw-500">{{$tourCategory['title']}} Lists</div>
            <div class="y-gap-5 text-15 pt-5">
             @foreach($global_tours as $tourKey => $tourInfo)
              @if($tourInfo['tour_category_id']==$tourCategory['id'])
                <div><a href="{{route('toursDetail',$tourInfo['slug'])}}">{{$tourInfo['title']}}</a></div>
              @endif
              @endforeach
           
            </div>
            </div> 
      </div> 
      <div class="mega__image d-flex relative">
        <img src="{{asset('frontend/')}}/img/backgrounds/7.png" alt="image" class="rounded-4"> 
        <div class="absolute w-full h-full px-30 py-24">
            <div class="text-22 fw-500 lh-15 text-white">Things to do on <br> your trip</div>
            <button class="button h-50 px-30 -blue-1 text-dark-1 bg-white mt-20">Experinces</button>
        </div>
      </div>
    </div>
    </div>
    @endforeach
   
  </div>
  </div>
  </div>
  
  <ul class="subnav mega-mobile">
  <li class="subnav__backBtn js-nav-list-back">
  <a href="#"><i class="icon icon-chevron-sm-down"></i> Tours</a>
  </li>
  
   @foreach($global_tour_categories as $key=>  $tourCategory)
  <li class="menu-item-has-children">
    <a data-barba href="#">
    <span class="mr-10">{{$tourCategory['title']}}</span>
    <i class="icon icon-chevron-sm-down"></i>
    </a>
  
  <ul class="subnav">

    <li class="subnav__backBtn js-nav-list-back">
    <a href="#"><i class="icon icon-chevron-sm-down"></i> {{$tourCategory['title']}}</a>
    </li>  
      @foreach($global_tours as $tourKey => $tourInfo)
        @if($tourInfo['tour_category_id']==$tourCategory['id'])
          <li><a href="{{route('toursDetail',$tourInfo['slug'])}}">{{$tourInfo['title']}}</a></li>
        @endif
      @endforeach 
  </ul>
  </li> 
 @endforeach
  </ul>
  </li>
  
  <li class="menu-item-has-children">
        <a data-barba href="javascript:void('0');">
          <span class="mr-10">Eco Guardian Project </span>
          <i class="icon icon-chevron-sm-down"></i>
        </a>
  
        <ul class="subnav">
          <li class="subnav__backBtn js-nav-list-back">
          <a href="#"><i class="icon icon-chevron-sm-down"></i> Pages</a>
          </li>
  
          <li><a href="#">About Us</a></li>
  
          <li><a href="#">Challenges / Solutions</a></li>
  
          <li><a href="#">Tours</a></li>
  
          <li><a href="#">Connect with Us</a></li>
  
          <li><a href="#">FAQ</a></li>
  
          <li><a href="#">Resource</a></li>
  
        
  
        </ul>
  
        </li>
  
  <li>
  <a data-barba href="{{route('blog')}}">
  <span class="mr-10">Blog</span>
  </a> </li>
  
  <li>
  <a data-barba href="{{route('aboutUs')}}">
  <span class="mr-10">About </span>
  </a> </li>
  
  
  
  <li >
  <a href="javascript:void('');">FAQ</a>
  </li>
  <li>
  <a href="{{route('contactUs')}}">Contact</a>
  </li>
  </ul>
  </div>
  
  <div class="mobile-footer px-20 py-20 border-top-light js-mobile-footer">
  </div>
  </div>
  </div>
  
  </div>
  
  
  <div class="col-auto">
  <a href="{{route('homePage')}}" class="header-logo" data-x="header-logo" data-x-toggle="is-logo-dark">
  <img src="{{asset('frontend/')}}/img/general/logo-light.png" alt="logo icon">
  <img src="{{asset('frontend/')}}/img/general/logo-dark.png" alt="logo icon">
  </a>
  </div>
  
  
  <div class="col-auto">
  <div class="d-flex items-center">
  
  <div class="row x-gap-20 items-center xl:d-none ">
  <div class="col-auto">
  <button class="d-flex items-center text-14 text-white" data-x-click="currency">
  <span class="js-currencyMenu-mainTitle">USD</span>
  <i class="icon-chevron-sm-down text-7 ml-10"></i>
  </button>
  </div>
  
  <div class="col-auto">
  <div class="w-1 h-20 bg-white-20"></div>
  </div>
  
  <div class="col-auto">
  <button class="d-flex items-center text-14 text-white" data-x-click="lang">
  <img src="{{asset('frontend/')}}/img/general/lang.png" alt="image" class="rounded-full mr-10">
  <span class="js-language-mainTitle">United Kingdom</span>
  <i class="icon-chevron-sm-down text-7 ml-15"></i>
  </button>
  </div>
  </div>
  
  
  <div class="d-flex items-center ml-20 is-menu-opened-hide md:d-none">
  <a href="#" class="button px-30 fw-400 text-14 -blue-1 bg-white h-50 text-dark-1">Plan Your Own Tour</a>
  </div>
  
  <div class="d-none xl:d-flex x-gap-20 items-center pl-30 text-white" data-x="header-mobile-icons" data-x-toggle="text-white">
  <div><button class="d-flex items-center icon-menu text-inherit text-20" data-x-click="html, header, header-logo, header-mobile-icons, mobile-menu"></button></div>
  </div>
  </div>
  </div>
  
  </div>
  </div>
  </header>
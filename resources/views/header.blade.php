<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<title>{{$title}}</title>
	{{ HTML::style('css/iconfont.css')}}
    {{ HTML::style('css/slick/slick.css')}}
    {{ HTML::style('css/slick/slick-theme.css')}}
    {{ HTML::style('css/stylesheet.css')}}
    {{ HTML::style('css/font-awesome.min.css')}}
    {{ HTML::style('css/jquery.fancybox.css')}}
    {{ HTML::style('css/bootstrap.css')}}
    {{-- HTML::style('css/bootstrap.min.css')--}}
    {{ HTML::style('css/magnific-popup.css')}}

    <!--For Plugins external css-->
    {{ HTML::style('css/plugins.css')}}
    
    <!--Theme custom css -->
    {{ HTML::style('css/style.css')}}
    
    <!--Theme Responsive css-->
    {{ HTML::style('css/responsive.css')}}
    
    {{ HTML::style('css/else/my.css')}}
    
    {{ HTML::script('js/vendor/modernizr-2.8.3-respond-1.4.2.min.js')}}
    
    {{ HTML::script('js/vendor/jquery-1.11.2.min.js')}}
	{{ HTML::script('js/vendor/bootstrap.min.js')}}
        
	{{ HTML::script('js/jquery.magnific-popup.js')}}
    {{ HTML::script('js/jquery.mixitup.min.js')}}
	{{ HTML::script('js/jquery.easing.1.3.js')}}
    {{ HTML::script('js/jquery.masonry.min.js')}}

    <!--slick slide js -->
    {{ HTML::script('js/slick.js')}}
    {{ HTML::script('js/slick.min.js')}}
            
    {{ HTML::script('js/plugins.js')}}
    {{ HTML::script('js/main.js')}}
</head>
<body data-spy="scroll" data-target=".navbar-collapse">
<div class='preloader'>
  <div class='loaded'>&nbsp;</div>
</div>
<div class="culmn">
<header id="main_menu" class="header navbar-fixed-top menu-scroll">
  <div class="main_menu_bg">
    <div class="container">
      <div class="row">
        <div class="nave_menu">
          <nav class="navbar navbar-default">
            <div class="container-fluid"> 
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" id="mobile_btn" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a class="navbar-brand" href="{{url('/')}}"> {{ HTML::image('images/WaterMark2.png', 'Logo') }} </a> </div>
              
              <!-- Collect the nav links, forms, and other content for toggling -->
              
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> @if(!empty($items))
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="#home">產品介紹</a></li>
                  <li><a href="#inspection">檢驗報告</a></li>
                  <li><a href="#produce">生產紀錄</a></li>
                  <li><a href="#environment">農友與生態環境介紹</a></li>
                </ul>
                @endif </div>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>
</header>
<!--End of header -->
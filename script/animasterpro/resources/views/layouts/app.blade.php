<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
      $fav = App\Site::where('id', 1)->first()->favicon;
      if($fav == '')
      {
    ?>
      <link rel="shortcut icon" sizes="114x114" href="{{{ asset('images/favicons/favico_default.ico') }}}">
    <?php
      }
      else
      {
    ?>
      <link rel="shortcut icon" sizes="114x114" href="{{{ asset($fav) }}}">
    <?php
      }
    ?>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Cantora+One&family=Didact+Gothic&family=K2D:wght@100&family=Reem+Kufi&family=Sunflower:wght@300&display=swap" rel="stylesheet">
</head>

<body>

<!-- Facebook Comments -->
<?php 
  $facecom = App\Site::where('id', 1)->first();
  if(isset($facecom->facebookcomments) && $facecom->facebookcomments == "Yes")
  {
    $facecode = explode("AniMasTER4g3t319edoc670a4g84AniMASTer", $facecom->facecomcode);
?>
{!! $facecode[0] !!}
<?php
  }
?>

<!-- End Facebook Comments -->

    <div class="container-fluid">
        <div class="main-nav">
        <!-- Start upperbar --> 
            <div class="upperbar">
              <div class="container">
                <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 upperIcons">
                    <h6>Follow us</h6>
                    <?php

                        $siteinfo = App\Site::where('id', 1)->first();
                    ?>
                    
                    <a href="{{isset($siteinfo) && $siteinfo->facebook ? $siteinfo->facebook : '#'}}" target="_blank"><i class="fab fa-facebook-square"></i></a>
                    <a href="{{isset($siteinfo) && $siteinfo->twitter ? $siteinfo->twitter : '#'}}" target="_blank"><i class="fab fa-twitter-square"></i></a>
                    <a href="{{isset($siteinfo) && $siteinfo->youtube ? $siteinfo->youtube : '#'}}" target="_blank"><i class="fab fa-youtube"></i></a>
                    <a href="{{isset($siteinfo) && $siteinfo->vimo ? $siteinfo->vimo : '#'}}" target="_blank"><i class="fab fa-vimeo-square"></i></a>
                </div>

                <div class="input-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <form action="/search" class="mainsearchform" method="post">
                  @CSRF
                    <input class="form-control" type="text" name="searchvalue" placeholder="Search" aria-label="Search">

                      <div class="input-group-append">
                        <button href="" class="searchhyper">
                          <span class="input-group-text searchspan" id="basic-text1"><i class="fas fa-search text-grey" aria-hidden="true"></i></span>
                        </button>
                      </div>
                    </form>
                </div>

              </div>
            </div>
          </div>
        <!-- End upperbar --> 
        <!-- Start Navbar -->
        <nav class="real-nav navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">

          <a class="navbar-brand col-xs-2" href="/">
          
          {{ config('app.name', 'Laravel') }}

          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse col-xs-10" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">

              

              <li class="nav-item active">
                <a class="nav-link" href="{{route('index.index')}}">Home <span class="sr-only">(current)</span></a>
              </li>
              @if(isset($cates) and $cates->count() > 0)
                @foreach($cates as $cate)

                    @if($cate->catename != 'uncategorized')
                    <li class="nav-item">
                      <a class="nav-link" href="/category/{{$cate->catename}}">{{$cate->catename}}</a>
                    </li>
                    @endif
                @endforeach
              @endif
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                    </div>
                </li>
            @endguest
            @if(isset($pages) and $pages->count() > 0)
              @foreach($pages as $page)
                <li class="nav-item">
                  <a class="nav-link" href="/page/{{$page->pagename}}">{{$page->pagename}}</a>
                </li>
              @endforeach
            @endif
              <li class="nav-item">
                  <a class="nav-link" href="{{route('message.message')}}">Contact</a>
              </li>
            </ul>
          </div>
          </div>
        </nav>
        <!-- End Navbar -->
        </div>

        <div class="contentcon">
                @yield('content')
        </div>



    <!-- Start Footer -->
    <div class="footer" id="end_footer">
      <div class="container">
        <div class="upperfooter">
          <div class="row">

            <div class="col-lg-6 col-md-6 sitemap">
              <h5>Site Map</h5>
              <div class="row">
              @if(isset($cates) && $cates->count() > 0)
              <div class="col-lg-4 col-md-4 col-sm-4">
                <ul class="list-unstyled">
                @foreach($cates as $cate)
                <li><a href="/category/{{$cate->catename}}">{{$cate->catename}}</a></li>
                @endforeach
                </ul>
              </div>
              @endif

              @if(isset($pages) && $pages->count() > 0)
              <div class="col-lg-4 col-md-4 col-sm-4">
                <ul class="list-unstyled">
                @foreach($pages as $page)
                <li><a href="/page/{{$page->pagename}}">{{$page->pagename}}</a></li>
                @endforeach
                <li><a href="/sendmessage">Contact</a></li>
                </ul>
              </div>
              @endif

              <div class="col-lg-4 col-md-4 col-sm-4">
                <ul class="list-unstyled">
                  <li><a href="/login">Login</a></li>
                  <li><a href="/register">Register</a></li>
                </ul>
              </div>

                  <div class="col-lg-12 social mt-4">
                    <a href="{{isset($siteinfo) && $siteinfo->facebook ? $siteinfo->facebook : '#'}}" target="_blank"><i class="fab fa-facebook-square"></i></a>
                    <a href="{{isset($siteinfo) && $siteinfo->twitter ? $siteinfo->twitter : '#'}}" target="_blank"><i class="fab fa-twitter-square"></i></a>
                    <a href="{{isset($siteinfo) && $siteinfo->youtube ? $siteinfo->youtube : '#'}}" target="_blank"><i class="fab fa-youtube"></i></a>
                    <a href="{{isset($siteinfo) && $siteinfo->vimo ? $siteinfo->vimo : '#'}}" target="_blank"><i class="fab fa-vimeo-square"></i></a>
                  </div>
              </div>
            </div>

            <div class="col-lg-6 col-md-6 contact">
              <h5>About</h5>
              @if(isset($siteinfo) && $siteinfo->footerabout)
              <p>{{$siteinfo->footerabout}}</p>
              @else
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque ex, non sed vel aliquam, similique enim expedita dolor quis reiciendis beatae obcaecati totam fugiat magni at optio dolorem corrupti sapiente!</p>
              @endif
            </div>
          </div>

        </div>
        <div class="lowerfooter">
            <p>© 2020 Animaster All Rights Reserved</p>
        </div>
      </div>
    </div>
    <!-- End Footer -->

    <!-- Start JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{asset('js/plugins.js')}}"></script>
    <!-- End JS Scripts -->
      </div>
    </body>
</html>
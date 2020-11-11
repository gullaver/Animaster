<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dashboard</title>

  <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/admin_css/summernote.css')}}">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="{{asset('css/admin_css/bootstrap-tagsinput.css')}}">
  <link href="//vjs.zencdn.net/7.8.2/video-js.min.css" rel="stylesheet">
  <script src="//vjs.zencdn.net/7.8.2/video.min.js"></script>
  <link rel="stylesheet" href="{{asset('css/admin_css/admin.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body>

    <div class="messageconfirm">
      <div class="bef">
        <div class="container">
          <div class="selectoptoconf img-thumbnail">
            <div class="quiz">
              <p>Do you want to delete this category ?</p>
            </div>
            <div class="choose">
              <a href="" class="btn btn-sm btn-danger cat-del-action">Ok</a><a href="" class="btn btn-sm btn-primary">Cancel</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="sendpostloding">
      <div class="spinner">
        <div class="rect1"></div>
        <div class="rect2"></div>
        <div class="rect3"></div>
        <div class="rect4"></div>
        <div class="rect5"></div>
      </div>
      </div>
    <div class="container-fluid">
        <div class="row">

          @include('cp.layouts.admin_header')
          @include('cp.layouts.admin_sidebar')

          @yield('content')

          @include('cp.layouts.admin_footer')


          </div>
      </div>



    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/admin_js/all.js')}}"></script>
    <script src="{{asset('js/admin_js/summernote.js')}}"></script>
    <script src="{{asset('js/admin_js/bootstrap-tagsinput.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{asset('js/admin_js/plugins.js')}}"></script>
    </body>
</html>

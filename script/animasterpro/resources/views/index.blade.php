@extends('layouts.app')

@section('title')
<title>{{ config('app.name', 'Laravel') }}</title>
@endsection

@section('content')

<!-- Start Slider -->       
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="sliderLi d-none d-md-block active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1" class="sliderLi d-none d-md-block"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2" class="sliderLi d-none d-md-block"></li>
          </ol>
          <div class="carousel-inner">
            @if(isset($slider))

              <div class="carousel-item active">
                @if($slider[0] && $slider[0]->posts->count() > 0)
                <a href="/series/{{$slider[0]->posts[0]->id}}">
                <img class="d-block w-100" src="{{asset($slider[0]->image)}}" alt="First slide">
                  <div class="carousel-caption d-none d-md-block">
                    <div class="carouselinner">
                    <h5>{{$slider[0]->seriesname}}</h5></a>
                    <p><?php echo html_entity_decode($slider[0]->content)?></p>
                    </div>
                </div>
                </a>
                @else
                <img class="d-block w-100" src="{{asset('images/slider/temp_slider.jpg')}}" alt="First slide">
                @endif
              </div>
            

            <div class="carousel-item">
              @if($slider[1] && $slider[1]->posts->count() > 0)
                <a href="/series/{{$slider[1]->posts[0]->id}}">
                <img class="d-block w-100" src="{{asset($slider[1]->image)}}" alt="Second slide">
                  <div class="carousel-caption d-none d-md-block">
                    <div class="carouselinner">
                    <h5>{{$slider[1]->seriesname}}</h5>
                    <p><?php echo html_entity_decode($slider[1]->content)?></p>
                    </div>
                </div>
                </a>
                @else
                <img class="d-block w-100" src="{{asset('images/slider/temp_slider.jpg')}}" alt="Second slide">
                @endif
              </div>

              <div class="carousel-item">
              @if($slider[2] && $slider[2]->posts->count() > 0)
              <a class="slider_href" href="/series/{{$slider[2]->posts[0]->id}}">
                <img class="d-block w-100" src="{{asset($slider[2]->image)}}" alt="Third slide">
                  <div class="carousel-caption d-none d-md-block">
                    <div class="carouselinner">
                      <h5>{{$slider[2]->seriesname}}</h5>
                      <p><?php echo html_entity_decode($slider[2]->content)?></p>
                    </div>
                  </div>
                </a>
              @else
              <img class="d-block w-100" src="{{asset('images/slider/temp_slider.jpg')}}" alt="Third slide">
              @endif
              </div>

            @endif
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
<!-- End Slider -->


<!-- Start News-->
<!-- End News -->


<!-- Start Latest Episodes-->
<!--


-->
<div class="episodeslist">
  <div class="container">
    <h4><span>Latest Episodes</span></h4>

      <div class="row mb-2">
          @if(isset($latestposts) && $latestposts->count() > 0)
          @foreach($latestposts as $latestpost)
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mt-1 card-container">
            <div class="card">
              @if($latestpost->series_id != 0)
              <a href="/series/{{$latestpost->id}}"><img class="card-img-top" src="{{$latestpost->img_src == 'native' ? asset('$latestpost->image') : $latestpost->image}}"></a>
              @else
              <a href="/watch/{{$latestpost->id}}"><img class="card-img-top" src="{{$latestpost->img_src == 'native' ? asset('$latestpost->image') : $latestpost->image}}"></a>
              @endif
              <div class="card-body">
                <p class="card-text">{{$latestpost->title}}</p>
              </div>
            </div>
          </div>
        @endforeach
        @else
        <div class="row see-all">
            <div class="col-lg-12 see-all-btn">
              There is posts
            </div>
        </div>
        @endif
        </div>
          <!--
          <div class="row see-all">
            <div class="col-lg-12 see-all-btn">
              <a class="btn btn-light" href="#" role="button">See All</a>
            </div>
          </div>
          -->

  </div>
</div>

<!-- End Latest Episodes -->

<!-- Start Popular Episodes-->

<div class="episodeslist">
  <div class="container">
    <h4><span>Popular Episodes</span></h4>

    <div class="row mb-2">

        @if(isset($popposts))
        @foreach($popposts as $poppost)
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mt-1 card-container">
          <div class="card">
            @if($poppost->series_id != 0)
            <a href="/series/{{$poppost->id}}"><img class="card-img-top" src="{{$poppost->img_src == 'native' ? asset('$poppost->image') : $poppost->image}}"></a>
            @else
            <a href="/watch/{{$poppost->id}}"><img class="card-img-top" src="{{$poppost->img_src == 'native' ? asset('$poppost->image') : $poppost->image}}"></a>
            @endif
            <div class="card-body">
              <p class="card-text">{{$poppost->title}}</p>
            </div>
          </div>
        </div>
      @endforeach
      @else
      <div class="row see-all">
          <div class="col-lg-12 see-all-btn">
              There is posts
          </div>
      </div>
      @endif

    </div>
  </div>
</div>

<!-- End Popular Episodes -->

<!-- Start Categories Episodes-->

@if(isset($cates))
@foreach($cates as $catetospread)
@if($catetospread->count() > 0)
<div class="episodeslist">
    <div class="container">
      <h4><span>{{$catetospread->catename}}</span></h4>

      <div class="row mb-2">
      <?php $counter = 0; ?>
      @foreach($catetospread->posts as $post)
      <?php
      if($counter == 24)
      {
        ?>
        @break;
        <?php
        $counter == 0;
      }
      ?>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mt-1 card-container">
          <div class="card">
            @if($post->series_id != 0)
            <a href="/series/{{$post->id}}"><img class="card-img-top" src="{{$post->img_src == 'native' ? asset('$post->image') : $post->image}}"></a>
            @else
            <a href="/watch/{{$post->id}}"><img class="card-img-top" src="{{$post->img_src == 'native' ? asset('$post->image') : $post->image}}"></a>
            @endif
            <div class="card-body">
              <p class="card-text">{{$post->title}}</p>
            </div>
          </div>
        </div>
        <?php $counter++ ?>
      @endforeach
      </div>
        <div class="row see-all">
            <div class="col-lg-12 see-all-btn">
              <a class="btn btn-light" href="/category/{{$catetospread->catename}}" role="button">See All</a>
            </div>
        </div>
  </div>
</div>
@endif
@endforeach
      @endif


<!-- End Categories Episodes -->

@endsection
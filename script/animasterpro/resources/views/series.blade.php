@extends('layouts.app')

@section('title')
@if(isset($thisseries))
<title>{{$thisseries->seriesname}}</title>
@else
<title>{{ config('app.name', 'Laravel') }}</title>
@endif
@endsection

@section('content')
<section class="category_main">
<div class="cate_layer">
    <div class="container">
        <div class="row series_row">

                @if(isset($thisseries))
                    <div class="col-lg-6 col-md-6 col-12 seriesinfo">
                        <div class="card" style="width: 18rem;">
                            @if($thispost->image_src == 'native')
                            <img class="card-img-top" src="{{asset($thispost->image)}}" alt="Card image cap">
                            @else
                            <img class="card-img-top" src="{{$thispost->image}}" alt="Card image cap">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{$thisseries->seriesname}}</h5>
                                <p class="card-text"><?php echo html_entity_decode($thisseries->content); ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-12 div_watch_others">
                        <div class="this_episode">
                            @if($thispost->downloadoption == 'Yes')
                            <h5>{{$thispost->title}}</h5>
                            <a href="/download/{{$thispost->id}}" class="btn btn-success">Download</a>
                            <a href="/watch/{{$thispost->id}}" class="btn btn-primary">Watch Episode</a>
                            @else
                            <h5>{{$thispost->title}}</h5>
                            <a href="/watch/{{$thispost->id}}" class="btn btn-primary">Watch episode</a>
                            @endif
                        </div>
                        
                        <div class="other_episodes">
                            <h6>Eepisodes List</h6>
                            <div class="episss">
                                @foreach($seriesposts as $seriespost)
                                <a href="/series/{{$seriespost->id}}" class="btn btn-sm btn-light">{{$seriespost->epn}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                @else
                    <div class="no_data_div">
                        <p>There is no posts in this series</p>
                    </div>
                @endif
        </div>
    </div>
    </div>
</section>
@endsection
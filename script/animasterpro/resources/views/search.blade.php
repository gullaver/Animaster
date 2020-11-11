@extends('layouts.app')

@section('title')
@if(isset($searchtext))
<title>{{$searchtext}}</title>
@else
<title>{{ config('app.name', 'Laravel') }}</title>
@endif
@endsection

@section('content')
<section class="category_main">
<div class="cate_layer">
    <div class="container">
        <div class="cate">
            <div class="row searcheadrow">
                <div class="searchhead p-2">
                <i class="fab fa-searchengin"></i><p class="card-text ml-1">Results for: {{$searchtext}}</p>
                </div>
            </div>
                <div class="row searchpage">
                @if(isset($searchresults) && $searchresults->count() > 0)
                    @foreach($searchresults as $searchresult)
                        @if($searchresult->series_id == 0)
                            <a href="/watch/{{$searchresult->id}}" class="col-lg-3 col-md-4 col-sm-6 col-12 epi_blk">
                        @else
                            <a href="/series/{{$searchresult->id}}" class="col-lg-3 col-md-4 col-sm-6 col-12 epi_blk">
                        @endif
                                <div class="card episodes_card">
                                @if($searchresult->image_src == 'native')
                                    <img src="{{asset($searchresult->image)}}" class="card-img img-fluid card_img_top" alt="{{$searchresult->title}}">
                                @else
                                    <img src="{{$searchresult->image}}" class="card-img img-fluid card_img_top" alt="{{$searchresult->title}}">
                                @endif
                                    <div class="card-body">
                                        <h7 class="card-title">{{$searchresult->title}}</h7>
                                        <div class="access"><i class="fa fa-eye" aria-hidden="true"></i><small class="ml-2">{{$searchresult->views == NULL ? 0 : $searchresult->views}}</small></div>
                                    </div>
                                </div>
                            </a>
                    @endforeach

            </div>

            @else
                <div class="no_data_div">
                    <p>Nothing found :(</p>
                </div>
            @endif
            @if(isset($searchresults))
                {{$searchresults->links()}}
            @endif
        </div>
    </div>
</div>
</section>
@endsection
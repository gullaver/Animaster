@extends('layouts.app')

@section('title')
<title>{{$cateinfo->catename}}</title>
@endsection

@section('content')
<section class="category_main">
<div class="cate_layer">
    <div class="container">
        <div class="cate">
            <div class="row">
                <div class="card mb-3 col-12">
                    <div class="row no-gutters">
                        <div class="card-body">
                            <h5 class="card-title">{{$cateinfo->catename}}</h5>
                            <p class="card-text">{{$cateinfo->catedesc}}</p>
                        </div>
                    </div>
                </div>
                @if(isset($posts) && $posts->count() > 0)
                    @foreach($posts as $post)
                        @if($post->series_id == 0)
                            <a href="/watch/{{$post->id}}" class="col-lg-3 col-md-4 col-sm-6 col-12 epi_blk">
                        @else
                            <a href="/series/{{$post->id}}" class="col-lg-3 col-md-4 col-sm-6 col-12 epi_blk">
                        @endif
                                <div class="card episodes_card">
                                @if($post->image_src == 'native')
                                    <img src="{{asset($post->image)}}" class="card-img img-fluid card_img_top" alt="{{$post->title}}">
                                @else
                                    <img src="{{$post->image}}" class="card-img img-fluid card_img_top" alt="{{$post->title}}">
                                @endif
                                    <div class="card-body">
                                        <p class="card-title">{{$post->title}}</p>
                                        <div class="access"><i class="fa fa-eye" aria-hidden="true"></i><small class="ml-2">{{$post->views == NULL ? 0 : $post->views}}</small></div>
                                    </div>
                                </div>
                            </a>
                    @endforeach

            </div>

            @else
                <div class="no_data_div">
                    <p>There is no posts in this category</p>
                </div>
            @endif
            @if(isset($posts))
                {{$posts->links()}}
            @endif
        </div>
    </div>
</div>
</section>
@endsection
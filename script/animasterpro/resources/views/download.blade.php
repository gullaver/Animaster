@extends('layouts.app')

@section('title')
<title>Download</title>
@endsection

@section('content')
<section class="category_main down_category_main">
    <div class="cate_layer">
        <div class="container">
            @if(isset($thispost) && $thispost->downloadoption == 'Yes')
                <div class="downservers">
                    <div class="row">
                        <h5 class="col-12 mb-3">Download Servers</h5>
                        @if(isset($downserversnamefinal) && $downserversnamefinal != '')
                                @if($thispost->upvideo != '')
                                <a target="_blank" href="{{asset($thispost->upvideo)}}" class="btn btn-light wserver dwserver">{{$sitename}}</a>
                                @endif
                            @for($i = 0; $i<$downsercount; $i++)
                                <a target="_blank" href="{{$downserverslinkfinal[$i]}}" class="btn btn-light wserver dwserver">{{$downserversnamefinal[$i]}}</a>
                            @endfor
                        @else
                            <a target="_blank" href="{{asset($thispost->upvideo)}}" class="btn btn-light wserver dwserver">{{$sitename}}</a>
                        @endif
                    </div>
                </div>
            @else
                <div class="no_data_div">
                    <p>Not valid</p>
                </div>
            @endif

        </div>
    </div>
</section>
@endsection
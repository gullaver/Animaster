@extends('layouts.app')

@section('title')
<title>{{$thispost->title}}</title>
@endsection

@section('content')
<section class="category_main">
<div class="cate_layer">
    <div class="container watchcontainer">
                @if(isset($thispost))
                    <div class="servers">
                        <div class="row">
                            @if(isset($watchserversnamefinal) && $watchserversnamefinal != '')
                                    @if($thispost->upvideo !='')
                                    <a data-class='<video id="my-player" class="video-js" controls preload="auto" onseeking="CallAction1();" onseeked="CallAction2();" data-setup="{}"><source src="{{asset($thispost->upvideo)}}" type="video/mp4"></source><source src="{{asset($thispost->upvideo)}}" type="video/webm"></source><source src="{{asset($thispost->upvideo)}}" type="video/ogg"></source><p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to aweb browser that</p></video>' href="#" class="btn btn-light wserver">{{$sitename}}</a>
                                    @endif
                                @for($i = 0; $i<$watchsercount; $i++)
                                    <a data-class="{{$watchserverscodefinal[$i]}}" href="#" class="btn btn-light wserver">{{$watchserversnamefinal[$i]}}</a>
                                @endfor
                            @else
                            <a data-class='<video id="my-player" class="video-js" controls preload="auto" onseeking="CallAction1();" onseeked="CallAction2();" data-setup="{}"><source src="{{asset($thispost->upvideo)}}" type="video/mp4"></source><source src="{{asset($thispost->upvideo)}}" type="video/webm"></source><source src="{{asset($thispost->upvideo)}}" type="video/ogg"></source><p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to aweb browser that</p></video>' href="#" class="btn btn-light wserver">{{$sitename}}</a>
                            @endif
                        </div>
                    </div>

                    <div class="view_vid">
                    @if($thispost->upvideo !='')

                    <video id="my-player" class="video-js" controls preload="auto" onseeking="CallAction1();" onseeked="CallAction2();" data-setup="{}"><source src="{{asset($thispost->upvideo)}}" type="video/mp4"></source><source src="{{asset($thispost->upvideo)}}" type="video/webm"></source><source src="{{asset($thispost->upvideo)}}" type="video/ogg"></source><p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to aweb browser that</p></video>
                    
                    @else
                        {!! $watchserverscodefinal[0] !!}
                    @endif
                    </div>

                    <div class="others_download">
                        <div class="row">
                            @if($thispost->downloadoption == 'Yes')
                                <div class="col-lg-3 col-md-3 col-9 downepi">
                                    <a href="/download/{{$thispost->id}}" class="btn btn-success">Download</a>
                                </div>
                                <div class="col-lg-2 col-md-2 col-3 downepi">
                                    <div class="access"><i class="fa fa-eye" aria-hidden="true"></i><small class="ml-2">{{$thispost->views == NULL ? 0 : $thispost->views}}</small></div>
                                </div>
                                <div class="col-lg-7 col-md-7 col-12 other_epi">
                                    <h6>Eepisodes List</h6>
                                    <div class="epis">
                                        @foreach($seriesposts as $seriespost)
                                            <a href="/watch/{{$seriespost->id}}" class="btn btn-sm btn-light">{{$seriespost->epn}}</a>
                                        @endforeach
                                    </div>
                                </div>
                                
                                <div class="col-12 tags p-2 mt-3">
                                <h5>Tags</h5>
                                <div>
                                    <?php
                                        $tags = explode(',', $thispost->tags);
                                        for($i=0; $i<count($tags); $i++)
                                        {
                                            echo '<span>'.$tags[$i].'</span>';
                                        }
                                    ?>
                                </div>
                                </div>
                            @else
                                <div class="col-lg-2 col-12 downepi">
                                    <div class="access"><i class="fa fa-eye" aria-hidden="true"></i><small class="ml-2">{{$thispost->views == NULL ? 0 : $thispost->views}}</small></div>
                                </div>
                                <div class="col-lg-10 col-12 other_epi">
                                    <h6>Eepisodes List</h6>
                                    <div class="epis">
                                        @foreach($seriesposts as $seriespost)
                                            <a href="/watch/{{$seriespost->id}}" class="btn btn-sm btn-light">{{$seriespost->epn}}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- Facebook Comments-->
                    <?php 
                        $facecom = App\Site::where('id', 1)->first();
                        if(isset($facecom->facebookcomments) && $facecom->facebookcomments == "Yes")
                        {
                            $facecode = explode("AniMasTER4g3t319edoc670a4g84AniMASTer", $facecom->facecomcode);
                    ?>
                        {!! $facecode[1] !!}
                    <?php
                        }
                    ?>                    
                    <!-- Site Comments -->
                    <?php
                    if(App\Site::where('id', 1)->first()->localcomments == "Yes")
                    {
                    ?>
                    <hr>
                    <div class="comments">
                        <h5>Comments</h5>
                        @if(session()->has('err_message'))
                                <div class="alert alert-danger adminSettingMsg col-12 mt-1" role="alert">
                                    {{session()->get('err_message')}}
                                </div>
                            @endif
                            @if(session()->has('success_message'))
                                <div class="alert alert-success adminSettingMsg col-12 mt-1" role="alert">
                                    {{session()->get('success_message')}}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger adminSettingMsg col-12 mt-1">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        @if(Auth::check() || $adminauth == 1)
                        @if(isset($blockedmember) && $blockedmember == 0)
                        <div class="new_comment pb-3">
                            @if(Auth::check())
                            <form action="/comment/{{Auth::user()->id}}/post/{{$thispost->id}}" method="POST">
                            @else
                            <form action="/comment/{{Auth::guard('admin')->id()}}/post/{{$thispost->id}}" method="POST">
                            @endif
                            @CSRF
                                <div class="form-group">
                                    <label for="enter_comment">Write a comment</label>
                                    <textarea class="form-control" id="enter_comment" rows="3" name="memcomment" placeholder="Write a comment"></textarea>
                                </div>
                                <button class="btn btn-sm btn-primary">Comment</button>
                            </form>
                        </div>
                        @else
                        <p>You have been blocked from commenting</p>
                        @endif
                        <div class="comment_box img-thumbnail">
                            @if($postcomments->count() == 0)
                            <div class="comm">
                                <div class="comm_text">
                                    <b>No Comments</b>
                                </div>
                            </div>
                            @else
                            @foreach($postcomments as $comment)
                            <div class="comm">
                                @if($comment->role == "admin")
                                <span><b>{{App\Admin::where('id', 1)->first()->name}}</b></span>
                                @else
                                <span><b>{{$comment->user->name}}</b></span>
                                @endif
                                <small>{{$comment->created_at}}</small>
                                <div class="comm_text img-thumbnail">
                                    <i>{{$comment->value}}</i>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        @else
                        Please <a href="/register" class="logreg">register</a> or <a class="logreg" href="/login">login</a> to write a comment

                        <div class="comment_box img-thumbnail">
                            @if($postcomments->count() == 0)
                            <div class="comm">
                                <div class="comm_text">
                                    <b>No Comments</b>
                                </div>
                            </div>
                            @else
                            @foreach($postcomments as $comment)
                            <div class="comm">
                                <span><b>{{$comment->user->name}}</b></span>
                                <small>{{$comment->created_at}}</small>
                                <div class="comm_text img-thumbnail">
                                    <i>{{$comment->value}}</i>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        @endguest
                    </div>
                    <?php
                    }
                    ?>

                @else
                    <div class="no_data_div">
                        <p>Not valid</p>
                    </div>
                @endif
        </div>
    </div>
    </div>
</section>
@endsection
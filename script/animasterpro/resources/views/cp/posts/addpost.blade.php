@extends('cp.layouts.admin')
@section('content')

<div class="col-lg-9 viewertbl_addpost">
    <div class="container">
        <div class="row p-3">
            <div class="locationtbl col-lg-12">
                @if(isset($requestedpost))
                    <p><a href="{{route('dashboard.index')}}">Dashboard</a> \ Edit post</p>
                @else
                    <p><a href="{{route('dashboard.index')}}">Dashboard</a> \ Add new post</p>
                @endif
            </div>

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
            <div class="card card-default bordcard">
                @if($cates->count() == 1 && $cates[0]->catename=="uncategorized")
                    <div class="catemsg" style="min-height: 100vh; min-width: 100%;">
                        <h5>There is no categories added yet</h5>
                        <a href="{{route('cp_categories.create')}}" class="btn btn-primary">Add category</a>
                    </div>
                @else
                <div class="card-header">
                    @if(isset($requestedpost))
                    <h1 class="card-title" style="font-weight: bold; font-size: 20px">Create new post</h1>
                    @else
                    <h1 class="card-title" style="font-weight: bold; font-size: 20px">Edit post</h1>
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body">   
                    @if(isset($requestedpost))
                    <form action="/cp_posts/{{$requestedpost->id}}" id="uploadForm" class="postcreate" method="POST" enctype="multipart/form-data">
                    {{method_field('PUT')}}
                    @else
                    <form action="{{route('cp_posts.store')}}" id="uploadForm" class="postcreate" method="POST" enctype="multipart/form-data">
                    {{method_field('POST')}}
                    @endif  
                    @csrf
                        <div class="row"> 
                            <!--            Subject          -->
                            <div class="form-group col-12 border pt-3 pb-3">
                                <h5>Subject</h5>
                                @if(isset($requestedpost))
                                <input type="text" value="{{$requestedpost->title}}" name="title" class="form-control" id="title" placeholder="Post subject">
                                @else
                                <input type="text" name="title" class="form-control" id="title" placeholder="Post subject">
                                @endif
                            </div>

                            <!--           Episode Number          -->
                            <div class="form-group col-12 border pt-3 pb-3">
                                <h5>Episode number</h5>
                                @if(isset($requestedpost))
                                <input type="number" value="{{$requestedpost->epn}}" name="epn" class="form-control" id="epn" placeholder="Episode number">
                                @else
                                <input type="number" name="epn" class="form-control" id="epn" placeholder="Episode number">
                                @endif
                            </div>

                            <!--            Is it a series          -->
                            <div class="form-group col-12 border pt-3 pb-3">
                                <h5>Is your post belongs to a series?</h5>
                                @if(isset($requestedpost) && $requestedpost->series_id != '')
                                <p><b>Current series:</b> {{$requestedpost->series->seriesname}}</p>
                                @elseif(isset($requestedpost) && $requestedpost->series_id == '')
                                <p><b>Current series:</b> No series</p>
                                @endif

                                <select id="selectvidtype" name="selectvidtype" class="form-control select2" style="width: 100%;">

                                    @if(isset($requestedpost) && $requestedpost->series_id != '')
                                        <option selected>Yes</option>
                                        <option>No</option>
                                    @elseif(isset($requestedpost) && $requestedpost->series_id == '')
                                        <option>Yes</option>
                                        <option selected>No</option>
                                    @else
                                        <option>Yes</option>
                                        <option selected>No</option>
                                    @endif

                                </select>
                            </div>
                                    <!--            Existing          -->   
                            <div class="form-group col-12 border pt-3 pb-3 existser">
                                <h6>Select series</h6>
                                <div class="existselect border">
                                    <select name="selectseries" id="selectseries" class="form-control">
                                    @if(isset($requestedpost) && $requestedpost->series_id != '')
                                            <option selected>{{$seriesName}}</option>
                                        @foreach($seriesList as $sera)
                                            @if($sera->seriesname != $seriesName)
                                            <option>{{$sera->seriesname}}</option>
                                            @endif
                                        @endforeach

                                    @elseif(isset($requestedpost) && $requestedpost->series_id == '')
                                        <option selected></option>
                                        @foreach($seriesList as $sera)
                                            <option>{{$sera->seriesname}}</option>
                                        @endforeach

                                    @elseif(isset($seriesList) && !isset($requestedpost))
                                        <option selected></option>
                                        @foreach($seriesList as $sera)
                                            <option>{{$sera->seriesname}}</option>
                                        @endforeach
                                    @endif
                                    </select>
                                </div>
                            </div>
                        
                            <!--            Video upload and servers          -->
                            <div class="form-group col-12 border pt-3 pb-3">
                                <h5>Video upload and host links</h5>
                                <h6>Upload on your server</h6>

                                @if(isset($requestedpost) && $requestedpost->upvideo !="")
                                <h6 class="mt-3">Uploaded video</h6>
                                <video
                                id="my-player"
                                class="video-js"
                                controls
                                preload="auto"
                                onseeking="CallAction1();"
                                 onseeked="CallAction2();"
                                data-setup='{}'>
                                <source src="{{asset($requestedpost->upvideo)}}" type="video/mp4"></source>
                                <source src="{{asset($requestedpost->upvideo)}}" type="video/webm"></source>
                                <source src="{{asset($requestedpost->upvideo)}}" type="video/ogg"></source>
                                <p class="vjs-no-js">
                                To view this video please enable JavaScript, and consider upgrading to a
                                web browser that
                                </p>
                                </video>
                                @endif

                                @if(isset($requestedpost) && $requestedpost->upvideo !="")
                                <div class="form-group border p-2 mt-3">
                                    <h6>Keep or remove old video</h6>
                                    <select class="form-control selectrmkvid col-12" id="selectrmkvid" name="selectrmkvid">
                                        <option selected value="yes">Keep this video</option>
                                        <option value="no">Remove it</option>
                                    </select>
                                </div>
                                @endif
                                
                                <div class="upload-video mt-4">
                                    @if(isset($requestedpost) && $requestedpost->upvideo !="")
                                        <h6>Update old video</h6>
                                    @endif
                                    <input type="file" name="postvidup"class="form-control-file" id="postvidup">
                                </div>

                                <div class="video-link mt-5">
                                    <h6>Remote host</h6>
                                    <div class="vid-url">
                                        <div class="vid-gather">
                                            @if(isset($requestedpost) && isset($watchserversnamefinal) && isset($watchsercount) && $watchsercount != 0)
                                                @for($i=0; $i < $watchsercount; $i++)
                                                    <div class="fullinput">
                                                        <div class="del_input">
                                                            <input type="text" value="{{$watchserversnamefinal[$i]}}" name="servername[]"class="form-control-file" id="postvidlink" placeholder="Server name">
                                                            <a class="btn btn-sm btn-primary rmvidlink"><i class="fas fa-minus text-white"></i></a>
                                                        </div>
                                                        <textarea name="vidcode[]" class="form-control" rows="5" id="comment" placeholder="code">{{$watchserverscodefinal[$i]}}</textarea>
                                                    </div>
                                                @endfor
                                            @elseif(isset($watchsercount) && $watchsercount == 0)

                                                <div class="fullinput">
                                                    <div class="del_input">
                                                            <input type="text"  name="servername[]"class="form-control-file" id="postvidlink" placeholder="Server name">
                                                        <a class="btn btn-sm btn-primary rmvidlink"><i class="fas fa-minus text-white"></i></a>
                                                    </div>
                                                    <textarea name="vidcode[]" class="form-control" rows="5" id="comment" placeholder="code"></textarea>
                                                </div>
                                            @else
                                                <div class="fullinput">
                                                    <div class="del_input">
                                                            <input type="text"  name="servername[]"class="form-control-file" id="postvidlink" placeholder="Server name">
                                                        <a class="btn btn-sm btn-primary rmvidlink"><i class="fas fa-minus text-white"></i></a>
                                                    </div>
                                                    <textarea name="vidcode[]" class="form-control" rows="5" id="comment" placeholder="code"></textarea>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                        <div class="options_del_add">
                                            <a class="btn btn-sm btn-primary addvidlink"><i class="fas fa-plus text-white"></i></a>
                                        </div>
                                    </div>
                            </div>
                            <!--            Download Choice          -->
                            <div class="form-group col-12 border pt-3 pb-3">
                                <h5>Download option</h5>
                                <p><i class="fas fa-exclamation-circle text-warning"></i> Determine whether you want to activate download option for visitor or no</p>
                                <select id="dwoption" name="dwoption" class="form-control select2" style="width: 100%;">
                                @if(isset($requestedpost) && $requestedpost->downloadoption == 'yes')
                                    <option selected>Yes</option>
                                    <option>No</option>
                                @elseif(isset($requestedpost) && $requestedpost->downloadoption == 'no')
                                    <option selected>No</option>
                                    <option>Yes</option>
                                @else
                                    <option selected>Yes</option>
                                    <option>No</option>
                                @endif
                                </select>
                            </div>
                            <!--            Download Links          -->           
                            <div class="form-group downlink-div col-12 border pt-3 pb-3">
                                <h5>Download link/s</h5>
                                <div class="vid-url mt-3">
                                    <div class="vid-gather-links">
                                    @if(isset($requestedpost) && isset($downserversnamefinal) && isset($downsercount) && $downsercount != 0)
                                        @for($i=0; $i < $downsercount; $i++)
                                            <div class="vid-fullinput">
                                                <div class="servname">
                                                    <input type="text" value="{{$downserversnamefinal[$i]}}" placeholder="Server name" class="form-control" name="servnameval[]">
                                                    <a class="btn btn-sm btn-primary rmvidlinkdw"><i class="fas fa-minus text-white"></i></a>
                                                </div>
                                                <div class="serlink">
                                                    <div class="icon-link"><i class="fas fa-link"></i></div>
                                                    <input type="text" value="{{$downserverslinkfinal[$i]}}" name="postvidlinkdwname[]" class="form-control-file" id="postvidlinkdw" placeholder="Download link">
                                                </div>
                                            </div>
                                        @endfor
                                    @elseif(isset($downsercount) && $downsercount == 0)
                                        <div class="vid-fullinput">
                                            <div class="servname">
                                                <input type="text" placeholder="Server name" class="form-control" name="servnameval[]">
                                                <a class="btn btn-sm btn-primary rmvidlinkdw"><i class="fas fa-minus text-white"></i></a>
                                            </div>
                                            <div class="serlink">
                                                <div class="icon-link"><i class="fas fa-link"></i></div>
                                                <input type="text" name="postvidlinkdwname[]" class="form-control-file" id="postvidlinkdw" placeholder="Download link">
                                            </div>
                                        </div>
                                    @else
                                        <div class="vid-fullinput">
                                            <div class="servname">
                                                <input type="text" placeholder="Server name" class="form-control" name="servnameval[]">
                                                <a class="btn btn-sm btn-primary rmvidlinkdw"><i class="fas fa-minus text-white"></i></a>
                                            </div>
                                            <div class="serlink">
                                                <div class="icon-link"><i class="fas fa-link"></i></div>
                                                <input type="text" name="postvidlinkdwname[]" class="form-control-file" id="postvidlinkdw" placeholder="Download link">
                                            </div>
                                        </div>
                                    @endif
                                    </div>
                                </div>
                                <a class="btn btn-sm btn-primary addvidlinkdw"><i class="fas fa-plus text-white"></i></a>
                                </div>
                            </div>

                            <!--            Upload Image          --> 
                            <div class="form-group col-12 border pt-3 pb-3">
                                <h5>Post image</h5>
                                @if(isset($requestedpost))
                                <h6>Current post image</h6>
                                    <img class="img-thumbnail img-fluid mb-4" src="{{asset($requestedpost->image)}}" alt="">
                                @endif
                                <div class="choose_img">
                                    <button id="choose_img-btn-1" data-class="upload-image" type="button" class="btn btn-primary">Upload</button>
                                    <button id="choose_img-btn-2" data-class="image-link" type="button" class="btn btn-primary">Insert an URL</button>
                                </div>

                                <div class="img_targets mt-4">

                                    <div class="upload-image">
                                        <h6>Upload Image</h6>
                                        <input type="file" name="postimgup"class="form-control-file" id="postimgup"> <!--later later-->
                                    </div>

                                    <div class="image-link">
                                        <h6>Image URL</h6>
                                        <div class="img-url border">
                                            <div class="icon-link"><i class="fas fa-link"></i></div>
                                            @if(isset($requestedpost) && $requestedpost->image_src != "native")
                                                 <input type="url" value="{{$requestedpost->image}}" name="postimglink"class="form-control-file" id="postimglink" style="display:block;">
                                            @else
                                                <input type="url" name="postimglink"class="form-control-file" id="postimglink">
                                            @endif
                                            
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                            <!--            Content          --> 
                            <div class="form-group content col-12 border pt-3 pb-3">
                                <h5 class="mb-3">Content <span class='text-muted'> (Optional)</span></h5>
                                @if(isset($requestedpost) && $requestedpost->content != '')
                                <textarea name="postcontent" class="textarea form-control postcontent" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" id="postcontent">
                                        {{$requestedpost->content}}
                                </textarea>
                                @else
                                <textarea name="postcontent" class="textarea form-control postcontent" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" id="postcontent">
                                        
                                </textarea>
                                @endif

                            </div>
                            <!--            Tags          --> 
                            <div class="form-group col-12 border posttagsdiv pt-3 pb-3">
                                <h5>Tags <span class='text-muted'> (Optional but recommended)</span></h5>
                                @if(isset($requestedpost) && $requestedpost->tags != '')
                                     <input name="posttags" value="{{$requestedpost->tags}}" id="posttags" class="form-control posttags" type="text" data-role="tagsinput">
                                @else
                                    <input name="posttags" id="posttags" class="form-control posttags" type="text" data-role="tagsinput">
                                @endif
                                
                            </div>

                            <!--            Categories          -->        
                            <div class="form-group border catesub col-12">

                                <div class="form-group">
                                    <h5>Category</h5>
                                    @if(isset($requestedpost) && $requestedpost->category_id != '')
                                    <p><b>Current category:</b> {{$requestedpost->category->catename}}</p>
                                    @elseif(isset($requestedpost) && $requestedpost->category_id == '')
                                    <p><b>Current category:</b> No category</p>
                                    @endif
                                    <select id="catelist" name="catelist" class="form-control select2 catelist" style="width: 100%;">
                                        @foreach($cates as $cate)
                                            @if($cate->catename != "uncategorized")
                                                <option>{{$cate->catename}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                            </div>


                            <!--            Submit          --> 
                            @if(isset($requestedpost))
                            <div class="form-group sunmitdiv col-12">
                                <button type="submit" class="btn btn-success subton">Apply</button>
                            </div>
                            @else
                            <div class="form-group sunmitdiv col-12">
                                <button type="submit" class="btn btn-success subton">Create</button>
                            </div>
                             @endif


                        </div>
                        <!-- /.row -->
                    </form>
                </div>
                <!-- /.card-body -->
                @endif
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection
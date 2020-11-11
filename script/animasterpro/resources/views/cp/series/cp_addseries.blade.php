@extends('cp.layouts.admin')
@section('content')

<div class="col-lg-9 viewertbl">
  <div class="container">
      <div class="row p-3">
          <div class="locationtbl col-lg-12">
              <p><a href="{{route('dashboard.index')}}">Dashboard</a> \ Add new series</p>
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
          @if($cates->count() == 1 && $cates[0]->catename=="uncategorized")
              <div class="catemsg" style="min-height: 100vh; min-width: 100%;">
                  <h5>There is no categories added yet</h5>
                  <a href="{{route('cp_categories.create')}}" class="btn btn-primary">Add category</a>
              </div>
            @else
          @if(isset($certainSer))
            <h3 class="card-title">Edit series</h3>
          @else
            <h3 class="card-title">Add new series</h3>
          @endif

          @if(isset($certainSer))
            <form role="form" class="mainform img-thumbnail mt-2 p-3 bordcard" action="/cp_series/{{$certainSer->id}}" method="post" enctype="multipart/form-data">
            {{method_field('PUT')}}
          @else
            <form role="form" class="mainform img-thumbnail mt-2 p-3 bordcard" action="{{route('cp_series.store')}}" method="post" enctype="multipart/form-data">
          @endif
            @csrf
          <!--            Series Name          --> 
            <div class="form-group">
                <label for="seriesname">Series name</label>
                @if(isset($certainSer))
                  <input type="text" class="form-control" id="seriesname" name="seriesname" placeholder="Enter series name" value="{{$certainSer->seriesname}}">
                @else
                  <input type="text" class="form-control" id="seriesname" name="seriesname" placeholder="Enter series name">
                @endif
            </div>
            <!--            Select Category          --> 
            @if(isset($certainSer))
            <div class="form-group">
                <p>Current categtogry: {{$certainSer->category->catename}}</p>
                <label for="catelist" class="required">Category</label>
                <select id="catelist" name="catelist" class="form-control select2 catelist" style="width: 100%;">
                    @foreach($cates as $cate)
                      @if($cate->catename != "uncategorized")
                          <option>{{$cate->catename}}</option>
                      @endif
                    @endforeach
                </select>
            </div>

            @else
            <div class="form-group">
                <label for="catelist" class="required">Category</label>
                <select id="catelist" name="catelist" class="form-control select2 catelist" style="width: 100%;">
                    @foreach($cates as $cate)
                        @if($cate->catename != "uncategorized")
                          <option>{{$cate->catename}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            @endif

            <!--            Upload Image          --> 
            <div class="form-group col-12 border pt-3 pb-3">
                <h5>Series image</h5>
                <i class="fas fa-exclamation-circle text-warning"></i><span class='text-muted ml-1'>Recommended size: 2000 x 600</span>
                @if(isset($certainSer))
                <h6 class="mt-4">Current Series image</h6>
                    <img class="img-thumbnail img-fluid mb-4" src="{{asset($certainSer->image)}}" alt="">
                @endif
                <div class="choose_img mt-2">
                    <button id="choose_img-btn-1" data-class="upload-image" type="button" class="btn btn-primary">Upload</button>
                    <button id="choose_img-btn-2" data-class="image-link" type="button" class="btn btn-primary">Insert an URL</button>
                </div>

                <div class="img_targets mt-4">

                    <div class="upload-image">
                        <h6>Upload Image</h6>
                        <input type="file" name="postimgup"class="form-control-file" id="postimgup">
                    </div>

                    <div class="image-link">
                        <h6>Image URL</h6>
                        <div class="img-url border">
                            <div class="icon-link"><i class="fas fa-link"></i></div>
                            @if(isset($certainSer) && $certainSer->image_src != "native")
                                  <input type="url" value="{{$certainSer->image}}" name="postimglink"class="form-control-file" id="postimglink" style="display:block;">
                            @else
                                <input type="url" name="postimglink"class="form-control-file" id="postimglink">
                            @endif
                            
                        </div>
                    </div>
                
                </div>
            </div>    
       
            <div class="form-group">
                <label for="content">Series desription <span class='text-muted'> (Optional)</span></label>

                @if(isset($certainSer))

                <textarea class="form-control" name="sercontent" id="sercontent" rows="3" placeholder="Enter series descrioption">{{$certainSer->content}}</textarea>

                @else

                <textarea class="form-control" name="sercontent" id="sercontent" rows="3" placeholder="Enter series descrioption"></textarea>

                @endif
            </div>

            

            @if(isset($certainSer))

              <button type="submit" class="btn btn-primary subton">Edit</button>

            @else

              <button type="submit" class="btn btn-primary subton">Add</button>

            @endif
            @endif
            </form>
        </div>
    </div>
</div>
@endsection
        
@extends('cp.layouts.admin')
@section('content')
<div class="col-lg-9 viewertbl">
  <div class="container">
      <div class="row p-3">
          <div class="locationtbl col-lg-12">
              <p><a href="{{route('dashboard.index')}}">Dashboard</a> \ View comment</p>
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
        <a href="/cp_comment/{{$certaincom->id}}/del" class="btn btn-danger mb-2 mt-2">Delete this comment</a>
        <form role="form" class="col-12 p-3 img-thumbnail">
            

            <div class="form-group">
                <label for="comid">ID</label>
                <input type="text" class="form-control" id="comid" name="comid" value="{{$certaincom->id}}" readonly>
            </div>

            <div class="form-group">
                <label for="postid">Post ID</label>
                <input type="text" class="form-control" id="postID" name="postid" value="{{$certaincom->post_id}}" readonly>
            </div>

            <div class="form-group">
                <label for="posttitle">Post title</label>
                <input type="text" class="form-control" id="posttitle" name="posttitle" value="{{$certaincom->post->title}}" readonly>
            </div>

            <div class="form-group">
                <label for="userid">User ID</label>
                <input type="text" class="form-control" id="userid" name="userid" value="{{$certaincom->user_id}}" readonly>
            </div>
            @if($certaincom->role == "admin")
            <div class="form-group">
                <label for="username">User name</label>
                <input type="text" class="form-control" id="username" name="username" value="{{App\Admin::where('id', 1)->first()->name}}" readonly>
            </div>
            @else
            <div class="form-group">
                <label for="username">User name</label>
                <input type="text" class="form-control" id="username" name="username" value="{{$certaincom->user->name}}" readonly>
            </div>
            @endif

            <div class="form-group">
                <label for="comdate">Creation date</label>
                <input type="text" class="form-control" id="comdate" name="comdate" value="{{$certaincom->created_at}}" readonly>
            </div>

            <div class="form-group">
                <label for="comm">Comment</label>
                <textarea class="form-control" id="comm" rows="3" readonly>{{$certaincom->value}}</textarea>
            </div>

        </div>
    </div>
</div>
@endsection
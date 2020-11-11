@extends('cp.layouts.admin')
@section('content')
<div class="col-lg-9 viewertbl">
  <div class="container">
    <div class="row p-3">
      <div class="locationtbl col-lg-12">
        <p><a href="{{route('dashboard.index')}}">Dashboard</a> \ Posts</p>
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
      <div>
          <a href="{{route('cp_posts.create')}}" class="btn btn-md btn-primary">Add new post</a>
      </div>
      <div class="view-table img-thumbnail" id="view-table">
        <table class="table" id="tableeeee">
          <thead>
            <tr class="firsttr">
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Series</th>
                <th>View count</th>
                <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php $i = $posts->perPage() * ($posts->currentPage() - 1); ?>
          @foreach($posts as $key => $post)
          <tr>
            <td>{{$i++ + 1}}</td>
            <td>{{$post->title}}</td>
            <td>{{$post->category->catename}}</td>
            @if(empty($post->Series))
            <td>-</td>
            @else
            <td>{{$post->Series->seriesname}}</td>
            @endif
            <td>{{rand(300,7500)}}</td>

            <td>
            <div class="row postactions">
                <a href="/watch/{{$post->id}}" target="_blank"><i class="fas fa-eye"></i></i></a>
                <a href="/cp_posts/{{$post->id}}/edit"><i class="far fa-edit text-primary"></i></a>
                <a data-class="/cp_posts/{{$post->id}}/del" class="post_delete"><i class="fas fa-trash-alt text-danger"></i></a>
              </div>
            </td>
            
          </tr>
          @endforeach
          </tbody>
        </table>
        @if(isset($emptypost))
            <p class="noPosts">No posts added yet</p>
        @endif
      </div>
      <div>
          {{$posts->links()}}
      </div>

    </div>
  </div>
</div>
@endsection
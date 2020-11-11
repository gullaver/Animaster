@extends('cp.layouts.admin')
@section('content')
<div class="col-lg-9 viewertbl">
  <div class="container">
    <div class="row p-3">
      <div class="locationtbl col-lg-12">
        <p><a href="{{route('dashboard.index')}}">Dashboard</a> \ Manage Comments</p>
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
        <div class="upper_mem_div mt-3">
            <div class="member_search mx-auto">
                <form action="" method="post">
                @method('post')
                @CSRF
                    <label for="searchopt">Search by</label>

                    <select name="comsearchopt" id="comsearchopt" class= "form-control">
                        <option value="value">Comment</option>
                        <option value="post_id">Post ID</option>
                        <option value="user_id">Member ID</option>
                    </select>

                    <input class="form-control" type="text" name="comsearchinput" id="comsearchinput" value=''>
                    <button class="btn btn-primary comsearch">Search</button>
                </form>
            </div>
        </div>
      </div>
      <div class="view-table img-thumbnail" id="view-table">
        <table class="table">
          <thead>
            <tr class="firsttr">
              <th class="border">#</th>
              <th class="border">Post title</th>
              <th class="border">Post ID</th>
              <th class="border">Member name</th>
              <th class="border">Member ID</th>
              <th class="border">Actions</th>
            </tr>
          </thead>
            <tbody class="memberList" id="memberList">
              <?php $i = $comments->perPage() * ($comments->currentPage() - 1); ?>
                  @foreach($comments as $key => $comment)
                  <tr>
                    <td>{{$i++ + 1}}</td>
                    <td>{{$comment->post->title}}</td>
                    <td>{{$comment->post->id}}</td>
                    @if($comment->role == "admin")
                    <td>{{App\Admin::where('id', 1)->first()->name}}</td>
                    @else
                    <td>{{$comment->user->name}}</td>
                    @endif
                    <td>{{$comment->user->id}}</td>
                    <td class="actionscss">
                      <div class="row catetable">
                        <a href="/cp_comment/{{$comment->id}}/show"><i class="fas fa-eye"></i></i></a>
                        <a href="/cp_comment/{{$comment->id}}/del"><i class="fas fa-trash-alt text-danger"></i></a>
                      </div>
                    </td>
                  </tr>
                  @endforeach
            </tbody>
        </table>        
        @if(isset($emptycom))
            <p class="noCates" id="noCates">No comments till the moment</p>
        @endif
      </div>
      <div class="card-footer clearfix">
          {{$comments->links()}}
      </div>
    </div>
  </div>
</div>
@endsection
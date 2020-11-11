@extends('cp.layouts.admin')
@section('content')

<div class="col-lg-9 viewertbl">
  <div class="container">
      <div class="row p-3">
          <div class="locationtbl col-lg-12">
              <p><a href="{{route('dashboard.index')}}">Dashboard</a> \ Add new post</p>
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

          @if(isset($certainCate))
            <h3 class="card-title">Edit category</h3>
          @else
            <h3 class="card-title">Add new category</h3>
          @endif

          @if(isset($certainCate))
            <form role="form" class="mainform img-thumbnail mt-2 p-3" action="/cp_categories/{{$certainCate->id}}" method="post">
            {{method_field('PUT')}}
          @else
            <form role="form" class="mainform img-thumbnail mt-2 p-3" action="{{route('cp_categories.store')}}" method="post">
          @endif
            @csrf

            <div class="form-group">
                <label for="catename">Category name</label>
                @if(isset($certainCate))
                  <input type="text" class="form-control" id="catename" name="catename" placeholder="Enter categorey name" value="{{$certainCate->catename}}">
                @else
                  <input type="text" class="form-control" id="catename" name="catename" placeholder="Enter categorey name">
                @endif
            </div>
                           
            <div class="form-group">
                <label for="catedesc">Category desription <span class='text-muted'> (Optional)</span></label>

                @if(isset($certainCate))

                <textarea class="form-control" name="catedesc" id="catedesc" rows="3" placeholder="Enter category descrioption">{{$certainCate->catedesc}}</textarea>

                @else

                <textarea class="form-control" name="catedesc" id="catedesc" rows="3" placeholder="Enter category descrioption"></textarea>

                @endif
            </div>

            @if(isset($certainCate))

              <button type="submit" class="btn btn-primary subton">Edit</button>

            @else

              <button type="submit" class="btn btn-primary subton">Add</button>

            @endif

            </form>
        </div>
    </div>
</div>
@endsection
        
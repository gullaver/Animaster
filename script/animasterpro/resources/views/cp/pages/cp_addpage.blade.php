@extends('cp.layouts.admin')
@section('content')

<div class="col-lg-9 viewertbl">
  <div class="container">
      <div class="row p-3">
          <div class="locationtbl col-lg-12">
              <p><a href="{{route('dashboard.index')}}">Dashboard</a> \ Add new page</p>
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

          @if(isset($certainPage))
            <h3 class="card-title">Edit Page</h3>
          @else
            <h3 class="card-title">Add new Page</h3>
          @endif

          @if(isset($certainPage))
            <form role="form" class="mainform img-thumbnail mt-2 p-3" action="/cp_pages/{{$certainPage->id}}" method="post">
            {{method_field('PUT')}}
          @else
            <form role="form" class="mainform img-thumbnail mt-2 p-3" action="{{route('cp_pages.store')}}" method="post">
          @endif
            @csrf

            <div class="form-group">
                <label for="pagenameid">Page title</label>
                @if(isset($certainPage))
                  <input type="text" class="form-control" id="pagenameid" name="pagename" placeholder="Enter page title" value="{{$certainPage->pagename}}">
                @else
                  <input type="text" class="form-control" id="pagenameid" name="pagename" placeholder="Enter page title">
                @endif
            </div>
                           
            <div class="form-group">
                <label for="pagecontentid">Page content</label>

                @if(isset($certainPage))

                <textarea class="form-control pagecontent" name="pagecontent" id="pagecontentid" rows="3" placeholder="Enter page content">{{$certainPage->pagecontent}}</textarea>

                @else

                <textarea class="form-control pagecontent" name="pagecontent" id="pagecontentid" rows="3" placeholder="Enter category content"></textarea>

                @endif
            </div>

            @if(isset($certainPage))

              <button type="submit" class="btn btn-primary subton">Edit</button>

            @else

              <button type="submit" class="btn btn-primary subton">Add</button>

            @endif

            </form>
        </div>
    </div>
</div>
@endsection
        
@extends('cp.layouts.admin')
@section('content')
<div class="col-lg-9 viewertbl">
  <div class="container">
    <div class="row p-3">
      <div class="locationtbl col-lg-12">
        <p><a href="{{route('dashboard.index')}}">Dashboard</a> \ Series</p>
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
          <a href="{{route('cp_series.create')}}" class="btn btn-md btn-primary">Add new Series</a>
      </div>
      <div class="view-table img-thumbnail">
        <table class="table">
          <thead>
            <tr class="firsttr">
              <th>#</th>
              <th>Name</th>
              <th>Category</th>
              <th>Number of posts</th>
              <th>creation date</th>
              <th>Actions</th>
            </tr>
          </thead>
            <tbody>
            @if(isset($serList))
            <?php $i = $serList->perPage() * ($serList->currentPage() - 1); ?>
                  @foreach($serList as $key => $ser)
                  <tr>
                    <td>{{$i++ + 1}}</td>
                    <td>{{$ser->seriesname}}</td>
                    <td>{{$ser->category->catename}}</td>
                    <td>{{$ser->posts->count()}}</td>
                    <td>{{$ser->created_at}}</td>
                    <td class="actionscss">
                      <div class="row catetable">
                        <a href="/cp_series/{{$ser->id}}/edit"><i class="far fa-edit text-primary"></i></a><a href="" data-class="cp_series/{{$ser->id}}/del" class="del-series"><i class="fas fa-trash-alt text-danger"></i></a>
                      </div>
                    </td>
                  </tr>
              @endforeach
            @endif
            </tbody>
        </table>        
        @if(isset($emptyser))
            <p class="noCates">No series added yet</p>
        @endif
      </div>
      <div class="card-footer clearfix">
      @if(isset($serList))
        {{$serList->links()}}
      @endif
      </div>
    </div>
  </div>
</div>
@endsection
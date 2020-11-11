@extends('cp.layouts.admin')
@section('content')
<div class="col-lg-9 viewertbl">
  <div class="container">
    <div class="row p-3">
      <div class="locationtbl col-lg-12">
        <p><a href="{{route('dashboard.index')}}">Dashboard</a> \ Categories</p>
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
          <a href="{{route('cp_categories.create')}}" class="btn btn-md btn-primary">Add new category</a>
      </div>
      <div class="view-table img-thumbnail">
        <table class="table">
          <thead>
            <tr class="firsttr">
              <th>#</th>
              <th>Name</th>
              <th>Number of posts</th>
              <th>Number of serieses</th>
              <th>Actions</th>
            </tr>
          </thead>
            <tbody>
            <?php $i = $catesList->perPage() * ($catesList->currentPage() - 1); ?>
                @foreach($catesList as $key => $cate)
                <tr>
                  <td>{{$i++ + 1}}</td>
                    <td>{{$cate->catename}}</td>
                    <td>{{$cate->posts->count()}}</td>
                    <td>{{$cate->serieses->count()}}</td>
                    <td class="actionscss">
                      <div class="row catetable">
                      @if($cate->catename == "uncategorized")
                        <a href="" data-class="cp_categories/{{$cate->id}}/del" class="del-category col-12"><i class="fas fa-trash-alt text-danger"></i></a>
                      @else
                        <a href="/cp_categories/{{$cate->id}}/edit"><i class="far fa-edit text-primary"></i></a><a href="" data-class="cp_categories/{{$cate->id}}/del" class="del-category"><i class="fas fa-trash-alt text-danger"></i></a>
                      @endif
                      </div>
                    </td>
                  </tr>
              @endforeach
            </tbody>
        </table>        
        @if(isset($emptycate))
            <p class="noCates">No categories added yet</p>
        @endif
      </div>
      <div class="card-footer clearfix">
          {{$catesList->links()}}
      </div>
    </div>
  </div>
</div>
@endsection
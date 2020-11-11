@extends('cp.layouts.admin')
@section('content')
<div class="col-lg-9 viewertbl">
  <div class="container">
    <div class="row p-3">
      <div class="locationtbl col-lg-12">
        <p><a href="{{route('dashboard.index')}}">Dashboard</a> \ Pages</p>
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
          <a href="{{route('cp_pages.create')}}" class="btn btn-md btn-primary">Add new page</a>
      </div>


   @if(isset($allpages) && $allpages->count() > 0)
   <div class="col-12 img-thumbnail mt-4 mb-4 p-2">

    <div class="alert alert-success" id="pageordersuccess" role="alert"></div>

      <label><b>Pages view arrangement</b></label>
      <ul id="list-1" class="sortable pagessortlist">
      @foreach($allpages as $page)
        <li class="border draggable" id="item-1">{{$page->pagename}}</li>
      @endforeach
      </ul>
      <a id="savepagearrange" class="btn btn-primary" style="color: #fff">Save</a>
   </div>
   @endif
   
  
      <div class="view-table img-thumbnail">
        <table class="table">
          <thead>
            <tr class="firsttr">
              <th class="border">#</th>
              <th class="border">Title</th>
              <th class="border">Actions</th>
            </tr>
          </thead>
            <tbody>
            <?php $i = $pageList->perPage() * ($pageList->currentPage() - 1); ?>
            @if(isset($pageList) && $pageList->count() > 0)
            @foreach($pageList as $key => $pg)
              <tr>
                <td>{{$i++ + 1}}</td>
                <td class="border">{{$pg->pagename}}</td>
                <td class="actionscss">
                  <div class="row catetable">
                    <a href="/page/{{$pg->pagename}}" target="_blank"><i class="fas fa-eye"></i></a>
                    <a href="/cp_pages/{{$pg->id}}/edit"><i class="far fa-edit text-primary"></i></a>
                    <a data-class="/cp_pages/{{$pg->id}}/del" class="page_delete"><i class="fas fa-trash-alt text-danger"></i></a>
                  </div>
                </td>
              </tr>
              @endforeach
              @endif
            </tbody>
        </table>        
        @if(isset($emptypage))
            <p class="noCates">No pages added yet</p>
        @endif
      </div>
      <div class="card-footer clearfix">
          {{$pageList->links()}}
      </div>
    </div>
  </div>
</div>
@endsection
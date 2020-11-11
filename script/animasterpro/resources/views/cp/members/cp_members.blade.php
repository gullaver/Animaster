@extends('cp.layouts.admin')
@section('content')
<div class="col-lg-9 viewertbl">
  <div class="container">
    <div class="row p-3">
      <div class="locationtbl col-lg-12">
        <p><a href="{{route('dashboard.index')}}">Dashboard</a> \ Members List</p>
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
      <div class="row w-100">
        <a href="{{route('cp_managemem.create')}}" class="btn btn-md btn-primary col-3">Add new member</a>
        <a id="showblkmem" class="btn btn-md btn-primary showblkmem col-3 ml-4" style="color: #fff; cursor:pointer;">Show blocked members only</a>
      </div>

        <div class="upper_mem_div mt-3">
            <div class="member_search mx-auto">
                <form action="" method="post">
                @CSRF
                    <label for="searchopt">Search by</label>

                    <select name="searchopt" id="searchopt" class= "form-control">
                        <option value="email">Email</option>
                        <option value="name">Name</option>
                        <option value="id">ID</option>
                    </select>

                    <input class="form-control" type="text" name="memsearchinput" id="memsearchinput" value=''>
                    <button class="btn btn-primary memsearch">Search</button>
                </form>
            </div>
        </div>
      </div>
      <div class="view-table img-thumbnail" id="view-table">
        <table class="table">
          <thead>
            <tr class="firsttr">
              <th class="border">#</th>
              <th class="border">Name</th>
              <th class="border">Email</th>
              <th class="border">Status</th>
              <th class="border">Actions</th>
            </tr>
          </thead>
            <tbody class="memberList" id="memberList">
            <?php $i = $members->perPage() * ($members->currentPage() - 1); ?>
                  @foreach($members as $key => $member)
                  <tr>
                    <td>{{$i++ + 1}}</td>
                    <td>{{$member->name}}</td>
                    <td>{{$member->email}}</td>
                    <td>{{$member->block ? 'Blocked' : 'Normal'}}</td>
                    <td class="actionscss">
                      <div class="row catetable">
                        <a href="/cp_managemem/{{$member->id}}/edit"><i class="far fa-edit text-primary"></i></a>
                        <a href="/cp_managemem/{{$member->id}}/del"><i class="fas fa-trash-alt text-danger"></i></a>
                      </div>
                    </td>
                  </tr>
                  @endforeach
            </tbody>
        </table>        
        @if(isset($emptymem))
            <p class="noCates" id="noCates">No Members till the moment</p>
        @endif
      </div>
      <div class="card-footer clearfix">
          {{$members->links()}}
      </div>
    </div>
  </div>
</div>
@endsection
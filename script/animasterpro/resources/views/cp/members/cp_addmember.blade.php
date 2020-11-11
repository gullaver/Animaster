@extends('cp.layouts.admin')
@section('content')

<div class="col-lg-9 viewertbl">
  <div class="container">
      <div class="row p-3">
          <div class="locationtbl col-lg-12">

          @if(isset($certainMem))
          <p><a href="{{route('dashboard.index')}}">Dashboard</a> \ Update member's information</p>
          @else
          <p><a href="{{route('dashboard.index')}}">Dashboard</a> \ Add new member</p>
          @endif

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

          @if(isset($certainMem))
            <h3 class="card-title">Update member's information</h3>
          @else
            <h3 class="card-title">Add new Member</h3>
          @endif

          @if(isset($certainMem))
            <form role="form" class="mainform img-thumbnail mt-2 p-3" action="/cp_managemem/{{$certainMem->id}}" method="post">
            {{method_field('PUT')}}
          @else
            <form role="form" class="mainform img-thumbnail mt-2 p-3" action="{{route('cp_managemem.store')}}" method="post">
          @endif
            @csrf
            <div class="form-group">
                <label for="memnameid">Name</label>
                @if(isset($certainMem))
                  <input type="text" class="form-control" id="memnameid" name="memname" placeholder="Enter member name" value="{{$certainMem->name}}">
                @else
                  <input type="text" class="form-control" id="memnameid" name="memname" placeholder="Enter member name">
                @endif
            </div>

            <div class="form-group">
                <label for="mememailid">Email</label>
                @if(isset($certainMem))
                  <input type="email" class="form-control" id="mememailid" name="email" placeholder="Enter member email" value="{{$certainMem->email}}">
                @else
                  <input type="email" class="form-control" id="mememailid" name="email" placeholder="Enter member email">
                @endif
            </div>

            @if(isset($certainMem))
            <div class="form-group">
                <label for="mempassid">Update password</label>
                <input type="password" class="form-control" id="mempassid" name="mempass" placeholder="Enter new password">
            </div>
            @else
            <div class="form-group">
                <label for="mempassid">Password</label>
                <input type="password" class="form-control" id="mempassid" name="mempass" placeholder="Enter new password">
            </div>
            @endif

            @if(isset($certainMem) && $certainMem->block !='')     
              <div class="blockshow mb-3 border">
                <p>This member is blocked from commenting and messaging untill <strong><?php echo $formatted = date("D d/m/Y H:i:s", $certainMem->block/1000); ?></strong></p>
                <a href="/cp_managemem_unblock/{{$certainMem->id}}" id="unblock" class="btn btn-danger unblock">Unblock this member</a>
              </div>
            @endif
            @if(isset($certainMem))
            <div class="form-group row">

              <div class="blockchoser border w-100 p-3">
              <h6>Block this member from commenting and sending messages</h6>
              <div class="exc row mb-3">
                <i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i>
                <h6 class="ml-2 text-muted">Use "Block by IP" property for more effectivness in blocking messages</h6>
              </div>
                <div class="row">
                    <a class="btn btn-danger blockipdatafieldbtn">Block this member by IP</a>
                </div>
              </div>

              <div class="blockdatabyipdiv">
              <input type="number" name="blockipdatafield" class="form-control blockipdatafield" placeholder="Enter period by days">
              </div>


            </div>
            @endif

          


            @if(isset($certainMem))

              <button type="submit" class="mt-4 btn btn-primary subton">Update</button>

            @else

              <button type="submit" class="mt-4 btn btn-primary subton">Add</button>

            @endif

            </form>
        </div>
    </div>
</div>
@endsection
        
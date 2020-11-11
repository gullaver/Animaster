@extends('cp.layouts.admin')
@section('content')
<div class="col-lg-9 viewertbl">
  <div class="container">
    <div class="row p-3">
      <div class="locationtbl col-lg-12">
        <p><a href="{{route('dashboard.index')}}">Dashboard</a> \ All Messages</p>
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
      @if(isset($newmsgnotice))
          <a href="{{route('message.show')}}" class="btn btn-md btn-primary">Show all Messages</a>
      @else
          <a href="{{route('newMessage.show')}}" class="btn btn-md btn-primary">Show new messages only</a>
      @endif
      </div>
      <div class="view-table img-thumbnail">
        <table class="table">
          <thead>
            <tr class="firsttr">
              <th>#</th>
              <th>From</th>
              <th>Actions</th>
            </tr>
          </thead>
            <tbody>
            <?php $i = $msgs->perPage() * ($msgs->currentPage() - 1); ?>
                  @foreach($msgs as $key => $msg)
                  <tr>
                    <td>{{$i++ + 1}}</td>
                    @if($msg->status == "unread")
                      <td><b>{{$msg->name}}</b></td>
                    @else
                      <td>{{$msg->name}}</td>
                    @endif
                    <td class="actionscss">
                      <div class="row catetable">
                        <a href="cp_messages/{{$msg->id}}"><i class="fas fa-eye"></i></i></a>
                        <a href="cp_messages/{{$msg->id}}/del"><i class="fas fa-trash-alt text-danger"></i></a>
                      </div>
                    </td>
                  </tr>
              @endforeach
            </tbody>
        </table>        
        @if(isset($emptymsg))
            <p class="noCates">No Messages</p>
        @endif
      </div>
      <div class="card-footer clearfix">
          {{$msgs->links()}}
      </div>
    </div>
  </div>
</div>
@endsection
@extends('cp.layouts.admin')
@section('content')

<div class="col-lg-9 viewertbl">
  <div class="container">
      <div class="row p-3">
          <div class="locationtbl col-lg-12">
              <p><a href="{{route('dashboard.index')}}">Dashboard</a> \ View message</p>
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

            <form role="form" class="col-12 p-3 img-thumbnail" action="/replymail/{{$specmsg->email}}" method="post">
            @csrf
          <!--            Sender name          --> 
          <div class="under_form">
            <div class="form-group">
                <label for="seriesname">Sender name</label>
                  <input type="text" class="form-control" id="seriesname" name="seriesname" placeholder="Enter series name" value="{{$specmsg->name}}" readonly>
            </div>
            <!--            Sender name          --> 
            <div class="form-group">
                <label for="seriesname">Sender email</label>
                  <input type="text" class="form-control" id="seriesname" name="seriesname" placeholder="Enter series name" value="{{$specmsg->email}}" readonly>
            </div>

            <!--            Message          --> 
            <div class="form-group">
                <label for="sendermsg">Message</label>
                <textarea class="form-control" id="sendermsg" rows="3" readonly>{{$specmsg->message}}</textarea>
            </div>

            <button type="submit" id="replymessage" class="btn btn-primary">Send a message to his email</button>
            </div>
            </form>

        </div>
    </div>
</div>
@endsection
        
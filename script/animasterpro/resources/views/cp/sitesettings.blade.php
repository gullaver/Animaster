@extends('cp.layouts.admin')
@section('content')

<div class="col-lg-9 viewertbl">
    <div class="container">
        <div class="row p-3">
          <div class="locationtbl col-lg-12">
              <p><a href="{{route('dashboard.index')}}">Dashboard</a> \ Admin settings</p>
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


            <form role="form" class="mainform img-thumbnail mt-2 p-3" action="cp_ssettings/{{$siteinfo->id}}" method="post" enctype="multipart/form-data">
            {{method_field('PATCH')}}
            @csrf
            <!-- Site -->
            <div class="form-group">
                <h5>General site info</h5>
                @if($siteinfo->sitename != null)
                  <input type="text" class="form-control" id="sitename" name="sitename" placeholder="Site name" value="{{$siteinfo->sitename}}">
                @else
                  <input type="text" class="form-control" id="sitename" name="sitename" placeholder="Site name">
                @endif
            </div>

            <div class="form-group">
                <h5>About website <span class="text-muted">(In Footer)<span></h5>
                @if($siteinfo->footerabout != null)
                  <textarea class="form-control" id="footerabout" name="footerabout" placeholder="About website">{{$siteinfo->footerabout}}</textarea>
                @else
                <textarea class="form-control" id="footerabout" name="footerabout" placeholder="About website"></textarea>
                @endif
            </div>
                           
            <div class="form-group">
                <h5>Social Media</h5>
                <p>Links should start with http:// or https://</p>
                <!-- Facebook -->
                @if($siteinfo->facebook != '')
                  <input type="text" class="form-control mb-2" id="facebook" name="facebook" placeholder="Facebook page" value="{{$siteinfo->facebook}}">
                @else
                  <input type="text" class="form-control mb-2" id="facebook" name="facebook" placeholder="Facebook page">
                @endif
                <!-- Twitter -->
                @if($siteinfo->twitter != '')
                  <input type="text" class="form-control mb-2" id="twitter" name="twitter" placeholder="Twitter account" value="{{$siteinfo->twitter}}">
                @else
                  <input type="text" class="form-control mb-2" id="twitter" name="twitter" placeholder="Twitter account">
                @endif
                <!-- Youtube -->
                @if($siteinfo->youtube != '')
                  <input type="text" class="form-control mb-2" id="youtube" name="youtube" placeholder="Youtube channel" value="{{$siteinfo->youtube}}">
                @else
                  <input type="text" class="form-control mb-2" id="youtube" name="youtube" placeholder="Youtube channel">
                @endif
                <!-- Vimo -->
                @if($siteinfo->vimo != '')
                  <input type="text" class="form-control" id="vimo" name="vimo" placeholder="Vimo account" value="{{$siteinfo->vimo}}">
                @else
                  <input type="text" class="form-control" id="vimo" name="vimo" placeholder="Vimo account">
                @endif
            </div>

            <div class="form-group">
              <h5>Favicon</h5>
              <div class="custom-file">
                <input name="favicon" type="file" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
              </div>
            </div>

              <button type="submit" class="btn btn-primary subton form-control">Save settings</button>

            </form>
        </div>
    </div>
</div>

@endsection
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

      <div class="col-md-6 admininfo">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Update Information</h3>
          </div>

            <form role="form" action="{{route('admin.upinfo')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="card-body">

                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{$adminDetails->name}}" placeholder="Enter new name">
                </div>

                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{$adminDetails->email}}" placeholder="Enter new email">
                </div>

                <div class="form-group">
                  <label for="pimage">Profile Image</label>
                  <input type="file" class="form-control" id="pimage" name="pimage" accept="image/*">

                  @if(!empty(Auth::guard('admin')->user()->image))
                      
                  @if(Auth::guard('admin')->user()->image !== 'default.png')
                  <div class="admin_image_preview mt-2">
                    <p><b>Current image</b></p>
                    <img class="img-fluid img-thumbnail image_preview" src="{{url('images/admin_images/admin_photoes/'.Auth::guard('admin')->user()->image)}}" alt="Admin_Image">
                  </div>
                  @endif

                  <input type="hidden" name="current_image" value="{{Auth::guard('admin')->user()->image}}">
                      
                  @if(Auth::guard('admin')->user()->image !== 'default.png')
                  <a id="removeAdminImage" class="btn btn-sm btn-danger mt-1" style="color:white;cursor: pointer;">Remove image</a>
                  @endif

                  @endif
                    
                </div>

                <div class="form-group">
                  <label for="current_em_password">Password</label>
                  <input type="password" class="form-control" id="current_em_password" name="current_em_password" placeholder="Current password">
                </div>
                  

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>
            </form>
        </div>
      </div>
      <div class="col-md-6 passinfo">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Update Password</h3>
            </div>
            
            <form role="form" action="{{route('admin.uppwd')}}" method="post">
              @csrf     
              <div class="card-body">

                <div class="form-group">
                  <label for="oldpassword">Current password</label>
                  <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Current password">
                </div>

                <div class="form-group">
                  <label for="newpassword">New password</label>
                  <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Password">
                </div>
                  
                <div class="form-group">
                  <label for="newpasswordconf">Re-type the new password</label>
                  <input type="password" class="form-control" id="newpasswordconf" name="newpasswordconf" placeholder="Confirm new password">
                </div>

                
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
                  
              </div>      
            </form>
          </div>
        </div>

    </div>
  </div>
</div>
@endsection
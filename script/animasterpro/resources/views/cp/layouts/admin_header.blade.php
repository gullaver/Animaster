<!-- Navbar -->
<nav class="maincpnav col-12">
    <div class="container-fluid">
        <div class="row nav_list">

            <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                <a class="navbar-brand" href="{{route('dashboard.index')}}">{{ config('app.name', 'Laravel') }}</a>
            </div>

            <div class="nav_btn col-lg-9 col-md-9 col-sm-9 col-12">
                <div class="cont ml-auto">
                    <div class="mr-2">
                        <a class="btn btn-light" href="/" target="_blank"><i class="far fa-eye mr-1"></i>View website</a>
                    </div>

                    <div class="">
                        <a class="btn btn-danger" href="{{route('admin.logout')}}"><i class="fas fa-sign-out-alt mr-1"></i>Logout</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</nav>
  <!-- /.navbar -->

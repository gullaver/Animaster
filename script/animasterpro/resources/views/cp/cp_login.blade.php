<!DOCTYPE html>
<html>
<head>
    <title>Login to control panel</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin_css/admin.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="loginpagebody">
    <div class="container">
        <div class="row">
            <div class="login">
                <div class="loghead">
                    <h5>Animaster CP</h5><h5>|</h5><h5>Login</h5>
                </div>

                <div class="logbody">
                    <form action="{{route('admin.login')}}" class="img-thumbnail" method="post">

                    @if ($errors->any())
                    <div class="alert alert-danger col-12">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(session()->has('fail'))
                        <div class="alert alert-danger col-12" role="alert">
                            Login data is incorrect
                        </div>
                    @endif

                    @CSRF
                            <div class="form-group emailfield">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group passfield">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/admin_js/plugins.js')}}"></script>
</body>
</html>



@extends('cp.layouts.admin')
@section('content')

<div class="col-lg-9 viewertbl_addpost">
    <div class="container">
        <div class="row p-3">
            <div class="locationtbl col-lg-12">
                    <p><a href="{{route('dashboard.index')}}">Dashboard</a> \ Comments settings</p>
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

                <form action="/cp_commentsettingssave" method= "POST" class="img-thumbnail w-100 p-2">
                    @CSRF

                    <div class="form-group">
                        @if(isset($siteset->facebookcomments) && $siteset->facebookcomments != '')
                        <label for="activefacebook">Activate Facebook comments</label>
                        <select name="activefacebook" class="form-control" id="activefacebook">
                            @if($siteset->facebookcomments == "Yes")
                            <option>No</option>
                            <option selected>Yes</option>
                            @else
                            <option>Yes</option>
                            <option selected>No</option>
                            @endif
                        </select>
                        @else
                        <label for="activefacebook">Activate Facebook comments</label>
                        <select name="activefacebook" class="form-control" id="activefacebook">
                            <option selected>No</option>
                            <option>Yes</option>
                        </select>
                        @endif
                    </div>

                    <div class="faceinfo">
                        <div class="form-group">
                            <label for="facemaincode">Facebook JavaScript SDK‎ code</label>
                            @if(isset($facecode) && count($facecode) != 0)
                            <textarea name="facemaincode" class="form-control" id="facemaincode" rows="3">{{$facecode[0]}}</textarea>
                            @else
                            <textarea name="facemaincode" class="form-control" id="facemaincode" rows="3"></textarea>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="facelocalcode">Facebook show comments code</label>
                            <p class="text-secondary img-thumbnail">EX: <i>{{'<div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-numposts="5" data-width=""></div>'}}</i></p>
                            @if(isset($facecode) && count($facecode) != 0)
                            <textarea name="facelocalcode" class="form-control" id="facelocalcode" rows="3">{{$facecode[1]}}</textarea>
                            @else
                            <textarea name="facemaincode" class="form-control" id="facemaincode" rows="3"></textarea>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                    @if(isset($siteset->localcomments) && $siteset->localcomments != '')
                        <label for="activesitecom">Activate Site comments</label>
                        <select name="activesitecom" class="form-control" id="activesitecom">
                        @if($siteset->localcomments == "Yes")
                            <option>No</option>
                            <option selected>Yes</option>
                        @else
                            <option selected>No</option>
                            <option>Yes</option>
                        @endif
                        </select>
                    @else
                    <label for="activesitecom">Activate Site comments</label>
                        <select name="activesitecom" class="form-control" id="activesitecom">
                            <option selected>No</option>
                            <option>Yes</option>
                        </select>
                    @endif
                    </div>
                    <button class="btn btn-primary">Apply</button>
                </form>
        </div>
    </div>
</div>
@endsection
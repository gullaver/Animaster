@extends('layouts.app')

@section('title')
<title>Contact Us</title>
@endsection

@section('content')
<section class="page_main">
    <div class="container">
        <div class="row">

            <div class="page">
                <h5>Contact us</h5>
                <div class="errors_showshow">
                    @if(session()->has('err_message'))
                    <div class="alert alert-danger generalerrorshow col-12" role="alert">
                        {{session()->get('err_message')}}
                    </div>
                    @endif
                    @if(session()->has('success_message'))
                        <div class="alert alert-success generalerrorshow col-12" role="alert">
                            {{session()->get('success_message')}}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger generalerrorshow col-12">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="pge_body p-5">
                    <div class="row">
                        <div class="mail_sign col-lg-3">
                            <i class="fas fa-paper-plane"></i>
                        </div>

                        <div class="send_data col-lg-9">
                            <form action="{{route('message.send')}}" method="post" class="p-3">
                            @CSRF
                                <div class="form-group">
                                    <label for="sendername">Name:</label>
                                    <input type="text" name="sendername" id="sendername" class="form-control" placeholder="Name"> 
                                </div>

                                <div class="form-group">
                                    <label for="senderemail">Email:</label>
                                    <input type="email" name="senderemail" id="senderemail" class="form-control" placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <label for="sendermsg">Message:</label>
                                    <textarea name="sendermsg" id="sendermsg" cols="30" rows="3" class="form-control" placeholder="Your message"></textarea>
                                </div>

                                <button class="btn btn-primary">Send</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
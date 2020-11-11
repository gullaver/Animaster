@extends('layouts.app')

@section('title')
<title>{{$thispage->pagename}}</title>
@endsection

@section('content')
<section class="page_main">
    <div class="container">
        <div class="row">

            <div class="page">
                <h5>{{$thispage->pagename}}</h5>

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
                
                <div class="pge_body p-5"><?php echo html_entity_decode($thispage->pagecontent); ?>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
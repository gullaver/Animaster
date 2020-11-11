@extends('cp.layouts.admin')
@section('content')

<?php
//Get Data for Users Chart
 
        $usestat_today = App\User::where('created_at', ">=",Carbon\Carbon::today())->get()->count();

        $usestat_1 = App\User::where(
            'created_at', ">=" ,Carbon\Carbon::today()->subDays(1))->Where(
            'created_at', "<" ,Carbon\Carbon::today())->get()->count();

        $usestat_2 = App\User::where(
            'created_at', ">=" ,Carbon\Carbon::today()->subDays(2))->Where(
        'created_at', "<" ,Carbon\Carbon::today()->subDays(1))->get()->count();

        $usestat_3 = App\User::where(
            'created_at', ">=" ,Carbon\Carbon::today()->subDays(3))->Where(
            'created_at', "<" ,Carbon\Carbon::today()->subDays(2))->get()->count();

        $usestat_4 = App\User::where(
            'created_at', ">=" ,Carbon\Carbon::today()->subDays(4))->Where(
            'created_at', "<" ,Carbon\Carbon::today()->subDays(3))->get()->count();

        $usestat_5 = App\User::where(
                'created_at', ">=" ,Carbon\Carbon::today()->subDays(5))->Where(
                'created_at', "<" ,Carbon\Carbon::today()->subDays(4))->get()->count();

        $usestat_6 = App\User::where(
            'created_at', ">=" ,Carbon\Carbon::today()->subDays(6))->Where(
            'created_at', "<" ,Carbon\Carbon::today()->subDays(5))->get()->count();


 $dataPoints = array(

    array("y" => $usestat_6, "label" => Carbon\Carbon::parse(Carbon\Carbon::today()->subDays(6))->format('l')),
    array("y" => $usestat_5, "label" => Carbon\Carbon::parse(Carbon\Carbon::today()->subDays(5))->format('l')),
    array("y" => $usestat_4, "label" => Carbon\Carbon::parse(Carbon\Carbon::today()->subDays(4))->format('l')),
    array("y" => $usestat_3, "label" => Carbon\Carbon::parse(Carbon\Carbon::today()->subDays(3))->format('l')),
    array("y" => $usestat_2, "label" => Carbon\Carbon::parse(Carbon\Carbon::today()->subDays(2))->format('l')),
    array("y" => $usestat_1, "label" => Carbon\Carbon::parse(Carbon\Carbon::today()->subDays(1))->format('l')),
    array("y" => $usestat_today, "label" => Carbon\Carbon::parse(Carbon\Carbon::today())->format('l')),

 );
 
?>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
	title: {
		text: "Registrants Per Week"
	},
	axisY: {
		title: "Number of Registrants"
	},
	data: [{
		type: "spline",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>

<div class="col-lg-9 viewer" id="viewer">
        <div class="container">
            <div class="row p-3a">

                <div class="location col-lg-12">
                    <p>Dashboard \ Home</p>
                </div>

                <div class="stat">
                    <div class="card img-thumbnail" style="width: 18rem;">
                        <i class="fas sectstat fa-envelope fa-7x" style="color: #0275d8;"></i>
                        <div class="card-body">
                            <p class="card-text">Unread messages: {{$countmsgs}}</p>
                            <a href="/shownewmessages" class="btn btn-sm btn-secondary">View latest messages</a>
                        </div>
                    </div>

                    <div class="card img-thumbnail" style="width: 18rem;">
                        <i class="fas sectstat fa-comments fa-7x" style="color: #5cb85c;"></i>
                        <div class="card-body">
                            <p class="card-text">Comments in the last 24 hours: {{$countcomments}}</p>
                            <a href="/cp_comments" class="btn btn-sm btn-secondary">View latest comments</a>
                        </div>
                    </div>
                    
                    <div class="card img-thumbnail" style="width: 18rem;">
                        <i class="fas sectstat fa-user-friends fa-7x" style="color: #d9534f;"></i>
                        <div class="card-body">
                            <p class="card-text">Registrants in the last 24 hours: {{$countusers}}</p>
                            <a href="{{route('cp_managemem.index')}}" class="btn btn-sm btn-secondary">View latest members</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-5 mb-5">
                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                </div>
                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


            </div>
        </div>
</div>
  
@endsection
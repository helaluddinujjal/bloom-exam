@extends('layouts.frontend.design')
@section('title','Test Complete-Semster')
@push('style')
	<style>
		
	.test{
		width: 530px;
		margin:0 auto;
		padding: 50px;
		border:1px solid #ddd;
	}
	.test li {
    line-height: 30px;
}
.test p {
    line-height: 30px;
}
.test h3 {
   
    font-size: x-large;
}
.test a {
 border: 1px solid #3399ff;
    border-radius: 3px;
    color: #3399ff;
    display: block;
    margin: 15px auto;
    padding: 5px 10px;
    text-align: center;
    text-decoration: none;
}
.test a:hover {
 border: 1px solid #999;
    color: #999;
}

	</style>
@endpush
@section('section')
	<div class="main">
		<h1>Your test has been completed.</h1>
		<div class="test">
		<h3>An Excellence performance</h3>
		<ul>
		    <li> <strong>Number of Question:</strong> {{App\Question::where('status',1)->count()}} </li>
		    <li> <strong>Question Type:</strong> Multiple Choice</li>
		    <li> <strong>Correct Answer:</strong> {{Session::get('right_ans')}}</li>
		    <li> <strong>Percentage:</strong> {{Session::get('percentage')}}%</li>
		</ul>
		<p>If you selected then we will contact with you.Best of luck...... </p>
		</div>	
	{{Session::forget('right_ans')}}
  {{Session::forget('percentage')}}
  {{Session::forget('userAnsId')}}
  </div>
@endsection

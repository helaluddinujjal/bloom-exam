@extends('layouts.frontend.design')
@section('title','Exam-Semster Test')
@section('section')
	<div class="main">
	<h1>Welcome to Online Exam - Start Now</h1>
		<div class="segment" style="margin-right:30px;">
			<img src="{{asset('assets/frontend/img/online_exam.png')}}"/>
		</div>
		<div class="segment">
		<h2>Start Test</h2>
		<ul>
			<li><a href="{{ url('start-test') }}">Start Now...</a></li>
		</ul>
		</div>
		
	  </div>
@endsection
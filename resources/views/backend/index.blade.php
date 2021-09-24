@extends('layouts.backend.design')
@section('title','Dashboard-Semster Admin Pannel')
@push('style')
	<style>
		
	.admin {
    max-width: 50%;
    height: 100%;
    color: #bababa;
    margin: 0 auto;
    padding-top: 13%;
    line-height: 27px;
	}
	.admin h2 {
	    line-height: 40px;
	    color: #959191;

	    text-align: center;
	}

	</style>
@endpush
@section('section')
<div class="main">
	<h1>Admin Panel</h1>

	<div class="admin">
		<h2>Wellcome to admin pannel </h2>
		<p>You can manage your user and  exam system from here.</p>
	</div>
</div>
@endsection
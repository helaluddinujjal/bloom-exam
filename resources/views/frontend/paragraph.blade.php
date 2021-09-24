@extends('layouts.frontend.design')
@section('title','Eassy Test-Semster')
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
#quiz-time-left {
    position: fixed;
    top: 286px;
	left: -100px;
      -ms-transform: rotate(-90deg); /* IE 9 */
  transform: rotate(-90deg); /* Standard syntax */
}
	</style>
@endpush
@php

@endphp
@section('section')
	<div class="main">
	    @if(!empty($settings->essay_time))
	    <h1 id="quiz-time-left"> </h1>
		@endif
		<h1>Write 200 words about what is your favorite flower occasion and why</h1>
		<div class="test">
		 <form action="{{ url('/paragraph') }}" method="post" name="submitForm">
            @csrf
            <table style="margin:0 auto">
                <tr>
                    <td>
                    	<textarea id="w3review" name="paragraph" rows="30" cols="70" placeholder="Write Article ..."></textarea>
                    </td>
                </tr>
                <tr>
                	<td>
                		<input type="submit" name="submitEssay" value="Submit"/>
                	</td>
                </tr>
            </table>
        </from>
		</div>
	
  </div>
@endsection

 @push('script')
 <!--tyny mce integrate -->
	<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
 <script>
 tinymce.init({selector:'textarea'});
 
 localStorage.removeItem('total_seconds');
 var set_essay="{{!empty($settings->essay_time)?$settings->essay_time:0}}";
 alert(set_essay);
 if(set_essay==0){
     console.log('');
 }else{
	if(localStorage.getItem("total_seconds_essay")){
    var total_seconds = localStorage.getItem("total_seconds_essay");
} else {
    
    var essay_time="{{!empty($settings->essay_time)?$settings->essay_time:0}}";
    var total_seconds = 60*essay_time;
}
var minutes = parseInt(total_seconds/60);
var seconds = parseInt(total_seconds%60);
function countDownTimer(){
    if(seconds < 10){
        seconds= "0"+ seconds ;
    }if(minutes < 10){
        minutes= "0"+ minutes ;
    }
    
    document.getElementById("quiz-time-left").innerHTML = "Time Left : "+minutes+" minutes "+seconds+" seconds ";
    if(total_seconds <= 0){
      alert('Time Up!! Please Submit Your Answer');
         localStorage.removeItem("total_seconds_essay"); 
        setTimeout("document.submitForm.submit()",1);
    } else {
        total_seconds = total_seconds -1 ;
        minutes = parseInt(total_seconds/60);
        seconds = parseInt(total_seconds%60);
        localStorage.setItem("total_seconds_essay",total_seconds)
        setTimeout("countDownTimer()",1000);
    }
}
setTimeout("countDownTimer()",1000);
}
//===========================
/*var t=setTimeout(function(){
	window.location='http://localhost/Semster-exam/admin';
	alert('work');
},1800*1000);*/

	</script>
	
	
 @endpush
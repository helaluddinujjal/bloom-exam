@extends('layouts.frontend.design')
@section('title','Question Paper-Semster')
@push('style')
<style>
	.answer {
    display: inline;
    margin-right: 20px;
}
tr.question:not(:first-child) h3 {
    padding-top: 50px !important;
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
@section('section')
<div class="main">
    @if(!empty($settings->mcq_time))
	    <h1 id="quiz-time-left"> </h1>
		@endif
<h1>Copy Writer Test Question</h1>
	<div class="test">
		<form method="post" action="{{url('/questions')}}" name="submitForm">
			@csrf
		<table> 
			@foreach($questions as $question)

				<tr class="question">
					<td colspan="2">
					 <h3>Question {{$question->ques_no}}: {{$question->ques}}</h3>
					</td>
				</tr>
				@foreach($question->answeers as $answeer)
					<tr class="answer">
						<td>
						 <input type="radio" name="ans[{{$question->ques_no}}]" value="{{$answeer->id}}" />{{$answeer->ans}}
						</td>
					</tr>
				@endforeach
			@endforeach
			<tr>
			  <td>
				<input type="submit" name="submitQuiz" value="Submit"/>
			</td>
			</tr>
			
		</table>
	</form>
</div>
 </div>
 @endsection
 
 @push('script')
 <script>
 var set_mcq="{{!empty($settings->mcq_time)?$settings->mcq_time:0}}";
 //alert(set_essay);
 if(set_mcq==0){
     console.log('');
 }else{
	if(localStorage.getItem("total_seconds")){
    var total_seconds = localStorage.getItem("total_seconds");
} else {
    var mcq_time="{{!empty($settings->mcq_time)?$settings->mcq_time:0}}";
    var total_seconds = 60*mcq_time;
     // alert(total_seconds);
}
var minutes = parseInt(total_seconds/60);
var seconds = parseInt(total_seconds%60);
function countDownTimer(){
    if(seconds < 10){
        seconds= "0"+ seconds ;
    }if(minutes < 10){
        minutes= "0"+ minutes ;
    }
    //alert(total_seconds);
    document.getElementById("quiz-time-left").innerHTML = "Time Left : "+minutes+" minutes "+seconds+" seconds ";
    if(total_seconds <= 0){
       alert('Time Up!! Please Submit Your Answer');
         localStorage.removeItem("total_seconds"); 
        setTimeout("document.submitForm.submit()",1);
 
    } else {
        total_seconds = total_seconds -1 ;
        minutes = parseInt(total_seconds/60);
        seconds = parseInt(total_seconds%60);
        localStorage.setItem("total_seconds",total_seconds)
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
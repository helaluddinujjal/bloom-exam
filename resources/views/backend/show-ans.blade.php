@extends('layouts.backend.design')
@section('title','Examinees List of Semster')
@push('style')
	{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
 --}}
@endpush
@section('section')
	<div class="main">
	<h1 class="text-center">User Information</h1>
	<table class="table table-light test mb-5">
		<tbody>
			<tr>
				<td>Name: {{$userDetails->name}}</td>
				<td>Username: {{$userDetails->username}}</td>
			</tr>
			<tr>
				<td>Total Question: {{$user->total_ques}}</td>
				<td>Leave Answer: {{$user->total_ques-($user->right_ans+$user->wrong_ans)}}</td>
			</tr>
			<tr>
				<td><span style="color:green">Correct Answer: {{$user->right_ans}}</span></td>
				<td><span style="color:red">Wrong Answer: {{$user->wrong_ans}}</span></td>
			</tr>
			<tr>
				<td>Percentage: <span style="font-size:22px;font-weight: 700px;">{{$user->percentage}}</span></td>
				<td>Exam Date: {{$user->created_at->format('d M Y')}}</td>
			</tr>
		</tbody>
	</table>
	<h1 class="text-center"> Answer Sheet</h1>
		<div class="test">
	<table> 
		@foreach($ques_answers as $ques=> $ans)

			<tr>
				<td colspan="2">
					@php
					 $ques_no_ques=explode('-',$ques);
					 $user_ans_right_ans=explode('-',$ans);
					@endphp
				 <h3><strong>Ques {{$ques_no_ques[0]}}: {{$ques_no_ques[1]}}</strong></h3>
				</td>
			</tr>
				<tr class="answer">
					<td>
					 <p style="margin-left: 5px;padding-bottom:10px ">User Ans: <i style="color:{{$user_ans_right_ans[0]==$user_ans_right_ans[1]?'green':'red'}}">{{$user_ans_right_ans[0]}}</i></p>
					 <p style="color:blue;margin-left: 10px;padding-bottom:30px;font-size:15px ">Correct Ans: {{$user_ans_right_ans[1]}}</p>
					</td>
				</tr>
		@endforeach
			@if(!empty($user->paragraph))
		<tr>
		  <td>
		  	<h1 style="text-align: center">Eassy</h1><br>
				{!! $user->paragraph !!}
		</td>
		</tr>
			@endif
		
	</table>
</div>
		
	  </div>
@endsection
@push('script')	
	{{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script> --}}

	<script>
		function deleteItem(id){
toastr.clear();
toastr.error("<br /><button type='button' class='btn btn-primary btn-sm ' value='yes'>Yes</button>",'Are you sure you want to delete this item?',
{
    allowHtml: true,
    closeButton: true,
    timeOut: 0,
    extendedTimeOut: 1,
    positionClass: "toast-top-center",
    
    onclick: function (toast) {
      value = toast.target.value
      if (value == 'yes') {
         path=$(".delete").attr('rel');  
         var url="{{ url('/') }}"; 
         //alert(url+path+id) 
         location.href=url+path+id;

      }
    },

})

		   }
	</script>
@endpush
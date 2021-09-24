@extends('layouts.backend.design')
@section('title','EQuestion List of Semster')
@push('style')
	{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
 --}}
@endpush
@section('section')
	<div class="main">
	<h1>Questions List</h1>
		<div class="users">
		    <table id="datatable" class="display">
			    <thead>
			        <tr>
			            <th>SL</th>
			            <th>Ques No</th>
			            <th>Status</th>
			            <th>Question</th>
			            <th>Action</th>
			        </tr>
			    </thead>
			    <tbody>
		        	@foreach($questions as $ques)
		        	 <tr>
		        	 	<td>{{ $loop->index+1 }}</td>
		        	 	<td>{{ $ques->ques_no }}</td>
		        	 	<td>
							 @if ($ques->status==1)
							 	<i style='color:green'>Enable</i> 
							 @else
							 	<i style='color:red'>Disable</i>
							 @endif
							</td>
		        	 	<td>{{ $ques->ques }}</td>
		        	 	<td>
		        	 		<a href="javascript:void(0)" class="btn btn-info btn-sm ans-model-{{$ques->id}}" data-toggle="modal" data-target=".ques-{{$ques->id}}">Answeer</a>
		        	 		<a href="{{ url('admin/edit-question/'.$ques->id) }}" class="btn btn-info btn-sm">Edit</a> 
		        	 		<a href="javascript:void(0)" rel="/admin/question-delete/" class="btn btn-danger btn-sm delete" onclick="deleteItem({{$ques->id}})">Delete</a>
		        	 	</td>
		        	 </tr>
						<!-- Modal -->
						<div class="modal fade ques-{{$ques->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLabel">Multiple Choices</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						        @php
						        $i=1;
						        $right_ans='';
						        @endphp
						        @foreach($ques->answeers as $ans)
						        	<p> <strong>Choice No {{$i}}:</strong> {{$ans->ans}} </p>
						        	@php
						        $i++;
						        if($ans->right_ans==1) {
						        	$right_ans=$ans->ans;
						        }
						        @endphp
						        @endforeach
						        <h5>Right Answeer={{$right_ans}}</h5>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-info" data-dismiss="modal">Ok</button>
						      </div>
						    </div>
						  </div>
						</div>
		        	@endforeach
			    </tbody>
			</table>

		</div>
		
	  </div>

@endsection
@push('script')	

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
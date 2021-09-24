@extends('layouts.backend.design')
@section('title','Examinees List of Semster')
@push('style')
	{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
 --}}
@endpush
@section('section')
	<div class="main">
	<h1>All Examinees</h1>
		<div class="users">
		    <table id="datatable" class="display">
			    <thead>
			        <tr>
			            <th>SL</th>
			            <th>Name</th>
			            <th>Username</th>
			            <th>Email</th>
			            <th>Status</th>
			            <th>Action</th>
			        </tr>
			    </thead>
			    <tbody>
		        	@foreach($users as $user)
		        	 <tr>
		        	 	<td>{{ $loop->index+1 }}</td>
		        	 	<td>{{ $user->name }}</td>
		        	 	<td>{{ $user->username }}</td>
		        	 	<td>{{ $user->email }}</td>
		        	 	<td>
		        	 		@if($user->status==0)
		        	 		<i style="color: brown">Inactive</i 
		        	 		@elseif($user->status==1)
		        	 			<i style="color:green">Active</i>	
		        	 		@else
								 <i style="color:red">Disable</i>
		        	 		@endif
		        	 	</td>
		        	 	<td>
		        	 					        	 			
		        	 		@if($user->status==1)
		        	 		<a class="btn btn-sm btn-outline-warning mt-1" href="{{ url('admin/examinee/2/'.$user->id) }}">Disable</a>
		        	 		@else
		        	 		<a class="btn btn-sm btn-outline-success mt-1" href="{{ url('admin/examinee/1/'.$user->id) }}">Active</a>
		        	 			
							 @endif 
							 <a class="btn btn-sm btn-outline-danger mt-1"href="javascript:void(0)" rel="/admin/examinee-delete/" relid="{{$user->id}}" class="delete" onclick="deleteItem({{$user->id}})">Delete</a>
							 <a class="btn btn-sm btn-outline-info mt-1" href="{{ url('admin/examinees/'.$user->id).'/answersheet' }}">Answeers</a> 
		        	 	</td>
		        	 </tr>
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
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
			            <th>Percentage</th>
			            <th>Date</th>
			            <th>Email</th>
			            <th>Status</th>
			            <th>Action</th>
			        </tr>
			    </thead>
			    <tbody>
		        	
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
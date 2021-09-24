@extends('layouts.backend.design')
@section('title','Edit Question of Exam')
@section('section')
	<div class="main">
	<h1>Edit Question </h1>
		<div class="users">
		    <form action="{{url('/admin/edit-question/'.$question->id)}}" method="post">
		    	@csrf
			  <div class="form-row">
				  	<div class="form-group col-md-12">
					    <label for="inputAddress">Question No</label>
					    @php
					    	if (!empty($question_no)) {
					    		$ques_no=$question_no+1;
					    	}else{
					    		$ques_no=1;
					    	}
					    @endphp
					    <input type="number" class="form-control" name="ques_no" id="ques_no" value="{{$question->ques_no}}">
				  	</div>	
				  	<div class="form-group col-md-12">
					    <label for="inputAddress">Question</label>
					    <input type="text" class="form-control" name="ques" id="ques" value="{{$question->ques}}">
				  	</div>
				    <div class="control-group col-md-12">
	                    <label class="control-label">Multiple Answeer</label>
	                    <div class="controls">
	                        <div class="field_wrapper">
	                        	@php
	                        		$right_ans='';
	                        	@endphp
	                        	@foreach($question->answeers as $key=>$ans)
	                            <div class="mt-2 mb-2 child-class">
	                                <input type="text" name="ans[{{$ans->id}}]" value="{{$ans->ans}}" class="form-control"/>
	                                
	                            </div>	
	                            	@php
	                            		if ($ans->right_ans==1) {
	                            			$right_ans=$key;
	                            		}
	                            	@endphp
	                        	@endforeach
	                        </div>
	                    </div>
	                </div>
	                <div class="form-group col-md-12">
					    <label for="inputAddress">Right Answeer</label>
					    <input type="number" class="form-control" name="right_ans" id="right_ans" value="{{$right_ans+1}}">
					</div>
					<div class="form-group col-md-12">
					    <label for="inputAddress">Enable</label>
					    <input type="checkbox" class="form-check-inline ml-3 mt-1" name="status" value="1" @if ($question->status==1)
							checked
						@endif>
				  	</div>	  
			  </div>
			  
			  <button type="submit">Submit</button>
			</form>
		</div>
		
	  </div>
@endsection
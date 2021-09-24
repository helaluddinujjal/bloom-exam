@extends('layouts.backend.design')
@section('title','Add Question of Exam')
@section('section')
	<div class="main">
	<h1>Add Question </h1>
		<div class="users">
		    <form action="{{url('/admin/add-question')}}" method="post">
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
					    <input type="number" class="form-control" name="ques_no" id="ques_no" value="{{$ques_no}}">
				  	</div>	
				  	<div class="form-group col-md-12">
					    <label for="inputAddress">Question</label>
					    <input type="text" class="form-control" name="ques" id="ques" placeholder="Enter Your Question..">
				  	</div>
				    <div class="control-group col-md-12">
	                    <label class="control-label">Multiple Answeer</label>
	                    <div class="controls">
	                        <div class="field_wrapper">
	                            <div class="mt-2 mb-2">
	                                <input type="text" name="ans[]" placeholder="Choice  Answer" class="form-control"/>
	                                <a href="javascript:void(0);" class="add_button btn btn-success" title="Add field">Add</a>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="form-group col-md-12">
					    <label for="inputAddress">Right Answeer</label>
					    <input type="number" class="form-control" name="right_ans" id="right_ans" placeholder="Input Right Answeer No">
				  	</div>
	                <div class="form-group col-md-12">
					    <label for="inputAddress">Enable</label>
					    <input type="checkbox" class="form-check-inline ml-3 mt-1" name="status" value="1" checked>
				  	</div>
			  </div>
			  
			  <button type="submit">Submit</button>
			</form>
		</div>
		
	  </div>
@endsection
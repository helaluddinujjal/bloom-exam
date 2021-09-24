
@extends('layouts.backend.design')
@section('title','Settings-Semster Admin')
@push('style')
<style>
    
    #mcq_time_check, #essay_time_check {
        margin-top: 8px;
    }
    #mcq_time {
        margin-bottom: 0;
    }
    #essay_time {
        margin-bottom: 0;
    }
    .floatleft{
        float: left;
    }
</style>
@endpush
@section('section')
<div class="main">
    <h1 class="text-center">Settings</h1>
    <div class="adminlogin">
        <form action="{{ url('/admin/settings') }}" method="post">
            @csrf
            <table style="margin:0 auto" class="table table-borderless">
                <tr>
                    <td class="w-50">Exam Link</td>
                    <td>
                        <input type="checkbox" name="exam_status" value="1" @php 
                        if (isset($settings)) {
                            if ($settings->exam_status==1) {
                                echo 'checked';
                            }
                        }
                        @endphp /> Active
                    </td>
                </tr>
                <tr>
                    <td>MCQ Time(in minute)</td>
                    <td>
                        <input type="checkbox" class="floatleft mr-3" name="mcq_time_check" id="mcq_time_check" onchange="mcq_time_checks()" @php if (isset($settings)) {
                            if (!empty($settings->mcq_time)) {
                                echo 'checked';
                            }
                        }
                        @endphp>
                        <input type="number" name="mcq_time" id="mcq_time" style="display: none" class=" form-control" placeholder="Input Total minute only" value="{{ !empty($settings->mcq_time)?$settings->mcq_time:'' }}" /> 
                    </td>
                </tr>
                <tr>
                    <td>Essay Time(in minute)</td>
                    <td>
                        <input type="checkbox" class="floatleft mr-3" name="essay_time_check" id="essay_time_check"  onchange="essay_time_checks()" @php if (isset($settings)) {
                            if (!empty($settings->essay_time)) {
                                echo 'checked';
                            }
                        }
                        @endphp>
                        <input type="number" name="essay_time" id="essay_time" style="display: none" class="form-control" placeholder="Input Total minute only" value="{{ !empty($settings->essay_time)?$settings->essay_time:'' }}" />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Submit"/></td>
                    
                </tr>
            </table>
        </from>
    </div>
</div>

@endsection
@push('script')
<script>
    $(document).ready(function(){
        if($('#mcq_time_check').is(":checked"))   
        $("#mcq_time").fadeIn();
        else
        $("#mcq_time").fadeOut();
        
        if($('#essay_time_check').is(":checked"))   
        $("#essay_time").fadeIn();
        else
        $("#essay_time").fadeOut();
        
    })
    function mcq_time_checks()
    {
        if($('#mcq_time_check').is(":checked"))   
        $("#mcq_time").fadeIn();
        else
        $("#mcq_time").fadeOut();
    }
    function essay_time_checks()
    {
        if($('#essay_time_check').is(":checked"))   
        $("#essay_time").fadeIn();
        else
        $("#essay_time").fadeOut();
    }
</script>
@endpush
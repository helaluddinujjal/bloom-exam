<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function settings(Request $request){
    	if($request->isMethod('post')){
    // 		$this->validate($request,[
    // 			'mcq_time'=>'numeric',
    // 		]);
    		if ($request->exam_status==1) {
    			$exam_status=1;
    		}else{
    			$exam_status=0;
            }
            if ($request->mcq_time_check!="on") {
                $request->mcq_time=null;
            }
            if ($request->essay_time_check!="on") {
                $request->essay_time=null;
            }
           //return $request->all();die;
    	 Setting::updateOrCreate([
                        "id"=>1,
                    ],[
                        "exam_status"=>$exam_status,
                        "mcq_time"=>$request->mcq_time,
                        "essay_time"=>$request->essay_time,
                    ]);	
    	 return redirect()->back()->with('success_msg','Settings has been saved');
    	}
    	$settings=Setting::where('id',1)->first();
    	return view('backend.settings')->with(compact('settings'));
    }
}
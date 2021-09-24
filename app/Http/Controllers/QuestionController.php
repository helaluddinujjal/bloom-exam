<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use App\Answeer;
use App\Setting;
use App\UserAns;
use App\Question;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class QuestionController extends Controller
{
    public function listQuestion(){
    	$questions=Question::orderBy('id','Desc')->get();
    	return view('backend.papers.all-ques-paper',compact('questions'));

    }
    public function addQuestion(Request $request){
    	if ($request->isMethod('post')) {
    		$this->validate($request,[
    			'ques_no'=>'required|numeric',
    			'ques'=>'required',
    			'ans'=>'required',
    			'right_ans'=>'required|numeric',
    			
			]);
    		if ($request->status!=1) {
				$request->status=0;
			}
    		$question=new Question();
    		$question->ques_no=$request->ques_no;
    		$question->ques=$request->ques;
    		$question->status=$request->status;
    		$question->save();
    		$ques_id=$question->id;
    		$rightAns=$request->right_ans-1;
    		foreach ($request->ans as $key=>$value) {
    			$answeer=new Answeer();
    			$answeer->question_id=$ques_id;
    			if($key==$rightAns){
    				$answeer->right_ans=1;
    			}else {
    				$answeer->right_ans=0;
    				
    			}
    				$answeer->ans=$value;
    				$answeer->save();
    		}
    		return redirect()->back()->with('success_msg','Question has been inserted');
    	}
    	 $question_no=Question::pluck('ques_no')->last();
    	return view('backend.papers.add-ques-paper',compact('question_no'));
    } 
    public function editQuestion(Request $request,$id){
    	if ($request->isMethod('post')) {
    	//echo "<pre>";	print_r($request->all());die;
    		$this->validate($request,[
    			'ques_no'=>'required|numeric',
    			'ques'=>'required',
    			'ans'=>'required',
    			'right_ans'=>'required|numeric',
    			
    		]);
    		if ($request->status!=1) {
				$request->status=0;
			}
    		$question=Question::find($id);
    		$question->ques_no=$request->ques_no;
    		$question->ques=$request->ques;
    		$question->status=$request->status;
    		$question->save();
    		 $ques_id=$id;
    		//$rightAns=$request->right_ans;
    			//return $request->ans;die;
    		foreach ($request->ans as $key=>$value) {
    			//echo $key;die;
    			$answeer= Answeer::find($key);
    			$answeer->question_id=$ques_id;
    			// if($key==$rightAns){
    			// 	$answeer->right_ans=1;
    			// }else {
    			// 	$answeer->right_ans=0;
    				
    			// }
    				$answeer->ans=$value;
    				$answeer->save();
    		}
    		return redirect()->back()->with('success_msg','Question has been Saved');
    	}
    	 $question=Question::where('id',$id)->first();
    	return view('backend.papers.edit-ques-paper',compact('question'));
    }

    public function deleteQuestion($id=null){
    	$question=Question::find($id);
    	$question->delete();
    	return redirect()->back()->with('success_msg','Question has been deleted');
    }

    //users
    public function userQuestions(Request $request){
		$userCheck=User::where('email',Session::get('userSession'))->first();
		$userAns=UserAns::where('user_id',$userCheck->id)->count();
        if ($userCheck->status!=1) {
            return view('frontend.disable');
        }elseif ($userAns>0) {
			Toastr::error('You are already participate in the exam.', 'Not Allow to exam!!');
            return  view('frontend.exam');;
		}
         $settings=Setting::where('id',1)->first();
         if(!empty($settings)){
            if (!$settings->exam_status==1) {
            return view('frontend.inactive');
            }
         }
        
    		if ($request->isMethod('post')) {
    			//return $request->ans;
    			$user=User::where('email',Session::get('userSession'))->first();
    			$user_id=$user->id;
				$wrong_ans=0;
				$right_ans=0;
				$userAns=[];
				$ques_id=[];
				$user_ques=[];
				if (is_array($request->ans) || is_object($request->ans))
                {
    			foreach ($request->ans as $ques_no=>$ans_id) {
    			$question=Question::where('ques_no',$ques_no)->first();
    				$ques_id[]=$question->id;
    				$user_ques[]=$question->ques_no.'-'.$question->ques;
    				$answeer=Answeer::where('id',$ans_id)->first();
    				$rightAns=Answeer::where(['question_id'=>$question->id,'right_ans'=>1])->first();
    				if ($rightAns->id==$ans_id) {
    					$right_ans=$right_ans+1;	
    				}else{
    					$wrong_ans=$wrong_ans+1;
    				}
    				$userAns[]=$answeer->ans.'-'.$rightAns->ans;
    			}
    		    
    		}else{
    		      return redirect()->back()->with('error_msg','You can not submit the form in empty');
    		   
    		}
    			$questionCount=Question::where('status',1)->count();
    			//echo $right_ans;die;
    			//return $userAnsArr;
    			$userQuesIdStr= implode(",",$ques_id);
    			$userQuesStr= implode("=>ques<=",$user_ques);
    			$userAnsStr= implode("=>ans<=",$userAns);
    			//echo $right_ans;die;
    			$percentageRightAns=($right_ans*100)/$questionCount;
    			$userAns=new UserAns;
    			$userAns->user_id=$user_id;
    			$userAns->total_ques=$questionCount;
    			$userAns->ques=$userQuesStr;
    			$userAns->user_ans=$userAnsStr;
    			$userAns->right_ans=$right_ans;
    			$userAns->wrong_ans=$wrong_ans;
    			$userAns->percentage=$percentageRightAns.'%';
    			$userAns->save();
    			Session::put('userAnsId',$userAns->id);
    			Session::put('right_ans',$right_ans);
    			Session::put('percentage',$percentageRightAns);
    			if ($percentageRightAns>=85) {
    			     
                     $settings=Setting::where('id',1)->first();
                        if(!empty($settings)){
                            if (!$settings->exam_status==1) {
                            return view('frontend.inactive');
                            }
                         }
          
    				return view('frontend.paragraph',compact('settings'));
    			}else {
    			     echo "<script>localStorage.removeItem('total_seconds');</script>";
    				return view('frontend.failure');
    			}
    		}
    	$questions=Question::where('status',1)->orderBy('ques_no','Asc')->get();
    	return view('frontend.test',compact('questions','settings'));
    }

    public function paragraph(Request $request){
        $userCheck=User::where('email',Session::get('userSession'))->first();
        if ($userCheck->status!=1) {
            return view('frontend.disable');
        }
    		$this->validate($request,[
    			'paragraph'=>'required|min:200',
    			
    		]);
    	if (!empty(Session::get('userAnsId'))) {
    		$userAnsId=Session::get('userAnsId');
    		$userAns=UserAns::where('id',$userAnsId)->first();
    		$userAns->paragraph=$request->paragraph;
    		$userAns->save();
    		 echo "<script>localStorage.removeItem('total_seconds_essay');</script>";
    		return view('frontend.success');

    	}else{
    		abort(404);
    	}
    }
}
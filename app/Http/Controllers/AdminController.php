<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use App\UserAns;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashbord(){

        return view('backend.index');
    }
    public function loginForm(){

        if (!empty(Session::get('adminSession'))) {
            return redirect('admin/dashbord');
        }else{
            return view('backend.login');

        }
    }
    public function login(Request $request){
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required',
        ]);
        $data=$request->all();
        $countAdmin=Admin::where(['email' => $data['email'], 'password' => md5($data['password'])])->count();
            if($countAdmin>0){
                $admin=Admin::where(['email' => $data['email']])->first();
               // echo "<pre>";print_r($admin);die;

                Session::put('adminSession',$data['email']);
                Session::put('adminName',$admin->name);
                return redirect('admin/dashbord');
            }else {
                Toastr::error('Email or Password don\'t matched', 'Error');
                return redirect()->back();
            }

    }
    public function forgetPassword(Request $request){
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'email'=>'required|email',
            ]);
            $countEmail=Admin::where('email',$request->email)->count();
            if ($countEmail>0) {
                $admin=Admin::where('email',$request->email)->first();
                $email=$admin->email;
                $name=$admin->name;
                $pass=Str::random(8);
                $db_pass=md5($pass);
                Admin::where('email',$email)->update(['password'=>$db_pass]);
                $message=[
                    'email'=>$email,
                    'name'=>$name,
                    'password'=>$pass,
                ];
                Mail::send('emails.forget-password', $message, function ($message) use($email) {
                    $message->from('john@johndoe.com', 'Semster');
                    $message->to($email, "Dear Admin");
                    $message->replyTo('john@johndoe.com', 'Semster'); 
                    $message->subject('New Password',"Forget Password-Semster");
                });
                Toastr::success('Please check your email for new password', 'Success');

                return redirect('admin');

            }else{
                Toastr::error('Email does not exist!', 'Error');

                return redirect()->back();
            }
        }
        return view('backend.forget-pass');
    }

    public function profile(Request $request){
            if ($request->isMethod('POST')) {
                $this->validate($request,[
                    'new'=>'required',
                    'old'=>'required',
                ]);
                $old=$request->old;
                $new=$request->new;
                $userCount=Admin::where(['email'=>Session::get('adminSession'),'password'=>md5($old)])->count();
                if ($userCount>0) {

                   $pass=md5($new);
                   Admin::where('email',Session::get('adminSession'))->update(['password'=>$pass]);
                   return redirect('admin/profile')->with('success_msg','Password has been updated');

                } else {
                    return redirect('admin/profile')->with('error_msg','Password didn\'t matched');
                }
            }

        return view('backend.profile');

    }
    public function logout(){
        Session::flush();
        return redirect('/admin')->with('success_msg','Logged out Successfully ');
    }
    public function examineesList(){
        $users=User::all();
        return view('backend.users',compact('users'));
    }
    public function examineeStatusChange( $status=null,$id=null){
        $user=User::findOrFail($id);
        $user->status=$status;
        $user->save();
        Toastr::success("Status has been Change");
        return redirect()->back();
    }
    public function examineeDelete($id=null){
        $user=User::findOrFail($id);
        $user->delete();
        Toastr::success("Examinee Account has been Deleted");
        return redirect()->back();
    }
    
    public function examineesAnswersheetList($id=null){
        $check=UserAns::where('user_id',$id)->count();
        if($check>0){
        $userDetails=User::where('id',$id)->first();
        $userAns=UserAns::where('user_id',$id)->orderBy('id','DESC')->get();
        return view('backend.show-ans-list',compact('userAns','userDetails'));
        }else{
            Toastr::error("Examinee is not participate in the exam");
             return redirect()->back();
        }
    }
    public function examineesAnswersheet($id=null){
        $check=UserAns::where('user_id',$id)->count();
        if($check>0){
        $userDetails=User::where('id',$id)->first();
        $user=UserAns::where('user_id',$id)->orderBy('id','DESC')->first();
        //$user_ques_no= $user->ques_no;
        $user_ques= explode("=>ques<=",$user->ques);
        $user_ans= explode("=>ans<=",$user->user_ans);
        //return $user_ques;

        $ques_answers= array_combine($user_ques,$user_ans);
        return view('backend.show-ans',compact('ques_answers','user','userDetails'));
        }else{
            Toastr::error("Examinee is not participate in the exam");
             return redirect()->back();
        }
    }
}
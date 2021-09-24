<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use App\UserAns;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function exam(){
$userCheck=User::where('email',Session::get('userSession'))->first();
        if ($userCheck->status!=1) {
            return view('frontend.disable');
        }
        // $userAns=UserAns::where('user_id',$userCheck->id)->count();
        // return view('frontend.exam');
    }
    public function startTest(){
$userCheck=User::where('email',Session::get('userSession'))->first();
        if ($userCheck->status!=1) {
            return view('frontend.disable');
        }

        $userAns=UserAns::where('user_id',$userCheck->id)->count();
        
        if ($userAns>0) {
            Toastr::error('You are already participate in the exam.', 'Not Allow to exam!!');
            return redirect()->back();
        }
        return view('frontend.start-test');
    }
    public function loginForm(){
        if (!empty(Session::get('userSession'))) {
            return redirect('exam');
        }else{
        return view('frontend.login');
        }
    }
    public function login(Request $request){
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required',
        ]);
        $data=$request->all();
        $countUser=User::where(['email' => $data['email'], 'password' => md5($data['password'])])->count();
        $countUsername=User::where(['username' => $data['email'], 'password' => md5($data['password'])])->count();
            if($countUser>0){
                $user=User::where(['email' => $data['email']])->first();
               // echo "<pre>";print_r($user);die;
                if ($user->status==0) {
                    Toastr::info('Your account is not active.Please Contact with admin.', 'Inform to Admin');
                    return redirect()->back();
                }
                if ($user->status==2) {
                    Toastr::info('Your account is not varified.Please varify your email address.', 'Account is not varified!!');
                    return redirect()->back();
                }
                Session::put('userSession',$data['email']);
                Session::put('name',$user->name);
                return redirect('/exam');
            }elseif($countUsername>0){
                 $user=User::where(['username' => $data['email']])->first();
               // echo "<pre>";print_r($user);die;
                if ($user->status==0) {
                    Toastr::info('Your account is not active.Please Contact with admin.', 'Inform to Admin');
                    return redirect()->back();
                }
                if ($user->status==2) {
                    Toastr::info('Your account is not varified.Please varify your email address.', 'Account is not varified!!');
                    return redirect()->back();
                }
                Session::put('userSession',$user->email);
                Session::put('name',$user->name);
                return redirect('/exam');
            }else {
                Toastr::error('User or Password don\'t matched', 'Error');
                return redirect()->back();
            }

    }

    public function registrationForm(){
        return view('frontend.register');
    }
    public function registrationStore(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'username'=>'required|unique:users,username',
            'email'=>'required|email|unique:users,email',
            'password'=>'required',
        ]);
        if ($request->isMethod('post')) {
            $data=$request->all();
            $countEmail=User::where('email',$data['email'])->count();
            $countUsername=User::where('username',$data['username'])->count();
            if ($countEmail>0) {
                Toastr::error('This email already exist', 'Error');

                return redirect()->back();
            }else if($countUsername>0){
                Toastr::error('This username already exist', 'Exist!');

                return redirect()->back();
            }else{
                $user=new User();
                $user->name=$data['name'];
                $user->username=$data['username'];
                $user->email=$data['email'];
                $user->password=md5($data['password']);
                $user->status=2;
                $user->save();

                //registration confirmation email
                $email=$data['email'];
                $messageData=["email"=>$data['email'],"name"=>$data['name'],'code'=>base64_encode($email)];
                /*Mail::send('emails.register-confirm', $messageData, function ($message) use($email){
                    $message->to($email)->subject('Confirm your email account');
                });*/
                Mail::send('emails.register-confirm', $messageData, function ($message) use($email) {
                    $message->from('john@johndoe.com', 'Semster');
                    $message->to($email, "Dear User");
                    $message->replyTo('john@johndoe.com', 'Semster'); 
                    $message->subject('Confirm your email account');
                });

                Toastr::success('Please Confirm your email to activate your account.', 'Confirm!');

                return redirect()->back();
               if( Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
                Session::put('userSession',$data['email']);
                    return redirect('exam');
               }

            }
       }
    }

    public function userConfirmEmail($email){
        $email=base64_decode($email);
        $user=User::where('email',$email)->count();
        if ($user>0) {
            $userCheck=User::where('email',$email)->first();
            if ($userCheck->status==1) {
                Toastr::info('Your account already activated. You can login.', 'Already Activated!!');

                return redirect('/');
            }else{
                User::where('email',$email)->update(['status'=>1]);
                //account activated email
               $messageData=["email"=>$email,"name"=>$userCheck->name];
               Mail::send('emails.welcome', $messageData, function ($message) use($email){
                   $message->from('john@johndoe.com', 'Semster');
                    $message->to($email, "Dear User");
                    $message->replyTo('john@johndoe.com', 'Semster'); 
                    $message->subject('Welcome to Semster');
               });
               Toastr::success('Your account has  activated successfully. Please login now.', 'Success');

                return redirect('/');
            }
        } else {
            abort(404);
        }

    }
    public function forgetPassword(Request $request){
        if ($request->isMethod('post')) {
            $this->validate($request,[
                'email'=>'required|email',
            ]);
            $countEmail=User::where('email',$request->email)->count();
            if ($countEmail>0) {
                $user=User::where('email',$request->email)->first();
                $email=$user->email;
                $name=$user->name;
                $pass=Str::random(8);
                $db_pass=md5($pass);
                User::where('email',$email)->update(['password'=>$db_pass]);
                $message=[
                    'email'=>$email,
                    'name'=>$name,
                    'password'=>$pass,
                ];
                Mail::send('emails.forget-password', $message, function ($message) use($email) {
                    $message->from('john@johndoe.com', 'Semster');
                    $message->to($email, "Dear User");
                    $message->replyTo('john@johndoe.com', 'Semster'); 
                    $message->subject('New Password',"Forget Password-Semster");
                });
                Toastr::success('Please check your email for new password', 'Success');

                return redirect('/');

            }else{
                Toastr::error('Email does not exist!', 'Error');

                return redirect()->back();
            }
        }
        return view('frontend.forget-pass');
    }

    public function profile(Request $request){
        $userCheck=User::where('email',Session::get('userSession'))->first();
        if ($userCheck->status!=1) {
            return view('frontend.disable');
        }
            if ($request->isMethod('POST')) {
                $this->validate($request,[
                    'new'=>'required',
                    'old'=>'required',
                ]);
                $old=$request->old;
                $new=$request->new;
                $userCount=User::where(['email'=>Session::get('userSession'),'password'=>md5($old)])->count();
                if ($userCount>0) {

                   $pass=md5($new);
                   User::where('email',Session::get('userSession'))->update(['password'=>$pass]);
                   return redirect('profile')->with('success_msg','Password has been updated');

                } else {
                    return redirect('profile')->with('error_msg','Password didn\'t matched');
                }
            }

        return view('frontend.profile');

    }

    public function logout(){
        Session::flush();
        return redirect('/')->with('success_msg','Logged out Successfully ');
    }
}
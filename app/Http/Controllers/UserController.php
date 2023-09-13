<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //login page
    function LoginPage(){
        return view('pages.auth.login-page');
    }

     //registration page
     function RegistrationPage(){
        return view('pages.auth.registration-page');
    }

     //send OTP page
     function SendOtpPage(){
        return view('pages.auth.send-otp-page');
    }
     //verify OTP page
     function VerifyOTPPage(){
        return view('pages.auth.verify-otp-page');
    }

     //Set password
     function ResetPasswordPage(){
        return view('pages.auth.reset-pass-page');
    }

      //dashboard
      function dashboard(){
        return view('pages.dashboard.dashboard-page');
    }

    //profile
    function profile(){
        return view('pages.dashboard.profile-page');
    }

    function UserRegistration(Request $request){
           
          try{
            User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => $request->input('password'),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User Registration Successfully'
            ],200);

          }catch(Exception $e){
                return response()->json([
                    'status' => 'failed',
                    'message' => 'User Registration Failed'
                ],200);
          }

    }

    function UserLogin(Request $request){

        $count=User::where('email','=',$request->input('email'))
        ->where('password','=',$request->input('password'))
        ->select('id')->first();

        if($count !== null){
            $token = JWTToken::CreateToken($request->input('email'),$count->id);
            return response()->json([
                'status' => 'success',
                'message' => 'User Login Successful'
            ],200)->cookie('token',$token,60*24*30);
        }else{
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
            ],200);
 
        }
    }

    function SendOTPCode(Request $request){
         $email=$request->input('email');
         $otp=rand(1000,9999);
         $count=User::where('email','=',$email)->count();

         if($count==1){
                Mail::to($email)->send(new OTPMail($otp));
                User::where('email','=',$email)->update(['otp'=>$otp]);
                return response()->json([
                    'status' => 'success',
                    'message' => '4 Digit OTP Code has been send to your email !'
                ],200);

         }else{

            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
            ]);

         }

    }

    function VerifyOTP(Request $request){
          $email=$request->input('email');
          $otp=$request->input('otp');

           $count=User::where('email','=',$email)
            ->where('otp','=', $otp)
            ->count();

            if($count==1){
                  // Database OTP Update
                User::where('email','=',$email)->update(['otp'=>'0']);
                  // Pass Reset Token Issue
                $token=JWTToken::CreateTokenForSetPassword($request->input('email'));
                return response()->json([
                    'status' => 'success',
                    'message' => 'OTP Verification Successful'
                ],200)->cookie('token',$token,60*24*30);

            }else{

                return response()->json([
                    'status' => 'failed',
                    'message' => 'unauthorized'
                ],401);

            }

    }


    function ResetPassword(Request $request){

            try{
                $email=$request->header('email');
                
                $password=$request->input('password');
                User::where('email','=',$email)->update(['password'=>$password]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Request Successful',
                ],200);

            }catch (Exception $exception){
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Something Went Wrong',
                ],200);
            }
    }


    function UserLogout(){
        return redirect('/')->cookie('token','',-1);
    }


    function UserProfile(Request $request){
        $email=$request->header('email');
        $user=User::where('email','=',$email)->first();
        return response()->json([
            'status' => 'success',
            'message' => 'Request Successful',
            'data' => $user
        ],200);
    }

    function UpdateProfile(Request $request){
        try{
            $email=$request->header('email');
            $firstName=$request->input('firstName');
            $lastName=$request->input('lastName');
            $mobile=$request->input('mobile');
            $password=$request->input('password');
            User::where('email','=',$email)->update([
                'firstName'=>$firstName,
                'lastName'=>$lastName,
                'mobile'=>$mobile,
                'password'=>$password
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Request Successful',
            ],200);

        }catch (Exception $exception){
            return response()->json([
                'status' => 'fail',
                'message' => 'Something Went Wrong',
            ],200);
        }
    }


}

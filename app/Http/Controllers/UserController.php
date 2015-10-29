<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Str;

use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Contracts\Auth\Guard;

use Auth;
use Hash;
use Session;
use Validator;
use User;
use DB;
use Response;
use Mail;
use Flash;
use Password;
use Socialite;
use Facebook;
use Config;

use App\Model\Users;
use App\Model\Accounter;
use App\Model\PwdReset;
use App\Model\Folders;
use App\Model\PostContent;
use App\Model\PostVideo;
use App\Model\PostImg;
use App\Model\PostMap;


class UserController extends Controller
{
    public function __construct(Guard $auth, PasswordBroker $passwords)
    {
        $this->auth = $auth;
        $this->passwords = $passwords;
        
    }
    //Start signup action
    public function signup(Request $req)
    {
       
        $rules = [
            'email' => 'unique:users'
        ];

        $responses = [];
        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()){
            $responses = ['message' => 'This User had already registered with the his/her email!'];
            return Response::json( $responses );
        }
        else{

            Session::put('sign_up_status', 'true');

            $usrConfirmationCode        = str_random(30);
            $data['verification_code']  = $usrConfirmationCode;
            $date                       = date('Y-m-d H:i:s');
            $token                      = hash('sha256',Str::random(10), false);

            $user = new Users;
            $user->usrFrsName           = $req->input('usrFrsName');
            $user->usrLstName           = $req->input('usrLstName');
            $user->usrName              = $req->input('usrName');
            $user->email                = $req->input('email');
            $user->usrPwd               = Hash::make($req->input('usrPwd'));
            $user->usrPermission        = $req->input('usrPermission');
            $user->usrCountry           = $req->input('usrCountry');
            $user->usrState             = $req->input('usrState');
            $user->usrZipcode           = $req->input('usrZipcode');
            $user->usrGender            = $req->input('usrGender');
            $user->usrRememberToken     = $token;
            $user->usrConfirmed         = 0;
            $user->usrConfirmationCode  = $usrConfirmationCode;
            $user->usrType              = 'manual';
            $user->usrCreatedAt         = $date;
            $user->usrUpdatedAt         = $date;

            $user->save();
            Auth::login($user);

            $rankings = DB::table('accounter')
                        ->get();

            $overRank = 0;
            $stateRank = 0;

            if($rankings)
            {
                $overRank = DB::table('accounter')->max('accOverallRangking');
                $overRank ++;
                $stateRank  = DB::table('accounter')
                            ->join('users', 'users.usrRememberToken', '=', 'accounter.accRememberToken')
                            ->where('users.usrCountry', Auth::user()->usrCountry)
                            ->where('users.usrState', Auth::user()->usrState)
                            ->max('accStateRangking');
                $stateRank ++;
            }
            else{
                $overRank = 1;
                $stateRank = 1;
            }

            $accounter = new Accounter;
            $accounter->accRememberToken    = $token;
            $accounter->accCreatedAt        = $date;
            $accounter->accOverallRangking  = $overRank;
            $accounter->accStateRangking    = $stateRank;
            $accounter->accUpdatedAt        = $date;

            if($req->input('usrPermission') == 'Marketer')
            {
                if($req->input('usrGender') == 'male')
                    $accounter->accImgUrl    = 'images/faces/marketer-male.png';
                else
                    $accounter->accImgUrl    = 'images/faces/marketer-female.png';
            }
            else
            {
                if($req->input('usrGender') == 'male')
                    $accounter->accImgUrl    = 'images/faces/provider-male.png';
                else
                    $accounter->accImgUrl    = 'images/faces/provider-female.png';
            }

            $accounter->save();

            $email = $req->input('email');
            $name  =  $req->input('usrName');

            $sent = \Mail::send('emails.verify', $data, function($message) use ($email, $name) {
                $message->to( $email, $name );

                $message->subject('Verify your email address');
            });

            if($sent == true)
                $responses = ['message' => 'signup_success'];
            else
                $responses = ["message' => 'Don't send message."];
            
            return Response::json( $responses );
        }
        
    }//End signup action

    //Start confirm action
    public function confirmSignup($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            Flash::error('Sorry, Confirm Error!');
        }

        $user = Users::where('usrConfirmationCode', $confirmation_code)->get();

        if ( ! $user)
        {
            Flash::error("Sorry, Don't exit user!");
        }

        
        $date  = date('Y-m-d H:i:s');

        DB::table('users')
            ->where('usrConfirmationCode', $confirmation_code)
            ->update(['usrConfirmed' => 1, 'usrConfirmationCode' => null, 'usrCreatedAt' => $date]);
                
        Session::flash('confirm_alert', 'You have successfully verified your account.');

        return redirect('/');
    }
    //End confirm action

    ////////////////////////////////           Reset Password WorkFlow     //////////////////////////////////////////// 
    
    //Start requestPassword action
    public function requestPassword(Request $req)
    {
        $rules = [
            "email" => "required"
        ];
        $validator = Validator::make($req->all(), $rules);
        
        if ($validator->fails()){
        //validation failed
            Flash::error('Sorry, you entered an incorrect email.');
            return redirect('forget/password');
        } else {
        //validation passed
            $email = $req->input('email');
            try{
                $userEmail = Users::where('email', $email)->first();

                if(!$userEmail)
                {
                    Flash::error('Sorry, you entered an incorrect email or user with such email does not exist.');
                    return redirect('forget/password');
                }

                $credentials = ['email' => $userEmail->email]; 
                $response = $this->passwords->sendResetLink($credentials, function($mail){
                    $mail->subject('Reset your Password');
                });

                switch ($response)
                {
                    case PasswordBroker::RESET_LINK_SENT:
                        $message = 'Email has been sent to ' . $req->input('email').'. Please check your email!';
                        Session::flash('confirm_alert', $message);
                        return redirect('/');
                    break;

                    case PasswordBroker::INVALID_USER:
                        Flash::error('Incorrect email address entered!');
                        return redirect('forget/password');
                    break;
                }
                
            } catch( Exception $e ) {
                Flash::error('Sorry, you entered an incorrect email or user with such email does not exist.12');
                return redirect('forget/password');
            }  
            
        }//end validation
    }
    //End requestPassword action

    //Start resetPassword action
    public function resetPassword($token)
    {
        if( ! $token)
        {
            Flash::error('Confirm code error!');
            return redirect('request');
        }

        $user = DB::table('users')
                ->join('password_resets', 'password_resets.email', '=', 'users.email')
                ->where('password_resets.token', $token)
                ->select('users.usrRememberToken')->first();

        if ( ! $user)
        {
            Flash::error("Don't exit user!");
            return redirect('request');
        }

        return view('user/reset_pwd')
                ->with("title","Reset Password")
                ->with("usrRememberToken", $user->usrRememberToken);
    }
    //End resetPassword action

    //Start updatePassword action
    public function updatePassword($usrRememberToken, Request $req)
    {

        DB::table('users')
            ->where('usrRememberToken', $usrRememberToken)
            ->update(['usrPwd' => Hash::make($req->input('usrPwd'))]);

        $message = 'The password has been reset successfully!';
        Session::flash('confirm_alert', $message);
        return redirect('/');
    }
    //End updatePassword action
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////           Reset Password WorkFlow     //////////////////////////////////////////// 
    
    //Start requestUsername action
    public function requestUsername(Request $req)
    {
        $rules = [
            "email" => "required"
        ];
        $validator = Validator::make($req->all(), $rules);
        
        if ($validator->fails()){
        //validation failed
            Flash::error('Sorry, you entered an incorrect email.');
            return redirect('forget/username');
        } else {
        //validation passed
            $email = $req->input('email');
            $userEmail = Users::where('email', $email)->first();

            if(!$userEmail)
            {
                Flash::error('Sorry, you entered an incorrect email or user with such email does not exist.');
                return redirect('forget/username');
            }

            Mail::send('emails.username', ['usrRememberToken' => $userEmail->usrRememberToken], function ($message) use ($userEmail) {
                $message->to($userEmail->email)->subject('Reset the username');
            });

            $message = 'Email has been sent to ' . $req->input('email').'. Please check your email!';
            Session::flash('confirm_alert', $message);
            return redirect('/');
            
        }//end validation
    }
    //End requestUsername action

    //Start resetPassword action
    public function resetUsername($usrRememberToken)
    {
        if( ! $usrRememberToken)
        {
            Flash::error('Confirm code error!');
            return redirect('/');
        }

        return view('user/reset_username')
                ->with("title","Reset Username")
                ->with("usrRememberToken", $usrRememberToken);
    }
    //End resetPassword action

    //Start updatePassword action
    public function updateUsername($usrRememberToken, Request $req)
    {

        DB::table('users')
            ->where('usrRememberToken', $usrRememberToken)
            ->update(['usrName' => $req->input('usrName')]);

        $message = 'The username has been reset successfully!';
        Session::flash('confirm_alert', $message);
        return redirect('/');
    }
    //End updatePassword action
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //Start login action
    public function login(Request $req)
    {
        $rules = [
            'email' => 'required',
            'usrPwd' => 'required'
        ];

        $validator = Validator::make($req->all(), $rules);
        $responses = [];

        if ($validator->fails()){
            $responses = ['message' => 'Please enter the email or password please!'];
            return Response::json( $responses );
        }

        $user = Users::where('email', '=', $req->input('email'))->first();

        if($user){
            if ( Hash::check($req->input('usrPwd'), $user->usrPwd) ) {
                Auth::login($user);
                $responses = ['message' => 'login_success'];
                return Response::json( $responses );
            }
            else
            {
                $responses = ['message' => 'You are not user, please register!'];
                return Response::json( $responses );
            }
        }
        
        else{
            $responses = ['message' => 'You are not user, please register!'];
            return Response::json( $responses );
        }
    }
    //End login action

    //Start logout action
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
    //End logout action

    //Start redirectToProviderForFacebook action
    public function redirectToProviderForFacebook()
    {
        //return Socialite::driver('facebook')->redirect();
        return Socialite::driver('facebook')->fields([
            'first_name', 'last_name', 'email', 'gender', 'birthday'
        ])->scopes([
            'email', 'user_birthday'
        ])->redirect();
    }
    //End redirectToProviderForFacebook action

    //Start handleProviderCallbackForFacebook action
    public function handleProviderCallbackForFacebook()
    {
        $facebook_user = Socialite::driver('facebook')->fields([
            'first_name', 'last_name', 'email', 'gender', 'birthday'
        ])->user();

        $exit_user = Users::where('usrSocialId', $facebook_user->user['id'])->where('usrType', 'facebook')->first();

        if ( !empty($exit_user) )
        {
            Flash::error("The User has already registered!");
            return redirect('/');
        }

        $data = ['usrFrsName'       => $facebook_user->user['first_name'],
                  'usrLstName'       => $facebook_user->user['last_name'],
                  'usrGender'        => $facebook_user->user['gender'],
                  'usrSocialId'      => $facebook_user->user['id'],
                  'usrName'          => $facebook_user->name,
                  'email'            => $facebook_user->email,   
                  'usrRememberToken' => $facebook_user->token];

        $user = new Users;

        $user->usrFrsName       = $data['usrFrsName'];
        $user->usrLstName       = $data['usrLstName'];
        $user->usrGender        = $data['usrGender'];
        $user->usrSocialId      = $data['usrSocialId'];
        $user->usrType          = 'facebook';

        if($data['email'] == null)
            $user->email        = '';
        else
            $user->email        = $data['email'];

        $user->usrRememberToken = $data['usrRememberToken'];
        $user->save();

        return view('user/social_signup')
                ->with("title","Sign up with facebook")
                ->with("email", $data['email'])
                ->with("usrSocialId", $data['usrSocialId'])
                ->with("userType", "facebook");
    }
    //End handleProviderCallbackForFacebook action

    //Start social_signup action
    public function social_signup(Request $req, $usrSocialId, $userType)
    {
        $date = date('Y-m-d H:i:s');
        DB::table('users')
            ->where('usrSocialId', $usrSocialId)
            ->where('usrType', $userType)
            ->update(['email' => $req->input('email'), 'usrPwd' => Hash::make($req->input('password')), 'usrPermission' => $req->input('usrPermission'), 'usrConfirmed' => 1,  'usrCreatedAt' => $date, 'usrUpdatedAt' => $date]);
            
        $message = 'You have successfully created your account with the'.$userType.'.';
        Session::flash('confirm_alert', $message);
        return redirect('/');
    }
    //End social_signup action

    //Start redirectToProviderForTwitter action
    public function redirectToProviderForTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }
    //End redirectToProviderForTwitter action

    //Start handleProviderCallbackForTwitter action
    public function handleProviderCallbackForTwitter()
    {

        $twitter_user = Socialite::driver('twitter')->user();

        $exit_user = Users::where('usrSocialId', $twitter_user->user['id_str'])->where('usrType', 'twitter')->first();

        if ( !empty($exit_user) )
        {
            Flash::error("The User has already registered!");
            return redirect('/');
        }

        $data = [
  //                'usrFrsName'       => $facebook_user->user['first_name'],
  //                'usrLstName'       => $facebook_user->user['last_name'],
  //                'usrGender'        => $facebook_user->user['gender'],
                  'usrSocialId'      => $twitter_user->user['id_str'],
                  'usrName'          => $twitter_user->name,
                  'email'            => $twitter_user->email,   
                  'usrRememberToken' => $twitter_user->token];

        $user = new Users;

 //       $user->usrFrsName       = $data['usrFrsName'];
 //       $user->usrLstName       = $data['usrLstName'];
 //       $user->usrGender        = $data['usrGender'];
        $user->usrSocialId      = $data['usrSocialId'];
        $user->usrName          = $data['usrName'];
        $user->usrType          = 'twitter';

        if($data['email'] == null)
            $user->email        = '';
        else
            $user->email        = $data['email'];

        $user->usrRememberToken = $data['usrRememberToken'];
        $user->save();

        return view('user/social_signup')
                ->with("title","Sign up with twitter")
                ->with("email", $data['email'])
                ->with("usrSocialId", $data['usrSocialId'])
                ->with("userType", "twitter");
        // $user->token;
    }
    //End handleProviderCallbackForTwitter action
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use Response;
use DB;
use Session;

use App\Model\Users;
use App\Model\Accounter;
use App\Model\Mails;
use App\Model\Folders;
use App\Model\PostContent;
use App\Model\PostVideo;
use App\Model\PostImg;
use App\Model\PostMap;
use App\Model\FriendRequest;
use App\Model\TimeLine;

class HomeController extends Controller
{
    public function inboxMail()
    {
        $messages = DB::table('mails')
                  ->join('users', 'users.email', '=', 'mails.malFrom')
                  ->join('accounter', 'accounter.accRememberToken', '=', 'users.usrRememberToken')
                  ->where('malTo', Auth::user()->email)
                  ->where('malRead', 0)
                  ->select('usrFrsName', 'usrLstName', 'accImgUrl', 'malSubject')
                  ->get();

        return $messages;
    }

    public function index()
    {
        return view('home/index')
        ->with("title","Oraisen");
    }

    public function marketer()
    {   
        $products   = DB::table('products')
                    ->where('pdtPostPermission', 1)
                    ->get();

        $permission = false;

        if(Auth::user()->usrPermission == 'Provider')
            $permission = true;
        else
            $permission = false;

        $msgs = $this->inboxMail();

        return view('home/marketer')
                ->with("title","Market Place")
                ->with("msgs", $msgs)
                ->with('products', $products)
                ->with('permission', $permission);
    }

    public function profile()
    {
        $info = [];

        $user = DB::table('accounter')
                ->join('users', 'users.usrRememberToken', '=', 'accounter.accRememberToken')
                ->where('users.usrRememberToken', Auth::user()->usrRememberToken)
                ->first();

        $timelines  = DB::table('timeline')
                    ->orderBy('tlnId','DESC')
                    ->get();

        $timeline_data = [];
        $count = 0;

        foreach ($timelines as $tln) {

            $array_data = [];

            switch ($tln->tlnType) {
                    case 0:
                        $data = DB::table('post_content')
                             ->where('pcoId', $tln->tlnPostId)
                             ->where('pcoToken', Auth::user()->usrRememberToken)
                             ->first();

                        if($data){
                            $date = $data->pcoDate;
                            $dt = strtotime($date);  
                            $data->pcoDate = date("jS F, Y", $dt); 

                            $array_data = array_merge($array_data, ['type' => 0]);
                            $array_data = array_merge($array_data, ['type_img' => 'images/pencil.png']);
                            $array_data = array_merge($array_data, ['url' => $data->pcoContent]);
                            $array_data = array_merge($array_data, ['favor_number' => $data->pcoNumber]);
                            $array_data = array_merge($array_data, ['date' => $data->pcoDate]);
                        }
                               
                    break;

                    case 1:
                        $data = DB::table('post_img')
                             ->where('pimId', $tln->tlnPostId)
                             ->where('pimToken', Auth::user()->usrRememberToken)
                             ->first();

                        if($data){
                            $date = $data->pimDate;
                            $dt = strtotime($date);  
                            $data->pimDate = date("jS F, Y", $dt); 

                            $array_data = array_merge($array_data, ['type' => 1]);
                            $array_data = array_merge($array_data, ['type_img' => 'images/photo-active.png']);
                            $array_data = array_merge($array_data, ['url' => $data->pimImg]);
                            $array_data = array_merge($array_data, ['favor_number' => $data->pimNumber]);
                            $array_data = array_merge($array_data, ['date' => $data->pimDate]);
                        }                                              

                    break;

                    case 2:
                        $data = DB::table('post_vid')
                             ->where('pviId', $tln->tlnPostId)
                             ->where('pviToken', Auth::user()->usrRememberToken)
                             ->first();

                        if($data)
                        {
                            $date = $data->pviDate;
                            $dt = strtotime($date);  
                            $data->pviDate = date("jS F, Y", $dt); 

                            $array_data = array_merge($array_data, ['type' => 2]);
                            $array_data = array_merge($array_data, ['type_img' => 'images/video-active.png']);
                            $array_data = array_merge($array_data, ['url' => $data->pviVideo]);
                            $array_data = array_merge($array_data, ['favor_number' => $data->pviNumber]);
                            $array_data = array_merge($array_data, ['date' => $data->pviDate]);
                        }
                                             
                    break;

                    case 3:
                        $data = DB::table('post_map')
                             ->where('pmaId', $tln->tlnPostId)
                             ->where('pmaToken', Auth::user()->usrRememberToken)
                             ->first();

                        if($data)
                        {
                            $date = $data->pmaDate;
                            $dt = strtotime($date);  
                            $data->pmaDate = date("jS F, Y", $dt);

                            $array_data = array_merge($array_data, ['type' => 3]);
                            $array_data = array_merge($array_data, ['type_img' => 'images/location-active.png']);
                            $array_data = array_merge($array_data, ['url' => $data->pmaMap]);
                            $array_data = array_merge($array_data, ['favor_number' => $data->pmaNumber]);
                            $array_data = array_merge($array_data, ['date' => $data->pmaDate]);
                        }                   
                        
                    break;
                                       
            }
            
            $array_data = array_merge($array_data, ['tlnId' => $tln->tlnId]);

            if($data){
                array_push($timeline_data, $array_data); 
                $count ++;
            }


        }

   
        $arr = explode(';', $user->accFriends);
        $boolCheckFriend = in_array(Auth::user()->usrRememberToken, $arr);

        $friends = [];

        foreach ($arr as $value) {
            if($value)
            {
                $fri    = DB::table('users')
                        ->join('accounter', 'users.usrRememberToken', '=', 'accounter.accRememberToken')
                        ->where('usrRememberToken', $value)
                        ->first();

                array_push($friends, $fri);    
            }
        }

        $msgs = $this->inboxMail();

        return view('home/profile')
                ->with("title","User Profile")
                ->with("msgs", $msgs)
                ->with('user', $user)
                ->with('timeline_data', $timeline_data)
                ->with('boolCheckFriend', $boolCheckFriend)
                ->with('friends', $friends)
                ->with('boolAuth', true);
    }

    public function referrals()
    {
        $msgs = $this->inboxMail();

        return view('home/referrals')
        ->with("title","Referrals")
        ->with("msgs", $msgs);
    }


    public function ranking()
    {
        $usersByOverall = DB::table('accounter')
                        ->join('users', 'users.usrRememberToken', '=', 'accounter.accRememberToken')
                        ->join('post_img', 'users.usrRememberToken', '=', 'post_img.pimToken')
                        ->where('usrPermission', Auth::user()->usrPermission)
                        ->orderBy('accOverallRangking', 'ASC')
                        ->select('pimImg', 'usrFrsName', 'usrLstName', 'usrCountry', 'usrState', 'accOverallRangking', 'accStateRangking', 'accImgUrl')
                        ->get();


        $msgs = $this->inboxMail();

        return view('home/ranking')
        ->with("title","Ranking")
        ->with("msgs", $msgs)
        ->with("usersByOverall", $usersByOverall);
    }

    public function updateProfile(Request $req)
    {

        $result = DB::table('users')
        ->where('usrRememberToken', Auth::user()->usrRememberToken)
        ->update(['usrFrsName' => $req->input('usrFrsName'), 'usrLstName' => $req->input('usrLstName'), 'usrZipcode' => $req->input('usrZipcode')]);

        if($result >= 1)
        {
            $responses = ['status' => 'success'];
        }
        else
            $responses = ['status' => 'error'];

        return Response::json( $responses );
    }

    public function statistic()
    {
        $msgs = $this->inboxMail();

        return view('home/statistic')
        ->with("title","Statistics")
        ->with("msgs", $msgs);
    }

    public function setting()
    {
        $account = DB::table('accounter')
                ->where('accounter.accRememberToken', Auth::user()->usrRememberToken)
                ->first();

        $msgs = $this->inboxMail();

        return view('home/setting')
        ->with("title","Setting")
        ->with("msgs", $msgs)
        ->with('img', $account->accImgUrl);
    }

    public function dashboard()
    {
        $user = Auth::user();

        $account = DB::table('accounter')
                ->where('accounter.accRememberToken', $user->usrRememberToken)
                ->first();

        $signup = Session::get('sign_up_status');

        if($signup == true)
            Session::put('sign_up_status', 'false');

        $msgs = $this->inboxMail();

        return view('home/dashboard')
            ->with("title", "Dashboard")
            ->with("msgs", $msgs)
            ->with("user", $user)
            ->with('signup', $signup)
            ->with('account', $account);
    }

    public function business()
    {
        $msgs = $this->inboxMail();

        return view('home/business')
        ->with("title","Business Profile")
        ->with("msgs", $msgs);
    }

    public function mail()
    {
        $mails = DB::table('mails')
                ->join('users', 'mails.malFrom', '=', 'users.email')
                ->where('malTo', Auth::user()->email)
                ->get();
               
        $serverDate=getdate();
       
       $countInbox = 0;
       $countDraft = 0;

       $countDraft = DB::table('mails')
                ->where('malFrom', Auth::user()->email)
                ->where('malType', 3)
                ->count();

       foreach ($mails as $mail) {
            if($mail->malRead == 0 && $mail->malType == 0)
                $countInbox ++;
       }
        if($countInbox == 0)
            $countInbox = '';
        if($countDraft == 0)
            $countDraft = '';

       $counts = ['inbox' => $countInbox, 'draft' => $countDraft];

       $fldNames = DB::table('mail_folders')
                    ->where('mfdOwnerEmail', Auth::user()->email)
                    ->select('mfdName')
                    ->get();

        $msgs = $this->inboxMail();

        return view('home/mail')
        ->with("title", "Mail")
        ->with("msgs", $msgs)
        ->with("mails", $mails)
        ->with("counts", $counts)
        ->with("flds", $fldNames);
    }

    public function selectMail(Request $req)
    {
        $id = $req->input('id');

        $mail = DB::table('mails')
                ->join('users', 'mails.malFrom', '=', 'users.email')
                ->where('malId', $id)
                ->first();        

        DB::table('mails')
            ->where('malId', $id)
            ->update(['malRead' => 1]);

        $mails = DB::table('mails')
                ->join('users', 'mails.malFrom', '=', 'users.email')
                ->where('malTo', Auth::user()->email)
                ->get();

        $countInbox = 0;

       foreach ($mails as $ma) {
           if($ma->malRead == 0 && $ma->malType == 0)
                $countInbox ++;
       }

       $counts = ['inbox' => $countInbox];

        return Response::json([
                    'mail'   => $mail,
                    'counts' => $counts
                ]); 
    }

    public function selectDraft(Request $req)
    {
        $id = $req->input('id');

        $mail = DB::table('mails')
                ->join('users', 'mails.malFrom', '=', 'users.email')
                ->where('malId', $id)
                ->first();        

        return Response::json([
                    'mail'   => $mail
                ]); 
    }

    public function draftMail(Request $req)
    {

        $mail = new Mails;
        $mail->malSubject           = $req->input('msg_subject');
        $mail->malContent           = $req->input('msg_content');
        $mail->malType              = 3;
        $mail->malRead              = 0;
        $mail->malImportant         = 0;
        $mail->malFrom              = Auth::user()->email;
        $mail->malTo                = $req->input('msg_to');

        $mail->save();

        $count = DB::table('mails')
                ->where('malFrom', Auth::user()->email)
                ->where('malType', 3)
                ->count();

        $responses = ['count' => $count];
        return Response::json( $responses );
    }

    public function showInbox()
    {
        $mails = DB::table('mails')
                ->join('users', 'mails.malFrom', '=', 'users.email')
                ->where('malTo', Auth::user()->email)
                ->get();

        $count = DB::table('mails')
                ->where('malTo', Auth::user()->email)
                ->where('malRead', 0)
                ->count();

        return Response::json([
                    'mails'   => $mails,
                    'count'   => $count
                ]); 
    }

    public function showDraft()
    {
        $mails = DB::table('mails')
                ->where('malFrom', Auth::user()->email)
                ->where('malType', 3)
                ->get();

        return Response::json([
                    'mails'   => $mails
                ]); 
    }

    public function showSent()
    {
        $mails = DB::table('mails')
                ->join('users', 'mails.malFrom', '=', 'users.email')
                ->where('malFrom', Auth::user()->email)
                ->where('malType', 0)
                ->get();

        return Response::json([
                    'mails'   => $mails
                ]); 
    }

    public function sendMessage(Request $req)
    {
        $rules = [
            "to"        => "required",
            "subject"   => "required",
            "msg"       => "required"
        ];

        $validator = Validator::make($req->all(), $rules);
        $responses = [];

        if ($validator->fails()){
            $responses = ['message' => 'Please enter the all inputs!'];
            return Response::json( $responses );
        }

        $user = Users::where('email', '=', $req->input('to'))->first();

        if($user){

            /*
                malType: 0 = inbox, 1 = Draft, 2 = Sent, 3 = Trash, 4 = spam
                malImportant: 0 = unimportant, 1 = important
                malRead: 0 = unread, 1 = read
            */
            $message_content = '<textarea class="content">';
            $message_content .= $req->input('msg');
            $message_content .='</textarea>';

            $mail = new Mails;
            $mail->malSubject           = $req->input('subject');
            $mail->malContent           = $message_content;
            $mail->malType              = 0;
            $mail->malRead              = 0;
            $mail->malImportant         = 0;
            $mail->malFrom              = Auth::user()->email;
            $mail->malTo                = $req->input('to');

            $mail->save();
            $responses = ['message' => 'send_success'];
            return Response::json( $responses );
        }
        
        else{
            $responses = ['message' => "Receiver doesn't exit! Correctly insert receiver."];
            return Response::json( $responses );
        }
    }

    public function showFolder()
    {
        $fldNames = DB::table('mail_folders')
                ->where('mfdOwnerEmail', Auth::user()->email)
                ->select('mfdName')
                ->get();

        if( empty ($fldNames) )
        {
            $responses = ['state' => 'none'];
            return Response::json( $responses ); 
        }
        else{
            $responses = ['state' => 'success', 'fldNames' => $fldNames ];
            return Response::json( $responses );
        }
    }

    public function createFolder(Request $req)
    {
        $fldName = DB::table('mail_folders')
                    ->where('mfdName', $req->input('fldName'))
                    ->first();

        if($fldName)
        {
            $responses = ['alert' => 'The Folder Existed', 'state' => 'exit'];
            return Response::json( $responses );    
        }

        $fld = new Folders;
        $fld->mfdName       = $req->input('fldName');
        $fld->mfdOwnerEmail =  Auth::user()->email;
        $fld->mfdMailIds    = '';
        $fld->save();

        $fldNames = DB::table('mail_folders')
                    ->where('mfdOwnerEmail', Auth::user()->email)
                    ->select('mfdName')
                    ->get();
        $responses = ['fldNames' => $fldNames, 'state' => 'success'];
        return Response::json( $responses );           
    }

    public function moveToFolder(Request $req)
    {
        $messages = $req->input('groupArr');
        $fldMailIds = DB::table('mail_folders')
                    ->where('mfdName', $req->input('fldName'))
                    ->select('mfdMailIds')
                    ->first();
        $string = '';

        if($fldMailIds != '')
        {
            $arr = explode(';', $fldMailIds->mfdMailIds);
            $memo = array_merge($arr, $messages);
            $messages = array_unique($memo);             
        }
        
        $string = implode(";", $messages);

        $result = DB::table('mail_folders')
                ->where('mfdName', $req->input('fldName'))
                ->update(['mfdMailIds' => $string]);

        $mails = array();

        foreach ($messages as $msgId) {
            if($msgId != '')
            {
                $arr = DB::table('mails')
                     ->where('malId', $msgId)
                     ->first();

                array_push($mails, $arr);
            }
        }

        $responses = ['status' => 'success!'];
        return Response::json( $responses );    
    }

    public function selectFolder(Request $req)
    {

        $mfdMailIds = DB::table('mail_folders')
                    ->where('mfdName', $req->input('id'))
                    ->select('mfdMailIds')
                    ->first();

        $mailIdArray = explode(';', $mfdMailIds->mfdMailIds);
        $mails = array();

        foreach ($mailIdArray as $msgId) {
            if($msgId != '')
            {
                $arr = DB::table('mails')
                     ->where('malId', $msgId)
                     ->first();

                array_push($mails, $arr);
            }
        }

        $responses = ['mails' => $mails];
        return Response::json( $responses ); 
    }

    public function deleteFolder(Request $req)
    {
        $result = DB::table('mail_folders')
                ->where('mfdName', $req->input('fldName'))
                ->delete();

        $success = false;

        if($result == 0)
            $success = false;
        else
            $success = true;

        $responses = ['status' => $success];
        return Response::json( $responses ); 
    }

    public function invoices()
    {
        $msgs = $this->inboxMail();

        return view('home.invoices')
                ->with("title","Invoices")
                ->with("msgs", $msgs);
    }

    public function post_info(Request $req)
    {

        $date = date('Y-m-d H:i:s');
        $max_favor = DB::table('post_content')
                      ->join('users', 'users.usrRememberToken', '=', 'post_content.pcoToken')
                      ->where('users.usrRememberToken', $req->input('token'))
                      ->max('pcoNumber');

        $content_id = 0;
        $favorNumber = 1;

        if(!$max_favor)
            $favorNumber = 1;
        else{
            $favorNumber = $max_favor;
            $favorNumber ++;
        }

        $con = new PostContent;
        $con->pcoContent    = $req->input('content');
        $con->pcoDate       = $date;
        $con->pcoToken      = $req->input('token');
        $con->pcoNumber     = $favorNumber;

        $con->save();

        $content_id = $con->pcoId;

        $post = new Timeline;
        $post->tlnType = 0;
        $post->tlnPostId = $content_id;
        $post->save();

        $timelines  = DB::table('timeline')
                    ->orderBy('tlnId','DESC')
                    ->get();

        $timeline_data = [];

        foreach ($timelines as $tln) {

            $array_data = [];

            switch ($tln->tlnType) {
                    case 0:
                        $data = DB::table('post_content')
                             ->where('pcoId', $tln->tlnPostId)
                             ->where('pcoToken', Auth::user()->usrRememberToken)
                             ->first();

                        if($data){
                            $date = $data->pcoDate;
                            $dt = strtotime($date);  
                            $data->pcoDate = date("jS F, Y", $dt); 

                            $array_data = array_merge($array_data, ['type' => 0]);
                            $array_data = array_merge($array_data, ['type_img' => 'images/pencil.png']);
                            $array_data = array_merge($array_data, ['url' => $data->pcoContent]);
                            $array_data = array_merge($array_data, ['favor_number' => $data->pcoNumber]);
                            $array_data = array_merge($array_data, ['date' => $data->pcoDate]);
                        }
                               
                    break;

                    case 1:
                        $data = DB::table('post_img')
                             ->where('pimId', $tln->tlnPostId)
                             ->where('pimToken', Auth::user()->usrRememberToken)
                             ->first();

                        if($data){
                            $date = $data->pimDate;
                            $dt = strtotime($date);  
                            $data->pimDate = date("jS F, Y", $dt); 

                            $array_data = array_merge($array_data, ['type' => 1]);
                            $array_data = array_merge($array_data, ['type_img' => 'images/photo-active.png']);
                            $array_data = array_merge($array_data, ['url' => $data->pimImg]);
                            $array_data = array_merge($array_data, ['favor_number' => $data->pimNumber]);
                            $array_data = array_merge($array_data, ['date' => $data->pimDate]);
                        }                                              

                    break;

                    case 2:
                        $data = DB::table('post_vid')
                             ->where('pviId', $tln->tlnPostId)
                             ->where('pviToken', Auth::user()->usrRememberToken)
                             ->first();

                        if($data)
                        {
                            $date = $data->pviDate;
                            $dt = strtotime($date);  
                            $data->pviDate = date("jS F, Y", $dt); 

                            $array_data = array_merge($array_data, ['type' => 2]);
                            $array_data = array_merge($array_data, ['type_img' => 'images/video-active.png']);
                            $array_data = array_merge($array_data, ['url' => $data->pviVideo]);
                            $array_data = array_merge($array_data, ['favor_number' => $data->pviNumber]);
                            $array_data = array_merge($array_data, ['date' => $data->pviDate]);
                        }
                                             
                    break;

                    case 3:
                        $data = DB::table('post_map')
                             ->where('pmaId', $tln->tlnPostId)
                             ->where('pmaToken', Auth::user()->usrRememberToken)
                             ->first();

                        if($data)
                        {
                            $date = $data->pmaDate;
                            $dt = strtotime($date);  
                            $data->pmaDate = date("jS F, Y", $dt);

                            $array_data = array_merge($array_data, ['type' => 3]);
                            $array_data = array_merge($array_data, ['type_img' => 'images/location-active.png']);
                            $array_data = array_merge($array_data, ['url' => $data->pmaMap]);
                            $array_data = array_merge($array_data, ['favor_number' => $data->pmaNumber]);
                            $array_data = array_merge($array_data, ['date' => $data->pmaDate]);
                        }                   
                        
                    break;
                                       
            }

            if($data){
                array_push($timeline_data, $array_data); 
            }


        }

        $responses = ['timeline_data' => $timeline_data];
        return Response::json( $responses );
    }

    public function addFriend(Request $req)
    {
       if( $req->input('token') == Auth::user()->usrRememberToken)
       {
            $responses = ['status' => 'owner'];
            return Response::json( $responses );
       }
       else
       {
            $request = DB::table('friend_request')
                    ->where('freFromToken', Auth::user()->usrRememberToken)
                    ->where('freToToken', $req->input('token'))
                    ->first();

            if($request)
            {
                if($request->freStatus == 1)
                {
                    $responses = ['status' => 'success', 'msg' => 'You are already friend with him.'];
                    return Response::json( $responses );
                }
                else if($request->freStatus == 0)
                {
                    $responses = ['status' => 'success', 'msg' => 'You already sent add friend request'];
                    return Response::json( $responses );
                }
                else{

                    $result = DB::table('friend_request')
                            ->where('freFromToken', Auth::user()->usrRememberToken)
                            ->where('freToToken', $req->input('token'))
                            ->delete();
                }
            }

            $friend = DB::table('users')
                    ->where('usrRememberToken', $req->input('token'))
                    ->first();

            if(!$friend)
            {
                $responses = ['status' => 'success', 'msg' => 'Fail to send request.'];
                return Response::json( $responses );
            }

            $mail_content = "<div class='friend-form' usr-token='";
            $mail_content .= Auth::user()->usrRememberToken;
            $mail_content .= "'><div> From ";
            $mail_content .= $friend->usrName;
            $mail_content .= " Add friend request is come";
            $mail_content .= "</div><button class='request-accept'>Accept</button><button class='request-decline'>Decline</button></div>";

            $mail = new Mails;
            $mail->malSubject           = 'Add Friend Request';
            $mail->malContent           = $mail_content;
            $mail->malType              = 0;
            $mail->malRead              = 0;
            $mail->malImportant         = 0;
            $mail->malFrom              = Auth::user()->email;
            $mail->malTo                = $friend->email;

            $mail->save();

            $add = new FriendRequest;
            $add->freFromToken  = Auth::user()->usrRememberToken;
            $add->freToToken    = $req->input('token');
            $add->freStatus     = 0;

            $add->save();
            
            $responses = ['status' => 'success', 'msg' => 'Add friend request is sent Successfully.'];
            return Response::json( $responses );
       }
    }

    public function searchFriend(Request $req){
    
        $user   = DB::table('users')
                ->where('usrName', $req->input('usrName'))
                ->first();

        if(!$user)
        {
            $responses = ['status' => 'error'];
            return Response::json( $responses );
        }
        else
        {
            $token = $user->usrRememberToken;
            $responses = ['status' => 'success', 'usrName' => $req->input('usrName') ];
            return Response::json( $responses );
        }
    }

    public function friendProfile($usrName)
    {

        $info = [];

        $user = DB::table('accounter')
                ->join('users', 'users.usrRememberToken', '=', 'accounter.accRememberToken')
                ->where('users.usrName', $usrName)
                ->first();

        $timelines  = DB::table('timeline')
                    ->orderBy('tlnId','DESC')
                    ->get();

        $timeline_data = [];

        if($usrName == Auth::user()->usrName) 
        {
            foreach ($timelines as $tln) {

                $array_data = [];

                switch ($tln->tlnType) {
                        case 0:
                            $data = DB::table('post_content')
                                 ->where('pcoId', $tln->tlnPostId)
                                 ->where('pcoToken', Auth::user()->usrRememberToken)
                                 ->first();

                            if($data){
                                $date = $data->pcoDate;
                                $dt = strtotime($date);  
                                $data->pcoDate = date("jS F, Y", $dt); 

                                $array_data = array_merge($array_data, ['type' => 0]);
                                $array_data = array_merge($array_data, ['type_img' => 'images/pencil.png']);
                                $array_data = array_merge($array_data, ['url' => $data->pcoContent]);
                                $array_data = array_merge($array_data, ['favor_number' => $data->pcoNumber]);
                                $array_data = array_merge($array_data, ['date' => $data->pcoDate]);
                            }
                                   
                        break;

                        case 1:
                            $data = DB::table('post_img')
                                 ->where('pimId', $tln->tlnPostId)
                                 ->where('pimToken', Auth::user()->usrRememberToken)
                                 ->first();

                            if($data){
                                $date = $data->pimDate;
                                $dt = strtotime($date);  
                                $data->pimDate = date("jS F, Y", $dt); 

                                $array_data = array_merge($array_data, ['type' => 1]);
                                $array_data = array_merge($array_data, ['type_img' => 'images/photo-active.png']);
                                $array_data = array_merge($array_data, ['url' => $data->pimImg]);
                                $array_data = array_merge($array_data, ['favor_number' => $data->pimNumber]);
                                $array_data = array_merge($array_data, ['date' => $data->pimDate]);
                            }                                              

                        break;

                        case 2:
                            $data = DB::table('post_vid')
                                 ->where('pviId', $tln->tlnPostId)
                                 ->where('pviToken', Auth::user()->usrRememberToken)
                                 ->first();

                            if($data)
                            {
                                $date = $data->pviDate;
                                $dt = strtotime($date);  
                                $data->pviDate = date("jS F, Y", $dt); 

                                $array_data = array_merge($array_data, ['type' => 2]);
                                $array_data = array_merge($array_data, ['type_img' => 'images/video-active.png']);
                                $array_data = array_merge($array_data, ['url' => $data->pviVideo]);
                                $array_data = array_merge($array_data, ['favor_number' => $data->pviNumber]);
                                $array_data = array_merge($array_data, ['date' => $data->pviDate]);
                            }
                                                 
                        break;

                        case 3:
                            $data = DB::table('post_map')
                                 ->where('pmaId', $tln->tlnPostId)
                                 ->where('pmaToken', Auth::user()->usrRememberToken)
                                 ->first();

                            if($data)
                            {
                                $date = $data->pmaDate;
                                $dt = strtotime($date);  
                                $data->pmaDate = date("jS F, Y", $dt);

                                $array_data = array_merge($array_data, ['type' => 3]);
                                $array_data = array_merge($array_data, ['type_img' => 'images/location-active.png']);
                                $array_data = array_merge($array_data, ['url' => $data->pmaMap]);
                                $array_data = array_merge($array_data, ['favor_number' => $data->pmaNumber]);
                                $array_data = array_merge($array_data, ['date' => $data->pmaDate]);
                            }                   
                            
                        break;
                                           
                }

                if($data){
                    array_push($timeline_data, $array_data); 
                }

            }
        }           
          
        $arr = explode(';', $user->accFriends);
        $boolCheckFriend = in_array(Auth::user()->usrRememberToken, $arr);

        $friends = [];

        foreach ($arr as $value) {
            if($value)
            {
                $fri    = DB::table('users')
                        ->join('accounter', 'users.usrRememberToken', '=', 'accounter.accRememberToken')
                        ->where('usrRememberToken', $value)
                        ->first();

                array_push($friends, $fri);    
            }
        }

        $boolAuth = false;

        if(Auth::user()->usrName == $usrName)
            $boolAuth = true;
        else
            $boolAuth = false;

        $msgs = $this->inboxMail();

        return view('home/profile')
                ->with("title","User Profile")
                ->with('msgs', $msgs)
                ->with('user', $user)
                ->with('timeline_data', $timeline_data)
                ->with('boolCheckFriend', $boolCheckFriend)
                ->with('friends', $friends)
                ->with('boolAuth', $boolAuth);
    }

    public function acceptFriend(Request $req)
    {
        $status = DB::table('friend_request')
                    ->where('freFromToken', $req->input('token'))
                    ->where('freToToken', Auth::user()->usrRememberToken)
                    ->first();

        if(!$status)
        {
            $responses = ['msg' =>'Now this button is no longer enable.'];
            return Response::json( $responses );
        }

        if($status->freStatus != 0)
        {
            $responses = ['msg' =>'Now this button is no longer enable.'];
            return Response::json( $responses );
        }

        DB::table('friend_request')
                    ->where('freFromToken', $req->input('token'))
                    ->where('freToToken', Auth::user()->usrRememberToken)
                    ->update(['freStatus' => 1]);

         $friend = DB::table('users')
                    ->where('usrRememberToken', $req->input('token'))
                    ->first();

        $mail_content = '<div class="request-content">';
        $mail_content .= Auth::user()->usrName;
        $mail_content .= ' accept your friend request.';
        $mail_content .= '</div>';

        $mail = new Mails;
        $mail->malSubject           = 'Accept Friend Request';
        $mail->malContent           = $mail_content;
        $mail->malType              = 0;
        $mail->malRead              = 0;
        $mail->malImportant         = 0;
        $mail->malFrom              = Auth::user()->email;
        $mail->malTo                = $friend->email;

        $mail->save();

        //-------------------        Add friend for me        --------------------------//
        $friend_me_list = DB::table('accounter')
                        ->where('accRememberToken', Auth::user()->usrRememberToken)
                        ->select('accFriends')
                        ->first();

        if(!$friend_me_list)
        {
            $responses = ['msg' =>"Your accounter table doesn't exit."];
            return Response::json( $responses );
        }    

        $arr = explode(';', $friend_me_list->accFriends);
        array_push($arr,  $req->input('token'));
        $arr = array_unique($arr);             
        $string = implode(";", $arr);

        DB::table('accounter')
        ->where('accRememberToken', Auth::user()->usrRememberToken)
        ->update(['accFriends' => $string]);
        //---------------------------------------------------------------------------//

        //------------------        Add friend for request      ----------------------//

        $friend_request_list = DB::table('accounter')
                            ->where('accRememberToken', $req->input('token'))
                            ->select('accFriends')
                            ->first();

        if(!$friend_request_list)
        {
            $responses = ['msg' =>"Your accounter table doesn't exit."];
            return Response::json( $responses );
        }    

        $arr = explode(';', $friend_request_list->accFriends);
        array_push($arr,  Auth::user()->usrRememberToken);
        $arr = array_unique($arr);             
        $string = implode(";", $arr);

        DB::table('accounter')
        ->where('accRememberToken', $req->input('token'))
        ->update(['accFriends' => $string]);

        //----------------------------------------------------------------------------//
        
        $responses = ['msg' =>'Accept successfully.'];
        return Response::json( $responses );
    }

    public function declineFriend(Request $req)
    {
        $status = DB::table('friend_request')
                    ->where('freFromToken', $req->input('token'))
                    ->where('freToToken', Auth::user()->usrRememberToken)
                    ->first();

        if(!$status)
        {
            $responses = ['msg' =>'Now this button is no longer enable.'];
            return Response::json( $responses );
        }

        if($status->freStatus != 0)
        {
            $responses = ['msg' =>'Now this button is no longer enable.'];
            return Response::json( $responses );
        }

        DB::table('friend_request')
                    ->where('freFromToken', $req->input('token'))
                    ->where('freToToken', Auth::user()->usrRememberToken)
                    ->update(['freStatus' => 2]);

        $friend = DB::table('users')
                    ->where('usrRememberToken', $req->input('token'))
                    ->first();

        $mail_content = '<div class="request-content">';
        $mail_content .= Auth::user()->usrName;
        $mail_content .= ' decline your friend request.';
        $mail_content .= '</div>';

        $mail = new Mails;
        $mail->malSubject           = 'Decline Friend Request';
        $mail->malContent           = $mail_content;
        $mail->malType              = 0;
        $mail->malRead              = 0;
        $mail->malImportant         = 0;
        $mail->malFrom              = Auth::user()->email;
        $mail->malTo                = $friend->email;

        $mail->save();

        $responses = ['msg' =>'Decline successfully.'];
        return Response::json( $responses );
    }

    public function selectState(Request $req)
    {

        $userByState = DB::table('accounter')
                     ->join('users', 'users.usrRememberToken', '=', 'accounter.accRememberToken')
                     ->join('post_img', 'users.usrRememberToken', '=', 'post_img.pimToken')
                     ->where('usrCountry', 'USA')
                     ->where('usrState', $req->input('state'))
                     ->where('usrPermission', Auth::user()->usrPermission)
                     ->orderBy('accStateRangking', 'ASC')
                     ->select('pimImg', 'usrFrsName', 'usrLstName', 'usrCountry', 'usrState', 'accOverallRangking', 'accStateRangking', 'accImgUrl')
                     ->get();

        $responses = ['userByState' => $userByState];
        return Response::json( $responses );             
    }

    public function editContent(Request $req)
    {

        $timeline   = DB::table('timeline')
                    ->where('tlnId', $req->input('post_id'))
                    ->first();

        $result = 0;

        switch ($timeline->tlnType) {
            case 0:
                $result = DB::table('post_content')
                        ->where('pcoId', $timeline->tlnPostId)
                        ->update(['pcoContent' => $req->input('post_content')]);
            break;

            case 1:
                
            break;

            case 2:
                
            break;

            case 3:
                
            break;

        }

        $responses = ['result' => $result];
        return Response::json($responses);  
    }

    public function deletePost(Request $req)
    {
        $timeline   = DB::table('timeline')
                    ->where('tlnId', $req->input('post_id'))
                    ->first();
        $result = 0;

        switch ($timeline->tlnType) {
            case 0:
                $result = DB::table('post_content')
                        ->where('pcoId', $timeline->tlnPostId)
                        ->delete();
            break;

            case 1:
                $result = DB::table('post_img')
                        ->where('pimId', $timeline->tlnPostId)
                        ->delete();             
            break;

            case 2:
                $result = DB::table('post_vid')
                        ->where('pviId', $timeline->tlnPostId)
                        ->delete();
            break;

            case 3:
                $result = DB::table('post_map')
                        ->where('pmaId', $timeline->tlnPostId)
                        ->delete();
            break;

        }

        if($result != 0)
            $result = DB::table('timeline')
                    ->where('tlnId', $req->input('post_id'))
                    ->delete();
        else{
            $responses = ['result' => 0];
            return Response::json($responses);
        }

        if($result != 0){
            $responses = ['result' => 1];
            return Response::json($responses); 
        }

        $responses = ['result' => 0];
        return Response::json($responses);  
    }

}

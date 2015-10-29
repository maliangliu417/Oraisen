<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Input;
use Validator;
use Redirect;
use Session;
use Auth;
use DB;

use App\Model\PostVideo;
use App\Model\PostImg;
use App\Model\PostMap;
use App\Model\Users;
use App\Model\TimeLine;

class FunctionController extends Controller
{
    public function apply_uploadPhoto($usrName)
    {
        // getting all of the post data
          $file = array('image' => Input::file('image'));
          // setting up rules
          $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
          // doing the validation, passing post data, rules and the messages
          $validator = Validator::make($file, $rules);
          if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('upload/photo/'.$usrName)->withInput()->withErrors($validator);
          }
          else {
            // checking file is valid.
            if (Input::file('image')->isValid()) {

              $imgType = exif_imagetype(Input::file('image'));

              if($imgType == IMAGETYPE_GIF || $imgType == IMAGETYPE_JPEG || $imgType == IMAGETYPE_PNG || $imgType == IMAGETYPE_BMP){
                  $destinationPath = 'uploads/profiles'; // upload path
                  $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                  $fileName = Auth::user()->usrName;
                  $fileName .= '-';
                  $fileName .= rand(11111,99999).'.'.$extension; // renameing image
                  
                  Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                  $fullImgPath = '';
                  $fullImgPath .= $destinationPath;
                  $fullImgPath .= '/';
                  $fullImgPath .= $fileName;

                  $max_favor = DB::table('post_img')
                            ->join('users', 'users.usrRememberToken', '=', 'post_img.pimToken')
                            ->where('users.usrName', $usrName)
                            ->max('pimNumber');


                  $date = date('Y-m-d H:i:s');
                  $favorNumber = 1;

                  if(!$max_favor)
                    $favorNumber = 1;
                  else
                  {
                    $favorNumber = $max_favor;
                    $favorNumber ++;
                  }

                  $token  = DB::table('users')
                          ->where('usrName', $usrName)
                          ->select('usrRememberToken')
                          ->first();

                  $img            =  new PostImg;
                  $img->pimImg    = $fullImgPath;
                  $img->pimToken  = $token->usrRememberToken;
                  $img->pimDate   = $date;
                  $img->pimNumber = $favorNumber;

                  $img->save();

                  $img_id = $img->pimId;

                  $post = new Timeline;
                  $post->tlnType = 1;
                  $post->tlnPostId = $img_id;
                  $post->save();
                  
                  // sending back with message
                  Session::flash('success', 'Upload successfully'); 
                  return Redirect::to('upload/photo/'.$usrName);
              }
              else{
                  Session::flash('error', 'That file is not photo! It only allows PNG, BMP, JPEG and GIF Photo types.'); 
                  return Redirect::to('upload/photo/'.$usrName);
              }
              
            }
            else {
              // sending back with error message.
              Session::flash('error', 'uploaded file is not valid');
              return Redirect::to('upload/photo/'.$usrName);
            }
          }
    }

    public function apply_uploadVideo($usrName)
    {
      // getting all of the post data
          $file = array('video' => Input::file('video'));
          // setting up rules
          $rules = array('video' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
          // doing the validation, passing post data, rules and the messages
          $validator = Validator::make($file, $rules);
          if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('upload/video/'.$usrName)->withInput()->withErrors($validator);
          }
          else {
            // checking file is valid.
            if (Input::file('video')->isValid()) {

              $destinationPath = 'uploads/videos'; // upload path
              $extension = Input::file('video')->getClientOriginalExtension(); // getting image extension
              $videoArray = array('mp4', 'webm', 'ogg');

              if(!in_array(strtolower($extension), $videoArray))
              {
                Session::flash('error', 'This is not video file.It allows mp4, webm and ogg video type!');
                return Redirect::to('upload/video/'.$usrName);
              }

              $fileName = Auth::user()->usrName;
              $fileName .= '-';
              $fileName .= rand(11111,99999).'.'.$extension; // renameing image

              Input::file('video')->move($destinationPath, $fileName); // uploading file to given path
              $fullImgPath = '';
              $fullImgPath .= $destinationPath;
              $fullImgPath .= '/';
              $fullImgPath .= $fileName;

              $max_favor = DB::table('post_vid')
                        ->join('users', 'users.usrRememberToken', '=', 'post_vid.pviToken')
                        ->where('users.usrName', $usrName)
                        ->max('pviNumber');

              $date = date('Y-m-d H:i:s');
              $favorNumber = 1;

              if(!$max_favor)
                  $favorNumber = 1;
              else{
                  $favorNumber = $max_favor;
                  $favorNumber ++;
              }

              $token  = DB::table('users')
                          ->where('usrName', $usrName)
                          ->select('usrRememberToken')
                          ->first();

              $video            =  new PostVideo;
              $video->pviVideo  = $fullImgPath;
              $video->pviToken  = $token->usrRememberToken;
              $video->pviDate   = $date;
              $video->pviNumber = $favorNumber;

              $video->save();

              $video_id = $video->pviId;

              $post = new Timeline;
              $post->tlnType = 2;
              $post->tlnPostId = $video_id;
              $post->save();

              // sending back with message
              Session::flash('success', 'Upload successfully'); 
              return Redirect::to('upload/video/'.$usrName);
            }
            else {
              // sending back with error message.
              Session::flash('error', 'uploaded file is not valid');
              return Redirect::to('upload/video/'.$usrName);
            }
          }
    }

    public function sendZipcode(Request $req, $usrName)
    {

        $max_favor = DB::table('post_map')
                  ->join('users', 'users.usrRememberToken', '=', 'post_map.pmaToken')
                  ->where('users.email', Auth::user()->email)
                  ->max('pmaNumber');
        $date = date('Y-m-d H:i:s');

        if(!$max_favor)
            $favorNumber = 1;
        else{
            $favorNumber = $max_favor;
            $favorNumber ++;
        }

        $token  = DB::table('users')
                          ->where('usrName', $usrName)
                          ->select('usrRememberToken')
                          ->first();

        $map            =  new PostMap;
        $map->pmaMap    = $req->input('zipcode');
        $map->pmaToken  = $token->usrRememberToken;
        $map->pmaDate   = $date;
        $map->pmaNumber = $favorNumber;

        $map->save();

        $map_id = $map->pmaId;

        $post = new Timeline;
        $post->tlnType = 3;
        $post->tlnPostId = $map_id;
        $post->save();

        Session::flash('success', 'Save zipcode successfully'); 
        return Redirect::to('upload/location/'.$usrName);
        
    }
}

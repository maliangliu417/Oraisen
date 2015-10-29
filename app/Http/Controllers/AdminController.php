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
use Hash;

use App\Model\Users;
use App\Model\Accounter;
use App\Model\Mails;
use App\Model\AdminUsers;

class AdminController extends Controller
{
   public function passLogin(Request $req)
   {
   	  	$result = DB::table('admin_users')
   	  		  ->where('email', $req->input('email') )
   	  		  ->first();

   	  	if($result)
   	  	{
   	  		if( Hash::check($req->input('password'), $result->password) ){
		  		session::put('admin_status', 'true');
		  		return redirect('admin');
		  	}
   	  	}

  		session::put('admin_status', 'false');  
  		return redirect('admin/login');


   }

   public function adminLogout()
   {
      Auth::logout();
      Session::flush();
      return redirect('admin/login');
   }

   public function manageProduct()
   {
      $products = DB::table('products')
                ->join('users', 'users.usrRememberToken', '=', 'products.pdtToken')
                ->get();

      return view('admin.manage_product')
             ->with('products', $products);
   }

   public function detailPost(Request $req)
   {
        $product    = DB::table('products')
                    ->join('users', 'users.usrRememberToken', '=', 'products.pdtToken')
                    ->where('pdtId', $req->input('post_id'))
                    ->first();

        if(!$product)
        {
            $responses = ['status' => 'none'];
            return Response::json( $responses );
        }
        else{
            $responses = ['status' => 'success', 'product'=>$product];
            return Response::json( $responses );
        }
   }

   public function deletePost(Request $req)
   {
        $result    = DB::table('products')
                  ->where('pdtId', $req->input('post_id'))
                  ->delete();

        if($result == 0)
        {
          $responses = ['status' => 'fail'];
          return Response::json( $responses );
        }

        $products  = DB::table('products')
                   ->join('users', 'users.usrRememberToken', '=', 'products.pdtToken')
                   ->get();

        if(!$products)
        {
            $responses = ['status' => 'none'];
            return Response::json( $responses );
        }
        else{
            $responses = ['status' => 'success', 'products'=>$products];
            return Response::json( $responses );
        }
   }

   public function makeRandomId($dbName, $fieldName)
   {
      $randId = 100000;

      while (1) {
          $randId = rand(100000,999999);
          $result = DB::table($dbName)
                  ->where($fieldName, $randId)
                  ->first();

          if(!$result)
            break;
      }

      return $randId;
   }


   public function agreePost(Request $req)
   {
      $pdtItemId = $this->makeRandomId('products', 'pdtItemId');
      $pdtCUrl = "http://oraisen.com/check_page/";
      $pdtCUrl .= $pdtItemId;
      
      DB::table('products')
            ->where('pdtId', $req->input('post_id'))
            ->update(['pdtPostPermission' => 1, 'pdtItemId' => $pdtItemId, 'pdtCUrl' => $pdtCUrl]);

      $product = DB::table('products')
               ->where('pdtId', $req->input('post_id'))
               ->first();

      $user = DB::table('users')
            ->where('usrRememberToken', $product->pdtToken)
            ->first();


      $mail_content = "<div class='product-name message-class'>Product Name : ";
      $mail_content .= $product->pdtName;
      $mail_content .= "</div><div class='product-check-url message-class'> Check Page URL : ";
      $mail_content .= $product->pdtCUrl;
      $mail_content .= "</div>";

      $mail = new Mails;
      $mail->malSubject           = 'Agree to Post Products';
      $mail->malContent           = $mail_content;
      $mail->malType              = 0;
      $mail->malRead              = 0;
      $mail->malImportant         = 0;
      $mail->malFrom              = 'oraisen@gmail.com';
      $mail->malTo                = $user->email;

      $mail->save();

      $responses = ['status' => 'success'];
      return Response::json( $responses );
   }

   public function myAction($productId)
   {
    dd($productId);

   }
}

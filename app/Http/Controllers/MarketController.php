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
use App\Model\Products;
use App\Model\Location;

class MarketController extends Controller
{
    public function getLnt($zip)
    {
        $url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($zip)."&sensor=false";
        $result_string = file_get_contents($url);
        $result = json_decode($result_string, true);
        $result1[]=$result['results'][0];
        $result2[]=$result1[0]['geometry'];
        $result3[]=$result2[0]['location'];
        return $result3[0];
    }

    function distance($lat1, $lon1, $lat2, $lon2, $unit) {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

   public function postProduct(Request $req)
   {
         $image = $req->file('image');
        
        $extension = $image->getClientOriginalExtension();
        $fileName = '';
        $filePath = '';
        $destinationPath = 'uploads/products';

        while(1)
        {
            $fileName = Auth::user()->usrName;
            $fileName .= '-';
            $fileName .= rand(11111,99999).'.'.$extension;

            
            $filePath .= $destinationPath;
            $filePath .= '/';
            $filePath .= $fileName;

            $result = DB::table('products')
                    ->where('pdtImg', $filePath)
                    ->where('pdtPostPermission', 1)
                    ->first();

            if( !$result )
                break;
        }

        $req->file('image')->move($destinationPath, $fileName);

        $product = new Products;
        $product->pdtImg            = $filePath;
        $product->pdtName           = $req->input('product_name');
        $product->pdtDescription    = $req->input('product_description');
        $product->pdtPrice          = $req->input('product_price');
        $product->pdtComission      = $req->input('product_comission');
        $product->pdtToken          = Auth::user()->usrRememberToken;
        $product->pdtTUrl           = $req->input('thank_url');
        $product->pdtPUrl           = $req->input('product_url');
        $product->pdtCategory       = $req->input('product_category');
        $product->pdtZipcode        = $req->input('product_zipcode');
        $product->pdtPostPermission = 0;

        $product->save();

        $products   = DB::table('products')
                    ->where('pdtPostPermission', 1)
                    ->get();

        $responses = ['status' => 'success', 'products' => $products];
        return Response::json( $responses );

   }

   public function selectPost(Request $req)
   {
        $product    = DB::table('products')
                    ->where('pdtPostPermission', 1)
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

   public function filterCommission(Request $req)
   {
        $products    = DB::table('products')
                    ->where('pdtPostPermission', 1)
                    ->where('pdtComission', '>=', $req->input('minPrice'))
                    ->where('pdtComission', '<=', $req->input('maxPrice'))
                    ->get();

        $responses = ['products'=>$products];
        return Response::json( $responses );
   }

   public function filterCategory(Request $req)
   {
        $products    = DB::table('products')
                    ->where('pdtPostPermission', 1)
                    ->where('pdtCategory', $req->input('category'))
                    ->get();

        $responses = ['products'=>$products];
        return Response::json( $responses );
   }

   public function filterDistance(Request $req)
   {

        $products    = DB::table('products')
                    ->where('pdtPostPermission', 1)
                    ->get();

        $cood1 = $this->getLnt(Auth::user()->usrZipcode);
        $products_filter = [];

        foreach ($products as $key => $product) {
            $cood2 = $this->getLnt($product->pdtZipcode);
            $distance = $this->distance($cood1['lat'], $cood1['lng'], $cood2['lat'], $cood2['lng'], "K");
            if($distance >= $req->input('minDistance') && $distance <= $req->input('maxDistance'))
                array_push($products_filter, $product); 
        }

        $responses = ['products'=>$products_filter];
        return Response::json( $responses );
   }

   public function sortProduct(Request $req)
   {    

        switch ( $req->input('sort_value') ) {
            case 0:
                $products   = DB::table('products')
                            ->where('pdtPostPermission', 1)
                            ->orderBy('pdtComission', 'desc')
                            ->get();
            break;
            
        }

        $responses = ['products'=>$products];
        return Response::json( $responses );
   }

   public function searchProduct(Request $req)
   {
        $products = DB::table('products')
                  ->where('pdtPostPermission', 1)
                  ->whereIn('pdtName', [$req->input('product_name')])
                  ->get();

        $responses = ['products'=>$products];
        return Response::json( $responses );
   }

}

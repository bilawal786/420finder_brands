<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Deal;

use App\Models\User;

use App\Models\Admin;

use App\Models\Brand;

use App\Models\Detail;

use App\Models\Slider;

use App\Models\Business;

use App\Models\Category;

use App\Models\Favorite;

use App\Mail\AddBusiness;

use App\Models\BrandFeed;

use App\Models\DealSlide;

use App\Models\TermOfUse;

use App\Models\StrainPost;

use App\Models\SubCategory;

use App\Models\BrandProduct;

use App\Models\CategoryType;

use App\Models\DealsClaimed;

use App\Models\DeliveryCart;

use App\Models\MiddleSlider;

use App\Models\StrainBanner;

use Illuminate\Http\Request;

use App\Models\StoreLocation;

use App\Models\DeliveryBanner;

use App\Models\DispensaryCart;

use App\Models\ProductRequest;

use App\Models\RecentlyViewed;
use App\Models\RetailerReview;
use App\Models\DeliveryProducts;
use App\Models\DispenseryProduct;

use App\Models\BrandProductReview;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\DeliveryProductGallery;
use Illuminate\Support\Facades\Session;
use App\Models\DispenseryProductGallery;

class WebsiteController extends Controller {

  public function index() {

        //  $slidesdesktop = [];
        //  $slidesmobile = [];

        //  $middleslidesdesktop = [];
        //  $middleslidesmobile = [];

      if (!empty(session('latitude')) AND !empty(session('longitude'))) {

          $latitude = session('latitude');
          $longitude = session('longitude');

          //dd($latitude);
          //dd($longitude);

          $categories = Category::orderBy('id', 'DESC')->get();

        //   dd(DB::table('businesses')
        //   ->selectRaw("businesses.* ,
        //    ( 3956 * acos( cos( radians(?) ) *
        //      cos( radians( latitude ) )
        //      * cos( radians( longitude ) - radians(?)
        //      ) + sin( radians(?) ) *
        //      sin( radians( latitude ) ) )
        //    ) AS distance", [$latitude, $longitude, $latitude])
        //   ->having("distance", "<", 155)->get());

        // $topBusinesses = DB::table('businesses')
        // ->selectRaw("businesses.* ,
        //  ( 6371000 * acos( cos( radians(?) ) *
        //    cos( radians( latitude ) )
        //    * cos( radians( longitude ) - radians(?)
        //    ) + sin( radians(?) ) *
        //    sin( radians( latitude ) ) )
        //  ) AS distance", [$latitude, $longitude, $latitude])
        // ->having("distance", "<", 250000)

        // ->limit(10)->get();

            $topBusinesses = DB::table('businesses')
            ->selectRaw("businesses.* ,
            ( 6371000 * acos( cos( radians(?) ) *
            cos( radians( latitude ) )
            * cos( radians( longitude ) - radians(?)
            ) + sin( radians(?) ) *
            sin( radians( latitude ) ) )
            ) AS distance", [$latitude, $longitude, $latitude])
            ->having("distance", "<", 250000)
            ->orderBy('distance', 'asc')
            ->where('top_business', 1)
            ->where('approve', 1)
            ->orderBy('order', 'asc')
            ->limit(10)->get();

          $dispensaries = DB::table('businesses')
              ->selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
              ->having("distance", "<", 250000)
              ->orderBy("distance",'asc')
              ->where('business_type', 'Dispensary')
              ->where('approve', 1)
              ->limit(10)->get();

          $deliveries = DB::table('businesses')
              ->selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
              ->having("distance", "<", 250000)
              ->orderBy("distance",'asc')
              ->where('business_type', 'Delivery')
              ->where('approve', 1)
              ->limit(10)->get();

          $businesses = DB::table('businesses')
              ->selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
              ->having("distance", "<", 250000)
              ->orderBy("distance",'asc')
              ->where('approve', 1)
              ->limit(10)->get();

          if (!empty(session('customer_id'))) {

              $recentlyvieweds = RecentlyViewed::where('customer_id', session('customer_id'))->get();

          } else {
              $recentlyvieweds = [];
          }

          // $url = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyCxwjOXvOkYjK2qU5J7sbmvIp08JCNCy2g&latlng='.trim(session('latitude')).','.trim(session('longitude')).'&sensor=false';
          // $json = @file_get_contents($url);
          // $data=json_decode($json);
          // // $key = array_search("formatted_address", $data->results);

          // // $index = count($data->results) - 1;
          // // dd($data->results);
          // // $slides = Slider::where('location', 'like', $data->results[$index]->formatted_address)->get();

          // $string = $data->results[0]->formatted_address;

          // $searchValues = preg_split('/\s+/', $string, -1, PREG_SPLIT_NO_EMPTY);

        //   $topdesktops = Slider::where('display_type', 'Desktop')->get();

        //   if($topdesktops->count() > 0) {

        //     foreach($topdesktops as $desktop) {

        //       $desktop_slide_radius = $desktop->slide_radius * 1000;

              $slidesdesktop = DB::table('sliders')
                  ->selectRaw("sliders.* ,
                   ( 6371000 * acos( cos( radians(?) ) *
                     cos( radians( latitude ) )
                     * cos( radians( longitude ) - radians(?)
                     ) + sin( radians(?) ) *
                     sin( radians( latitude ) ) )
                   ) AS distance", [$latitude, $longitude, $latitude])
                  ->having("distance", "<", DB::raw("slide_radius * 1000"))
                  ->orderBy("distance",'asc')
                  ->where('display_type', 'Desktop')
                  ->get();
        //     }

        //   }

        //   $topmobiles = Slider::where('display_type', 'Mobile')->get();

        //   if ($topmobiles->count() > 0) {

        //     foreach($topmobiles as $mobiles) {

        //       $mobiles_slide_radius = $mobiles->slide_radius * 1000;

            //   $slidesmobile = DB::table('sliders')
            //       ->selectRaw("sliders.* ,
            //        ( 6371000 * acos( cos( radians(?) ) *
            //          cos( radians( latitude ) )
            //          * cos( radians( longitude ) - radians(?)
            //          ) + sin( radians(?) ) *
            //          sin( radians( latitude ) ) )
            //        ) AS distance", [$latitude, $longitude, $latitude])
            //       ->having("distance", "<", DB::raw("slide_radius * 1000"))
            //       ->orderBy("distance",'asc')
            //       ->where('display_type', 'Mobile')
            //       ->get();

        //     }

        //   }

        //   $desktopmiddle = MiddleSlider::where('display_type', 'Desktop')->get();

        //   if ($desktopmiddle->count() > 0) {

        //     foreach($desktopmiddle as $dmiddle) {

        //       $dmiddle_slide_radius = $dmiddle->slide_radius * 1000;

              $middleslidesdesktop = DB::table('middle_sliders')
                  ->selectRaw("middle_sliders.* ,
                   ( 6371000 * acos( cos( radians(?) ) *
                     cos( radians( latitude ) )
                     * cos( radians( longitude ) - radians(?)
                     ) + sin( radians(?) ) *
                     sin( radians( latitude ) ) )
                   ) AS distance", [$latitude, $longitude, $latitude])
                  ->having("distance", "<", DB::raw("slide_radius * 1000"))
                  ->orderBy("distance",'asc')
                  ->where('display_type', 'Desktop')
                  ->get();

        //     }

        //   }

        //   $mobilemiddle = MiddleSlider::where('display_type', 'Mobile')->get();

        //   if ($mobilemiddle->count() > 0) {

        //     foreach($mobilemiddle as $mmiddle) {

        //       $mmiddle_slide_radius = $mmiddle->slide_radius * 1000;

            //   $middleslidesmobile = DB::table('middle_sliders')
            //       ->selectRaw("middle_sliders.* ,
            //        ( 6371000 * acos( cos( radians(?) ) *
            //          cos( radians( latitude ) )
            //          * cos( radians( longitude ) - radians(?)
            //          ) + sin( radians(?) ) *
            //          sin( radians( latitude ) ) )
            //        ) AS distance", [$latitude, $longitude, $latitude])
            //       ->having("distance", "<", DB::raw("slide_radius * 1000"))
            //       ->orderBy("distance",'asc')
            //       ->where('display_type', 'Mobile')
            //       ->get();

        //     }

        //   }

      } else {

          // Los Angeles California By Default

          $latitude = "34.0201613";
          $longitude = "-118.6919234";

          $categories = Category::orderBy('id', 'DESC')->get();

          $dispensaries = DB::table('businesses')
              ->selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
              ->having("distance", "<", 250000)
              ->orderBy("distance",'asc')
              ->where('business_type', 'Dispensary')
              ->where('approve', 1)
              ->limit(10)->get();

          $deliveries = DB::table('businesses')
              ->selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
              ->having("distance", "<", 250000)
              ->orderBy("distance",'asc')
              ->where('business_type', 'Delivery')
              ->where('approve', 1)
              ->limit(10)->get();

          $businesses = DB::table('businesses')
              ->selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
              ->having("distance", "<", 250000)
              ->where('approve', 1)
              ->orderBy("distance",'asc')
              ->limit(10)->get();

            $topBusinesses = DB::table('businesses')
              ->selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
              ->having("distance", "<", 250000)
              ->where('top_business', 1)
              ->where('approve', 1)
              ->orderBy('order', 'asc')
              ->limit(10)->get();


          if (!empty(session('customer_id'))) {

              $recentlyvieweds = RecentlyViewed::where('customer_id', session('customer_id'))->get();

          } else {
              $recentlyvieweds = [];
          }

          // $url = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyCxwjOXvOkYjK2qU5J7sbmvIp08JCNCy2g&latlng='.trim(session('latitude')).','.trim(session('longitude')).'&sensor=false';
          // $json = @file_get_contents($url);
          // $data=json_decode($json);
          // // $key = array_search("formatted_address", $data->results);

          // // $index = count($data->results) - 1;
          // // dd($data->results);
          // // $slides = Slider::where('location', 'like', $data->results[$index]->formatted_address)->get();

          // $string = $data->results[0]->formatted_address;

          // $searchValues = preg_split('/\s+/', $string, -1, PREG_SPLIT_NO_EMPTY);

        //   $topdesktops = Slider::where('display_type', 'Desktop')->get();

         // $topdesktops = Slider::get();


        //   if($topdesktops->count() > 0) {

        //     foreach($topdesktops as $desktop) {

        //       $desktop_slide_radius = $desktop->slide_radius * 1000;

              $slidesdesktop = DB::table('sliders')
                  ->selectRaw("sliders.* ,
                   ( 6371000 * acos( cos( radians(?) ) *
                     cos( radians( latitude ) )
                     * cos( radians( longitude ) - radians(?)
                     ) + sin( radians(?) ) *
                     sin( radians( latitude ) ) )
                   ) AS distance", [$latitude, $longitude, $latitude])
                  ->having("distance", "<", DB::raw("slide_radius * 1000"))
                  ->orderBy("distance",'asc')
                  ->get();

        //     }

        //   }

        //   $topmobiles = Slider::where('display_type', 'Mobile')->get();

        // $topmobiles = Slider::get();

        //   if ($topmobiles->count() > 0) {

        //     foreach($topmobiles as $mobiles) {

        //       $mobiles_slide_radius = $mobiles->slide_radius * 1000;

        //     //   $slidesmobile = DB::table('sliders')
        //     //       ->selectRaw("sliders.* ,
        //     //        ( 6371000 * acos( cos( radians(?) ) *
        //     //          cos( radians( latitude ) )
        //     //          * cos( radians( longitude ) - radians(?)
        //     //          ) + sin( radians(?) ) *
        //     //          sin( radians( latitude ) ) )
        //     //        ) AS distance", [$latitude, $longitude, $latitude])
        //     //       ->having("distance", "<", $mobiles_slide_radius)
        //     //       ->orderBy("distance",'asc')
        //     //       ->where('display_type', 'Mobile')
        //     //       ->get();

        //     $slidesmobile = DB::table('sliders')
        //           ->selectRaw("sliders.* ,
        //            ( 6371000 * acos( cos( radians(?) ) *
        //              cos( radians( latitude ) )
        //              * cos( radians( longitude ) - radians(?)
        //              ) + sin( radians(?) ) *
        //              sin( radians( latitude ) ) )
        //            ) AS distance", [$latitude, $longitude, $latitude])
        //           ->having("distance", "<", $mobiles_slide_radius)
        //           ->orderBy("distance",'asc')
        //           ->get();

        //     }

        //   }

        //   $desktopmiddle = MiddleSlider::where('display_type', 'Desktop')->get();

       //   $desktopmiddle = MiddleSlider::get();

        //   if ($desktopmiddle->count() > 0) {

        //     foreach($desktopmiddle as $dmiddle) {

        //       $dmiddle_slide_radius = $dmiddle->slide_radius * 1000;

              $middleslidesdesktop = DB::table('middle_sliders')
                  ->selectRaw("middle_sliders.* ,
                   ( 6371000 * acos( cos( radians(?) ) *
                     cos( radians( latitude ) )
                     * cos( radians( longitude ) - radians(?)
                     ) + sin( radians(?) ) *
                     sin( radians( latitude ) ) )
                   ) AS distance", [$latitude, $longitude, $latitude])
                  ->having("distance", "<", DB::raw("slide_radius * 1000"))
                  ->orderBy("distance",'asc')
                  ->where('display_type', 'Desktop')
                  ->get();

        //     }

        //   }

        //   $mobilemiddle = MiddleSlider::where('display_type', 'Mobile')->get();

        //   if ($mobilemiddle->count() > 0) {

        //     foreach($mobilemiddle as $mmiddle) {

        //       $mmiddle_slide_radius = $mmiddle->slide_radius * 1000;

        //       $middleslidesmobile = DB::table('middle_sliders')
        //           ->selectRaw("middle_sliders.* ,
        //            ( 6371000 * acos( cos( radians(?) ) *
        //              cos( radians( latitude ) )
        //              * cos( radians( longitude ) - radians(?)
        //              ) + sin( radians(?) ) *
        //              sin( radians( latitude ) ) )
        //            ) AS distance", [$latitude, $longitude, $latitude])
        //           ->having("distance", "<", $mmiddle_slide_radius)
        //           ->orderBy("distance",'asc')
        //           ->where('display_type', 'Mobile')
        //           ->get();

        //     }

        //   }

      }

      return view('index')
          ->with('slidesdesktop', $slidesdesktop)
        //   ->with('slidesmobile', $slidesmobile)
          ->with('middleslidesdesktop', $middleslidesdesktop)
        //   ->with('middleslidesmobile', $middleslidesmobile)
          ->with('categories', $categories)
          ->with('dispensaries', $dispensaries)
          ->with('deliveries', $deliveries)
          ->with('businesses', $businesses)
          ->with('recentlyvieweds', $recentlyvieweds)
          ->with('topBusinesses', $topBusinesses);
  }

  public function managemybusiness() {

      if (!empty(session('customer_email'))) {

          $business = Business::where('email', session('customer_email'))->first();

          $business_id = session()->put('business_id', $business->id);
          $business_fn = session()->put('business_fn', $business->first_name);
          $business_ln = session()->put('business_ln', $business->last_name);
          $business_email = session()->put('business_email', $business->email);

          session()->forget('customer_id');
          session()->forget('customer_name');
          session()->forget('customer_email');

          return redirect()->route('businessprofile');

      } else {
          return redirect()->route('login');
      }

  }

  public function managecustomeraccount() {

      if (!empty(session('business_email'))) {

          $user = User::where('email', session('business_email'))->first();

          $customer_id = session()->put('customer_id', $user->id);
          $customer_name = session()->put('customer_name', $user->name);
          $customer_email = session()->put('customer_email', $user->email);

          session()->forget('business_id');
          session()->forget('business_fn');
          session()->forget('business_ln');
          session()->forget('business_email');

          return redirect()->route('profile');

      } else {
         return redirect()->route('signin');
      }

  }

  public function search(Request $request) {

      $string = $request->keyword;

      $searchValues = preg_split('/\s+/', $string, -1, PREG_SPLIT_NO_EMPTY);

      if (!empty(session('latitude')) AND !empty(session('longitude'))) {
          // dd("1");

          $latitude = session('latitude');
          $longitude = session('longitude');

          // $user_ip = getenv('REMOTE_ADDR');
          // $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));

          // $latitude = $geo['geoplugin_latitude'];
          // $longitude = $geo['geoplugin_longitude'];

          $businesses = DB::table('businesses')
              ->selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
              ->having("distance", "<", 250000)
              ->orderBy("distance",'asc')
              ->where(function ($q) use ($searchValues) {
            foreach ($searchValues as $value) {
              $q->orWhere('businesses.first_name', 'like', "%{$value}%");
              $q->orWhere('businesses.last_name', 'like', "%{$value}%");
              $q->orWhere('businesses.business_name', 'like', "%{$value}%");
            }
          })->where('approve', 1)->get();

      } else {
          $businesses = [];
      }

      return view('search')
          ->with('businesses', $businesses);

  }

  public function getlocationforcurrentuser(Request $request) {

      session()->put('latitude', $request->lat);
      session()->put('longitude', $request->lon);

      $lat = $request->lat;
      $lon = $request->lon;

      // $url = 'https://maps.googleapis.com/maps/api/geocode/json?key= AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8&latlng='.trim(session('latitude')).','.trim(session('longitude')).'&sensor=false';

       $url = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8&latlng={$lat},{$lon}&sensor=false";

          $json = @file_get_contents($url);
          $data = json_decode($json);

          // $key = array_search("formatted_address", $data->results);

          $index = count($data->results) - 1;
          // dd($data->results);
          // $slides = Slider::where('location', 'like', $data->results[$index]->formatted_address)->get();
          // dd($data->results);
          $location = $data->results[3]->formatted_address;
          // $location = $data->results[$index]->formatted_address;

      // $user_ip = getenv('REMOTE_ADDR');
      // $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));

      // $geo = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $lat . "," . $lon . "&key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8");

      // $dat = json_decode($geo, true);

      // $index = count($dat->results) - 1;


      // $location = $dat->results[$index]->formatted_address;

      $response =

          [
              'statuscode'=> 200,
              'message' => $location
          ];

      echo json_encode($response);

  }

  public function dispensaries() {

      $latitude = "";
      $longitude = "";

      if (!empty(session('latitude')) AND !empty(session('longitude'))) {

          $latitude = session('latitude');
          $longitude = session('longitude');

      } else {
          $latitude = "34.0201613";
          $longitude = "-118.6919234";
      }

          $geo = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $latitude . "," . $longitude . "&key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8");

          $dat = json_decode($geo, true);
          $location = $dat['results'][3]['formatted_address'];
          // $location = $dat['results'][0]['address_components'][1]['long_name'];
          // dd($dat['results'][0]['address_components'][1]['long_name']);
          $dispensaries = DB::table('businesses')
              ->selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
              ->having("distance", "<", 250000)
              ->orderBy("distance",'asc')
              ->where('business_type', 'Dispensary')
              ->where('approve', 1)
              ->paginate(15);

      // $dispensaries = Business::where('business_type', 'Dispensary')->get();

      return view('dispensaries')
          ->with('location', $location)
          ->with('dispensaries', $dispensaries);

  }

  public function deliveries() {

      $latitude = "";
      $longitude = "";

      if (!empty(session('latitude')) AND !empty(session('longitude'))) {

          $latitude = session('latitude');
          $longitude = session('longitude');

        } else {
            $latitude = "34.0201613";
            $longitude = "-118.6919234";
         }

          $geo = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $latitude . "," . $longitude . "&key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8");

          $dat = json_decode($geo, true);
          $location = $dat['results'][3]['formatted_address'];
          // $location = $dat['results'][0]['address_components'][3]['long_name'];

          $deliveries = DB::table('businesses')
              ->selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
              ->having("distance", "<", 250000)
              ->orderBy("distance",'asc')
              ->where('business_type', 'Delivery')
              ->where('approve', 1)
              ->paginate(15);

      // $deliveries = Business::where('business_type', 'Delivery')->get();

      return view('deliveries')
          ->with('location', $location)
          ->with('deliveries', $deliveries);
  }

  public function maps() {

      return;
      if (!empty(session('latitude')) AND !empty(session('longitude'))) {

          $latitude = session('latitude');
          $longitude = session('longitude');

          $geo = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $latitude . "," . $longitude . "&key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8");

          $dat = json_decode($geo, true);
          // dd($dat['results']);
          $index = count($dat['results']) - 1;

          $location = $dat['results'][3]['formatted_address'];
          // $location = $dat['results'][$index]['formatted_address'];

          $businesses = DB::table('businesses')
              ->selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
              ->having("distance", "<", 250000)
              ->orderBy("distance",'asc')
              ->where('approve', 1)
              ->get();

          $deals = Deal::all();

          $stores = DB::table('store_locations')
              ->selectRaw("store_locations.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
              ->having("distance", "<", 250000)
              ->orderBy("distance",'asc')
              ->get();

      } else {

          $businesses = Business::limit(12)->get();

          $location = "Please select your location.";

          $deals = Deal::all();

          $stores = [];

      }

      return view('maps')
          ->with('stores', $stores)
          ->with('location', $location)
          ->with('businesses', $businesses)
          ->with('deals', $deals);

  }

  public function getbusinessdetails(Request $request) {

      $businesses = Business::where('id', $request->business_id)->first();

      $response =

          [
              'statuscode'=> 200,
              'data' => $businesses
          ];

      echo json_encode($response);

  }

  public function mapfilter($keyword) {

      if (!empty(session('latitude')) AND !empty(session('longitude'))) {

          $latitude = session('latitude');
          $longitude = session('longitude');

          $geo = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $latitude . "," . $longitude . "&key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8");

          $dat = json_decode($geo, true);
          $location = $dat['results'][3]['formatted_address'];

          if ($keyword == 'Dispensary') {

              $businesses = DB::table('businesses')
                  ->selectRaw("businesses.* ,
                   ( 6371000 * acos( cos( radians(?) ) *
                     cos( radians( latitude ) )
                     * cos( radians( longitude ) - radians(?)
                     ) + sin( radians(?) ) *
                     sin( radians( latitude ) ) )
                   ) AS distance", [$latitude, $longitude, $latitude])
                  ->having("distance", "<", 250000)
                  ->orderBy("distance",'asc')
                  ->where('business_type', 'Dispensary')
                  ->where('approve', 1)
                  ->get();

          } elseif ($keyword == 'Delivery') {

              $businesses = DB::table('businesses')
                  ->selectRaw("businesses.* ,
                   ( 6371000 * acos( cos( radians(?) ) *
                     cos( radians( latitude ) )
                     * cos( radians( longitude ) - radians(?)
                     ) + sin( radians(?) ) *
                     sin( radians( latitude ) ) )
                   ) AS distance", [$latitude, $longitude, $latitude])
                  ->having("distance", "<", 250000)
                  ->orderBy("distance",'asc')
                  ->where('business_type', 'Delivery')
                  ->where('approve', 1)
                  ->get();

          }

      } else {

        $latitude = "34.0201613";
        $longitude = "-118.6919234";

          $geo = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $latitude . "," . $longitude . "&key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8");

          $dat = json_decode($geo, true);
          $location = $dat['results'][3]['formatted_address'];

          if ($keyword == 'Dispensary') {

              $businesses = DB::table('businesses')
                  ->selectRaw("businesses.* ,
                   ( 6371000 * acos( cos( radians(?) ) *
                     cos( radians( latitude ) )
                     * cos( radians( longitude ) - radians(?)
                     ) + sin( radians(?) ) *
                     sin( radians( latitude ) ) )
                   ) AS distance", [$latitude, $longitude, $latitude])
                  ->having("distance", "<", 250000)
                  ->orderBy("distance",'asc')
                  ->where('business_type', 'Dispensary')
                  ->where('approve', 1)
                  ->get();

          } elseif ($keyword == 'Delivery') {

              $businesses = DB::table('businesses')
                  ->selectRaw("businesses.* ,
                   ( 6371000 * acos( cos( radians(?) ) *
                     cos( radians( latitude ) )
                     * cos( radians( longitude ) - radians(?)
                     ) + sin( radians(?) ) *
                     sin( radians( latitude ) ) )
                   ) AS distance", [$latitude, $longitude, $latitude])
                  ->having("distance", "<", 250000)
                  ->orderBy("distance",'asc')
                  ->where('business_type', 'Delivery')
                  ->where('approve', 1)
                  ->get();

          }

      }

      $deals = Deal::all();

      $stores = DB::table('store_locations')
          ->selectRaw("store_locations.* ,
           ( 6371000 * acos( cos( radians(?) ) *
             cos( radians( latitude ) )
             * cos( radians( longitude ) - radians(?)
             ) + sin( radians(?) ) *
             sin( radians( latitude ) ) )
           ) AS distance", [$latitude, $longitude, $latitude])
          ->having("distance", "<", 250000)
          ->orderBy("distance",'asc')
          ->get();

      return view('maps')
          ->with('location', $location)
          ->with('businesses', $businesses)
          ->with('deals', $deals)
          ->with('stores', $stores);

  }

  /*
  *  Desktop Map
  *
  */

  public function desktopMap() {

     return view('map.desktop-map');

  }

  public function dispensarysingle($name, $id) {

    $dispensary = Business::where('id', $id)->first();

    if(!$dispensary->approve) {
        return redirect()->back();
    }

    $detail = Detail::where('business_id', $id)->first();

    $dispensaryBanner = DeliveryBanner::first();

    $featured = DispenseryProduct::where('status', 1)->where('dispensery_id', $id)
        ->where('is_featured', 1)
        ->get();

    $products = DispenseryProduct::where('status', 1)->where('dispensery_id', $id)
        ->get();

    // Categories
    $category_ids = [];
    foreach($products as $product) {
        array_push($category_ids, $product->category_id);
    }
    $cids = array_unique($category_ids);
    $categories = Category::whereIn('id', $cids)->select('id', 'name')->get();

    // Subcategories
    $subcategory_ids = [];
    foreach($products as $single) {
        array_push($subcategory_ids, $single->subcategory_ids);
    }
    $cids = array_unique($subcategory_ids);
    $subcategories = SubCategory::whereIn('id', $cids)->select('id', 'name')->get();


    $productrequests = ProductRequest::where('retailer_id', $id)->select('brand_id')->get();

    $bids = [];
    foreach($productrequests as $req) {

        array_push($bids, $req->brand_id);

    }

    $brands = Brand::whereIn('id', $bids)->select('id', 'name', 'logo')->get();

    $reviews = RetailerReview::where('retailer_id', $id)->get();

    $deals = Deal::where('retailer_id', $dispensary->id)->get();
    $business = Business::where('id', $dispensary->id)->first();

    $isReviewed = false;

    if(Session::has('customer_id')) {
        $customerId = Session::get('customer_id');

        $exist = RetailerReview::where('retailer_id', $dispensary->id)->whereNull('product_id')->where('customer_id', $customerId)->count();

        if($exist > 0) {
           $isReviewed = true;
        }

    }

    return view('dispensarysingle')
        ->with('delivery', $dispensary)
        ->with('featured', $featured)
        ->with('products', $products)
        ->with('reviews', $reviews)
        ->with('categories', $categories)
        ->with('subcategories', $subcategories)
        ->with('brands', $brands)
        ->with('deals', $deals)
        ->with('detail', $detail)
        ->with('business', $business)
        ->with('deliveryBanner', $dispensaryBanner)
        ->with('isReviewed', $isReviewed);
  }

  public function dispensarysinglecategory($name, $id, $category) {

      $dispensary = Business::where('id', $id)->first();

      $products = DispenseryProduct::where('dispensery_id', $id)
          ->where('category_id', $category)
          ->get();

      $allproducts = DispenseryProduct::where('dispensery_id', $id)
          ->get();

      // Categories
      $category_ids = [];
      foreach($allproducts as $product) {
          array_push($category_ids, $product->category_id);
      }
      $cids = array_unique($category_ids);
      $categories = Category::whereIn('id', $cids)->select('id', 'name')->get();


      // Subcategories
      $subcategory_ids = [];
      foreach($allproducts as $single) {
          array_push($subcategory_ids, $single->subcategory_ids);
      }
      $cids = array_unique($subcategory_ids);
      $subcategories = SubCategory::whereIn('id', $cids)->select('id', 'name')->get();


      $productrequests = ProductRequest::where('retailer_id', $id)->select('brand_id')->get();

      $bids = [];
      foreach($productrequests as $req) {

          array_push($bids, $req->brand_id);

      }

      $brands = Brand::whereIn('id', $bids)->select('id', 'name', 'logo')->get();

      $reviews = RetailerReview::where('retailer_id', $id)->get();

      return view('dispensarysingle')
          ->with('dispensary', $dispensary)
          ->with('products', $products)
          ->with('reviews', $reviews)
          ->with('categories', $categories)
          ->with('subcategories', $subcategories)
          ->with('brands', $brands);

  }

  public function dispensarysinglesubcategory($name, $id, $subcategory) {

      $dispensary = Business::where('id', $id)->first();

      $products = DispenseryProduct::where('dispensery_id', $id)
          ->where('subcategory_ids', $subcategory)
          ->get();

      $allproducts = DispenseryProduct::where('dispensery_id', $id)
          ->get();

      // Categories
      $category_ids = [];
      foreach($allproducts as $product) {
          array_push($category_ids, $product->category_id);
      }
      $cids = array_unique($category_ids);
      $categories = Category::whereIn('id', $cids)->select('id', 'name')->get();


      // Subcategories
      $subcategory_ids = [];
      foreach($allproducts as $single) {
          array_push($subcategory_ids, $single->subcategory_ids);
      }
      $cids = array_unique($subcategory_ids);
      $subcategories = SubCategory::whereIn('id', $cids)->select('id', 'name')->get();


      $productrequests = ProductRequest::where('retailer_id', $id)->select('brand_id')->get();

      $bids = [];
      foreach($productrequests as $req) {

          array_push($bids, $req->brand_id);

      }

      $brands = Brand::whereIn('id', $bids)->select('id', 'name', 'logo')->get();

      $reviews = RetailerReview::where('retailer_id', $id)->get();

      return view('dispensarysingle')
          ->with('dispensary', $dispensary)
          ->with('products', $products)
          ->with('reviews', $reviews)
          ->with('categories', $categories)
          ->with('subcategories', $subcategories)
          ->with('brands', $brands);

  }

  public function retailerproduct($business_type, $slug, $product_id) {

      if ($business_type == 'Dispensary') {

          $product = DispenseryProduct::where('id', $product_id)->first();

          $gallery = DispenseryProductGallery::where('dispensery_product_id', $product_id)->get();

          $retailer = Business::where('id', $product->dispensery_id)->first();

          $reviews = RetailerReview::where('product_id', $product_id)->get();

      } else {

          $product = DeliveryProducts::where('id', $product_id)->first();

          $gallery = DeliveryProductGallery::where('delivery_product_id', $product_id)->get();

          $retailer = Business::where('id', $product->delivery_id)->first();

          $reviews = RetailerReview::where('product_id', $product_id)->get();

      }

      if (!empty(session('customer_id'))) {

          $check = RecentlyViewed::where('customer_id', session('customer_id'))
              ->where('product_id', $product_id)
              ->where('type', $business_type)
              ->count();

          if ($check == 0) {

              $recentviewed = new RecentlyViewed;

              $recentviewed->customer_id = session('customer_id');
              $recentviewed->product_id = $product_id;
              $recentviewed->type = $business_type;
              $recentviewed->save();

          }

      }

      $isReviewed = false;

      if(Session::has('customer_id')) {

          $customerId = Session::get('customer_id');

          $exist = RetailerReview::where('retailer_id', $retailer->id)->whereNotNull('product_id')->where('customer_id', $customerId)->count();

          if($exist > 0) {
             $isReviewed = true;
          }

      }

      return view('retailerproduct')
          ->with('retailer', $retailer)
          ->with('product', $product)
          ->with('gallery', $gallery)
          ->with('reviews', $reviews)
          ->with('isReviewed', $isReviewed);

  }

  public function deliverysingle($name, $id) {

      $delivery = Business::where('id', $id)->first();

      if(!$delivery->approve) {
          return redirect()->back();
      }

      $detail = Detail::where('business_id', $id)->first();

      $deliveryBanner = DeliveryBanner::first();

      $featured = DeliveryProducts::where('delivery_id', $id)
          ->where('is_featured', 1)
          ->get();

      $products = DeliveryProducts::where('delivery_id', $id)
          ->get();

      // Categories
      $category_ids = [];
      foreach($products as $product) {
          array_push($category_ids, $product->category_id);
      }
      $cids = array_unique($category_ids);
      $categories = Category::whereIn('id', $cids)->select('id', 'name')->get();

      // Subcategories
      $subcategory_ids = [];
      foreach($products as $single) {
          array_push($subcategory_ids, $single->subcategory_ids);
      }
      $cids = array_unique($subcategory_ids);
      $subcategories = SubCategory::whereIn('id', $cids)->select('id', 'name')->get();


      $productrequests = ProductRequest::where('retailer_id', $id)->select('brand_id')->get();

      $bids = [];
      foreach($productrequests as $req) {

          array_push($bids, $req->brand_id);

      }

      $brands = Brand::whereIn('id', $bids)->select('id', 'name', 'logo')->get();

      $reviews = RetailerReview::where('retailer_id', $id)->get();

      $deals = Deal::where('retailer_id', $delivery->id)->get();
      $business = Business::where('id', $delivery->id)->first();

      $isReviewed = false;

      if(Session::has('customer_id')) {
          $customerId = Session::get('customer_id');

          $exist = RetailerReview::where('retailer_id', $delivery->id)->whereNull('product_id')->where('customer_id', $customerId)->count();

          if($exist > 0) {
             $isReviewed = true;
          }

      }

      return view('deliverysingle')
          ->with('delivery', $delivery)
          ->with('featured', $featured)
          ->with('products', $products)
          ->with('reviews', $reviews)
          ->with('categories', $categories)
          ->with('subcategories', $subcategories)
          ->with('brands', $brands)
          ->with('deals', $deals)
          ->with('detail', $detail)
          ->with('business', $business)
          ->with('deliveryBanner', $deliveryBanner)
          ->with('isReviewed', $isReviewed);

  }

  public function deliverysinglecategory($name, $id, $category) {

      $delivery = Business::where('id', $id)->first();

      $products = DeliveryProducts::where('delivery_id', $id)
          ->where('category_id', $category)
          ->get();

      $allproducts = DeliveryProducts::where('delivery_id', $id)
          ->get();

      // Categories
      $category_ids = [];
      foreach($allproducts as $product) {
          array_push($category_ids, $product->category_id);
      }
      $cids = array_unique($category_ids);
      $categories = Category::whereIn('id', $cids)->select('id', 'name')->get();

      // Subcategories
      $subcategory_ids = [];
      foreach($allproducts as $single) {
          array_push($subcategory_ids, $single->subcategory_ids);
      }
      $cids = array_unique($subcategory_ids);
      $subcategories = SubCategory::whereIn('id', $cids)->select('id', 'name')->get();


      $productrequests = ProductRequest::where('retailer_id', $id)->select('brand_id')->get();

      $bids = [];
      foreach($productrequests as $req) {

          array_push($bids, $req->brand_id);

      }

      $brands = Brand::whereIn('id', $bids)->select('id', 'name', 'logo')->get();

      $reviews = RetailerReview::where('retailer_id', $id)->get();

      return view('deliverysingle')
          ->with('delivery', $delivery)
          ->with('products', $products)
          ->with('reviews', $reviews)
          ->with('categories', $categories)
          ->with('subcategories', $subcategories)
          ->with('brands', $brands);

  }

  public function deliverysinglesubcategory($name, $id, $subcategory) {

      $delivery = Business::where('id', $id)->first();

      $products = DeliveryProducts::where('delivery_id', $id)
          ->where('subcategory_ids', $subcategory)
          ->get();

      $allproducts = DeliveryProducts::where('delivery_id', $id)
          ->get();

      // Categories
      $category_ids = [];
      foreach($allproducts as $product) {
          array_push($category_ids, $product->category_id);
      }
      $cids = array_unique($category_ids);
      $categories = Category::whereIn('id', $cids)->select('id', 'name')->get();


      // Subcategories
      $subcategory_ids = [];
      foreach($allproducts as $single) {
          array_push($subcategory_ids, $single->subcategory_ids);
      }
      $cids = array_unique($subcategory_ids);
      $subcategories = SubCategory::whereIn('id', $cids)->select('id', 'name')->get();


      $productrequests = ProductRequest::where('retailer_id', $id)->select('brand_id')->get();

      $bids = [];
      foreach($productrequests as $req) {

          array_push($bids, $req->brand_id);

      }

      $brands = Brand::whereIn('id', $bids)->select('id', 'name', 'logo')->get();

      $reviews = RetailerReview::where('retailer_id', $id)->get();

      return view('deliverysingle')
          ->with('delivery', $delivery)
          ->with('products', $products)
          ->with('reviews', $reviews)
          ->with('categories', $categories)
          ->with('subcategories', $subcategories)
          ->with('brands', $brands);

  }
//   public function addtocartdispensary(Request $request) {

//       $dispensory_product_id = $request->dispensory_product_id;

//       $checkDelivery = DeliveryCart::where('customer_id', session('customer_id'))->count();

//       if ($checkDelivery > 0) {

//           $response =

//               [
//                   'statuscode'=> 202,
//                   'message' => "You currently have items in your cart from another menu. You may only add items from one menu at a time. Would you like to finish your previous order, or start a new cart?."
//               ];

//           echo json_encode($response);

//       } else {

//           $check = DispensaryCart::where('customer_id', session('customer_id'))->where('product_id', $request->dispensory_product_id)->count();

//           if ($check > 0) {

//               $response =

//                   [
//                       'statuscode'=> 201,
//                       'message' => "Product Already added to cart."
//                   ];

//               echo json_encode($response);

//           } else {

//               $cart = new DispensaryCart;

//               $cart->customer_id = session('customer_id');
//               $cart->product_id = $request->dispensory_product_id;

//               $cart->qty = 1;

//               if ($cart->save()) {

//                   $response =

//                       [
//                           'statuscode'=> 200,
//                           'message' => "Product added to cart."
//                       ];

//                   echo json_encode($response);

//               } else {

//                   $response =

//                       [
//                           'statuscode'=> 400,
//                           'message' => 'Semething went wrong.'
//                       ];

//                   echo json_encode($response);

//               }

//           }

//       }

//   }

public function addtocartdispensary(Request $request) {

    $deliveryProductId = $request->dispensory_product_id;
    $checkDelivery = DeliveryCart::where('customer_id', session('customer_id'))->pluck('product_id')->first();

    $dealsClaimed = DealsClaimed::where('customer_id', session('customer_id'))->get();

    if($dealsClaimed->count() > 0) {
      $dealId = $dealsClaimed->pluck('deal_id')->first();
      $retailerId = Deal::where('id', $dealId)->pluck('retailer_id')->first();

      $delId = DispenseryProduct::where('id', $deliveryProductId)->pluck('dispensery_id')->first();

      if($delId != $retailerId) {
          $response =
              [
                  'statuscode'=> 202,
                  'message' => "You currently have items in your cart from another menu. You may only add items from one menu at a time. Would you like to finish your previous order, or start a new cart?."
              ];

              echo json_encode($response);
           return;
      }
    }

    if(!is_null($checkDelivery)) {

          $delId = DispenseryProduct::where('id', $deliveryProductId)->pluck('dispensery_id')->first();
          $deliveryId = DispenseryProduct::where('id', $checkDelivery)->pluck('dispensery_id')->first();

          if($delId != $deliveryId) {
              $response =
              [
                  'statuscode'=> 202,
                  'message' => "You currently have items in your cart from another menu. You may only add items from one menu at a time. Would you like to finish your previous order, or start a new cart?."
              ];

              echo json_encode($response);

          } else {
              $check = DeliveryCart::where('customer_id', session('customer_id'))->where('product_id', $request->dispensory_product_id)->count();

              if ($check > 0) {

                  $response =

                      [
                          'statuscode'=> 201,
                          'message' => "Product Already added to cart."
                      ];

                  echo json_encode($response);

              } else {

                  $cart = new DeliveryCart;

                  $cart->customer_id = session('customer_id');
                  $cart->product_id = $request->dispensory_product_id;

                  $cart->qty = 1;
                  $cartSaved = $cart->save();

                  $cartCount = DeliveryCart::where('customer_id', session('customer_id'))->count();

                  if ($cartSaved) {

                      $response =

                          [
                              'statuscode'=> 200,
                              'message' => "Product added to cart.",
                              'cartCount' => $cartCount
                          ];

                      echo json_encode($response);

                  } else {

                      $response =

                          [
                              'statuscode'=> 400,
                              'message' => 'Semething went wrong.'
                          ];

                      echo json_encode($response);

                  }

              }
          }
      } else {

          $cart = new DeliveryCart;

          $cart->customer_id = session('customer_id');
          $cart->product_id = $request->dispensory_product_id;

          $cart->qty = 1;

          $cartSaved = $cart->save();

          $cartCount = DeliveryCart::where('customer_id', session('customer_id'))->count();

          if ($cartSaved) {

              $response =

                  [
                      'statuscode'=> 200,
                      'message' => "Product added to cart.",
                      'cartCount' => $cartCount
                  ];

              echo json_encode($response);

          } else {

              $response =

                  [
                      'statuscode'=> 400,
                      'message' => 'Semething went wrong.'
                  ];

              echo json_encode($response);

          }

     }

  }
  public function removedcartadddispansory(Request $request) {

      $dispensory_product_id = $request->dispensory_product_id;

      $removeDeliveryCart = DeliveryCart::where('customer_id', session('customer_id'))->delete();

      $cart = new DispensaryCart;

      $cart->customer_id = session('customer_id');

      $cart->product_id = $dispensory_product_id;

      $cart->qty = 1;

      if ($cart->save()) {

          $response =

              [
                  'statuscode'=> 200,
                  'message' => "Product added to cart."
              ];

          echo json_encode($response);

      } else {

          $response =

              [
                  'statuscode'=> 400,
                  'message' => "Something went wrong."
              ];

          echo json_encode($response);

      }

  }

//   public function addtocartdelivery(Request $request) {

//       $deliveryProductId = $request->dispensory_product_id;
//       $checkDelivery = DeliveryCart::where('customer_id', session('customer_id'))->pluck('product_id')->first();

//       if(!is_null($checkDelivery)) {

//             $delId = DeliveryProducts::where('id', $deliveryProductId)->pluck('delivery_id')->first();
//             $deliveryId = DeliveryProducts::where('id', $checkDelivery)->pluck('delivery_id')->first();

//             if($delId != $deliveryId) {
//                 $response =
//                 [
//                     'statuscode'=> 202,
//                     'message' => "You currently have items in your cart from another menu. You may only add items from one menu at a time. Would you like to finish your previous order, or start a new cart?."
//                 ];

//                 echo json_encode($response);

//             } else {
//                 $check = DeliveryCart::where('customer_id', session('customer_id'))->where('product_id', $request->dispensory_product_id)->count();

//                 if ($check > 0) {

//                     $response =

//                         [
//                             'statuscode'=> 201,
//                             'message' => "Product Already added to cart."
//                         ];

//                     echo json_encode($response);

//                 } else {

//                     $cart = new DeliveryCart;

//                     $cart->customer_id = session('customer_id');
//                     $cart->product_id = $request->dispensory_product_id;

//                     $cart->qty = 1;
//                     $cartSaved = $cart->save();

//                     $cartCount = DeliveryCart::where('customer_id', session('customer_id'))->count();

//                     if ($cartSaved) {

//                         $response =

//                             [
//                                 'statuscode'=> 200,
//                                 'message' => "Product added to cart.",
//                                 'cartCount' => $cartCount
//                             ];

//                         echo json_encode($response);

//                     } else {

//                         $response =

//                             [
//                                 'statuscode'=> 400,
//                                 'message' => 'Semething went wrong.'
//                             ];

//                         echo json_encode($response);

//                     }

//                 }
//             }
//         } else {

//             $cart = new DeliveryCart;

//             $cart->customer_id = session('customer_id');
//             $cart->product_id = $request->dispensory_product_id;

//             $cart->qty = 1;

//             $cartSaved = $cart->save();

//             $cartCount = DeliveryCart::where('customer_id', session('customer_id'))->count();

//             if ($cartSaved) {

//                 $response =

//                     [
//                         'statuscode'=> 200,
//                         'message' => "Product added to cart.",
//                         'cartCount' => $cartCount
//                     ];

//                 echo json_encode($response);

//             } else {

//                 $response =

//                     [
//                         'statuscode'=> 400,
//                         'message' => 'Semething went wrong.'
//                     ];

//                 echo json_encode($response);

//             }

//        }

//   }


public function addtocartdelivery(Request $request) {

    $deliveryProductId = $request->dispensory_product_id;
    $checkDelivery = DeliveryCart::where('customer_id', session('customer_id'))->pluck('product_id')->first();

    $dealsClaimed = DealsClaimed::where('customer_id', session('customer_id'))->get();

    if($dealsClaimed->count() > 0) {
      $dealId = $dealsClaimed->pluck('deal_id')->first();
      $retailerId = Deal::where('id', $dealId)->pluck('retailer_id')->first();

      $delId = DeliveryProducts::where('id', $deliveryProductId)->pluck('delivery_id')->first();

      if($delId != $retailerId) {
          $response =
              [
                  'statuscode'=> 202,
                  'message' => "You currently have items in your cart from another menu. You may only add items from one menu at a time. Would you like to finish your previous order, or start a new cart?."
              ];

              echo json_encode($response);
           return;
      }
    }

    if(!is_null($checkDelivery)) {

          $delId = DeliveryProducts::where('id', $deliveryProductId)->pluck('delivery_id')->first();
          $deliveryId = DeliveryProducts::where('id', $checkDelivery)->pluck('delivery_id')->first();

          if($delId != $deliveryId) {
              $response =
              [
                  'statuscode'=> 202,
                  'message' => "You currently have items in your cart from another menu. You may only add items from one menu at a time. Would you like to finish your previous order, or start a new cart?."
              ];

              echo json_encode($response);

          } else {
              $check = DeliveryCart::where('customer_id', session('customer_id'))->where('product_id', $request->dispensory_product_id)->count();

              if ($check > 0) {

                  $response =

                      [
                          'statuscode'=> 201,
                          'message' => "Product Already added to cart."
                      ];

                  echo json_encode($response);

              } else {

                  $cart = new DeliveryCart;

                  $cart->customer_id = session('customer_id');
                  $cart->product_id = $request->dispensory_product_id;

                  $cart->qty = 1;
                  $cartSaved = $cart->save();

                  $cartCount = DeliveryCart::where('customer_id', session('customer_id'))->count();

                  if ($cartSaved) {

                      $response =

                          [
                              'statuscode'=> 200,
                              'message' => "Product added to cart.",
                              'cartCount' => $cartCount
                          ];

                      echo json_encode($response);

                  } else {

                      $response =

                          [
                              'statuscode'=> 400,
                              'message' => 'Semething went wrong.'
                          ];

                      echo json_encode($response);

                  }

              }
          }
      } else {

          $cart = new DeliveryCart;

          $cart->customer_id = session('customer_id');
          $cart->product_id = $request->dispensory_product_id;

          $cart->qty = 1;

          $cartSaved = $cart->save();

          $cartCount = DeliveryCart::where('customer_id', session('customer_id'))->count();

          if ($cartSaved) {

              $response =

                  [
                      'statuscode'=> 200,
                      'message' => "Product added to cart.",
                      'cartCount' => $cartCount
                  ];

              echo json_encode($response);

          } else {

              $response =

                  [
                      'statuscode'=> 400,
                      'message' => 'Semething went wrong.'
                  ];

              echo json_encode($response);

          }

     }

}


  public function removedcartadddelivery(Request $request) {

      $dispensory_product_id = $request->dispensory_product_id;

      $removeDeliveryCart = DeliveryCart::where('customer_id', session('customer_id'))->delete();

      $cart = new DeliveryCart;

      $cart->customer_id = session('customer_id');

      $cart->product_id = $dispensory_product_id;

      $cart->qty = 1;

      $cartSaved = $cart->save();
      $cartCount = DeliveryCart::where('customer_id', session('customer_id'))->count();

      if ($cartSaved) {

          $response =

              [
                  'statuscode'=> 200,
                  'message' => "Product added to cart.",
                  'cartCount' => $cartCount
              ];

          echo json_encode($response);

      } else {

          $response =

              [
                  'statuscode'=> 400,
                  'message' => "Something went wrong."
              ];

          echo json_encode($response);

      }

  }

  public function deals() {

      $slidesdesktop = [];

      if (!empty(session('latitude')) AND !empty(session('longitude'))) {

          $latitude = session('latitude');
          $longitude = session('longitude');

          $geo = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $latitude . "," . $longitude . "&key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8");

          $dat = json_decode($geo, true);
          $location = $dat['results'][3]['formatted_address'];
          // $location = $dat['results'][0]['address_components'][3]['long_name'];


          $businesses = DB::table('businesses')
              ->selectRaw("businesses.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
              ->having("distance", "<", 250000)
              ->orderBy("distance",'asc')
              ->where('approve', 1)
              ->limit(10)
              ->get();

            // $topdesktops = DealSlide::all();

            //   if($topdesktops->count() > 0) {

            //     foreach($topdesktops as $desktop) {

            //       $desktop_slide_radius = $desktop->slide_radius * 6378160;

                  $slidesdesktop = DB::table('deal_slides')
                      ->selectRaw("deal_slides.* ,
                       ( 6371000 * acos( cos( radians(?) ) *
                         cos( radians( latitude ) )
                         * cos( radians( longitude ) - radians(?)
                         ) + sin( radians(?) ) *
                         sin( radians( latitude ) ) )
                       ) AS distance", [$latitude, $longitude, $latitude])
                      ->having("distance", "<", DB::raw("slide_radius * 1000"))
                      ->orderBy("distance",'asc')
                      ->where('display_type', 'Desktop')
                      ->get();
            //     }

            //   }

          $categories = Category::orderBy('id', 'DESC')->get();

      } else {

         $latitude = "34.0201613";
          $longitude = "-118.6919234";

          $location = 'Los Angeles, California, USA';

          $businesses = DB::table('businesses')
          ->selectRaw("businesses.* ,
           ( 6371000 * acos( cos( radians(?) ) *
             cos( radians( latitude ) )
             * cos( radians( longitude ) - radians(?)
             ) + sin( radians(?) ) *
             sin( radians( latitude ) ) )
           ) AS distance", [$latitude, $longitude, $latitude])
          ->having("distance", "<", 250000)
          ->orderBy("distance",'asc')
          ->where('approve', 1)
          ->limit(10)
          ->get();;

          $categories = Category::orderBy('id', 'DESC')->get();

      }

      return view('deals')
          ->with('dealSlides', $slidesdesktop)
          ->with('location', $location)
          ->with('businesses', $businesses)
          ->with('categories', $categories);
  }

//   public function strains() {

//       $posts = StrainPost::orderBy('id', 'DESC')->get();

//       return view('strains')
//           ->with('posts', $posts);

//   }

  public function strains() {

    $strainBanner = StrainBanner::where('id', 1)->first();

    $posts = StrainPost::orderBy('id', 'DESC')->get();

    return view('strains')
        ->with('posts', $posts)
        ->with('strainBanner', $strainBanner);

}

  public function strainsingle($id) {

      $post = StrainPost::where('id', $id)->first();

      return view('strainsingle')
          ->with('post', $post);

  }

  public function searchstrain(Request $request) {

      $string = $request->search;

      $searchValues = preg_split('/\s+/', $string, -1, PREG_SPLIT_NO_EMPTY);

      $posts = StrainPost::where(function ($q) use ($searchValues) {
        foreach ($searchValues as $value) {
          $q->orWhere('description', 'like', "%{$value}%");
        }
      })->get();

      // $posts = StrainPost::where('description', 'like', '%$request->search%')->get();

      return view('strains')
          ->with('posts', $posts);

  }

  public function categories() {

      $categories = Category::with('types')
          ->get();

      return view('categories')
          ->with('categories', $categories);

  }

  public function gettypesubcategories(Request $request) {

      $category_id = $request->category_id;

      $types = CategoryType::where('category_id', $category_id)->get();

      $data = '

          <div class="row categoriesCols">
              ';
              foreach($types as $type) {
                  $data .='
                  <div class="col-md-3">
                      <h6 class="pb-2"><strong>' . $type->name . '</strong></h6>
                      <ul class="list-unstyled">';

                      $subcategories = SubCategory::where('type_id', $type->id)->where('parent_id', 0)->get();

                      foreach($subcategories as $subcat) {
                          $data .= '

                              <li class="mb-2">
                                  <label>
                                      <input rel="' . $subcat->name . '" type="radio" class="childOfParentSC" name="type_' . $type->name . '" value="' . $subcat->id . '" required=""> ' . $subcat->name . ' <a href="' . route("categorywisewise", ["catname" => $subcat->name]) . '">&nbsp;<i class="fas fa-sign-out-alt"></i></a>
                                  </label>
                              </li>

                          ';
                      }

                      $data .='</ul>
                  </div>';
              }
          $data .= "
              <script>

                  $('.childOfParentSC').on('click', function() {
                      var subcat_id = $(this).val();
                      var type_name = $(this).attr('rel');
                      var selected = $(this).attr('rel');
                      var main = $('.selectedcats').text();
                      $('#categoryTypes').addClass('loader');
                      $.ajax({
                          headers: {
                            'X-CSRF-TOKEN': '" . csrf_token() . "'
                          },
                          url:'" . route("getparentchildsubcat") . "',
                          method:'POST',
                          data:{subcat_id:subcat_id, type_name:type_name},
                          success:function(data) {
                              $('.subchild').remove();
                              $('.categoriesCols').append(data);

                              let str = main;
                              if(str.includes(selected)) {

                              } else {
                                  $('.selectedcats').html(main + selected + ', ');
                              }
                              $('#categoryTypes').removeClass('loader');
                          }
                      });

                  });

              </script>
          </div>
          ";

      $response = [
                      'statuscode'=> 200,
                      'data' => $data
                  ];

      echo json_encode($response);

  }

  public function getparentchildsubcat(Request $request) {

      $subcategories = SubCategory::where('parent_id', $request->subcat_id)->get();
      $data = '';

      if ($subcategories->count() > 0) {

          $data .='
              <div class="col-md-3 subchild">
                  <h6 class="pb-2"><strong>' . $request->type_name . ' Type</strong></h6>
                  <ul class="list-unstyled">';

                  foreach($subcategories as $subcat) {
                      $data .= '

                          <li class="mb-2">
                              <label>
                                  <a href="' . route("categorywisewise", ["catname" => $subcat->name]) . '">' . $subcat->name . ' &nbsp;<i class="fas fa-sign-out-alt"></i></a>
                              </label>
                          </li>

                      ';
                  }

                  $data .='</ul>
              </div>
              <script>
                  $(".childOfParentSC").on("click", function(){
                      var selected = $(this).attr("rel");
                      var main = $(".selectedcats").text();
                      let str = main;
                      if(str.includes(selected)) {
                          main.replace(selected+", ","");
                      } else {
                          $(".selectedcats").html(main + selected + ", ");
                      }
                  });
              </script>

              ';

          echo $data;

      }

  }

  public function categorywisewise($catname) {

      $searchValues = preg_split('/\s+/', $catname, -1, PREG_SPLIT_NO_EMPTY);

      $products = BrandProduct::with('reviews')
          ->where('status', 1)
          ->where(function ($q) use ($searchValues) {
        foreach ($searchValues as $value) {
          $q->orWhere('brand_products.subcategory_names', 'like', "%{$value}%");
          $q->orWhere('brand_products.name', 'like', "%{$value}%");
          $q->orWhere('brand_products.description', 'like', "%{$value}%");
        }
      })->get();

      return view('categorywisewise')
          ->with('products', $products);

  }

  public function signin() {

      return view('signin');

  }

  public function signup() {

      return view('signup');

  }

  public function forgotpassword() {

      return view('forgotpassword');

  }

  public function cart() {

      $business = "";

      $deliverycart = DeliveryCart::join('delivery_products', 'delivery_carts.product_id', '=', 'delivery_products.id')
          ->where('delivery_carts.customer_id', '=', session('customer_id'))
          ->select(
              'delivery_carts.id AS cartid',
              'delivery_carts.product_id',
              'delivery_products.delivery_id',
              'delivery_products.name',
              'delivery_products.image',
              'delivery_products.price AS price',
              'delivery_carts.qty'
          )
          ->get();

      $dispensarycart = DispensaryCart::join('dispensery_products', 'dispensary_carts.product_id', '=', 'dispensery_products.id')
          ->where('dispensary_carts.customer_id', '=', session('customer_id'))
          ->select(
              'dispensary_carts.id AS cartid',
              'dispensary_carts.product_id',
              'dispensery_products.dispensery_id',
              'dispensery_products.name',
              'dispensery_products.image',
              'dispensery_products.price AS price',
              'dispensary_carts.qty'
          )
          ->get();

        $dealsClaimed = DealsClaimed::where('customer_id', session('customer_id'))->join('deals', 'deals.id', '=', 'deals_claimeds.deal_id')
        ->get();

        $deliverySingle = DeliveryCart::first();

        if(!is_null($deliverySingle)) {
            $deliveryId = DeliveryProducts::where('id', $deliverySingle->product_id)->pluck('delivery_id')->first();
            $business = Business::where('id', $deliveryId)->first();
        }

      return view('carts')
          ->with('business', $business)
          ->with('deliverycart', $deliverycart)
          ->with('dispensarycart', $dispensarycart)
          ->with('dealsClaimed', $dealsClaimed);

  }

  public function deletedeliverycartitem($id) {

      $item = DeliveryCart::find($id);

      $item->delete();

      return redirect()->back()->with('error', 'Product removed.');

  }

  public function notifications() {

      return view('notifications');

  }

  public function favorites() {

      $favorites = Favorite::where('customer_id', session('customer_id'))->get();

      return view('favorites')
          ->with('favorites', $favorites);

  }

  public function addabusiness() {

      return view('addabusiness');

  }

  public function saveabusiness(Request $request) {

      if($request->password != $request->confirm_password) {
        return redirect()->back()->with('error', 'Passwords do not match.')->withInput();
      }

    //   $brand = Business::where('email', $request->email)->where('business_type', 'brand')->first();

    //   if(!is_null($brand)) {
    //       if($request->business_type == 'brand') {
    //         return redirect()->back()->with('error', 'Email already exist.')->withInput();
    //       }
    //   }

    //   $delivery = Business::where('email', $request->email)->where('business_type', 'delivery')->first();

    //   if(!is_null($delivery)) {

    //     if($request->business_type == 'delivery') {
    //         return redirect()->back()->with('error', 'Email already exist.')->withInput();
    //     }

    //     $dispensary = Business::where('email', $request->email)->where('business_type', 'dispensary')->first();

    //     if(!is_null($dispensary)) {
    //         return redirect()->back()->with('error', 'Email already exist.')->withInput();
    //     }
    //   }


    //   $dispensary = Business::where('email', $request->email)->where('business_type', 'dispensary')->first();

    //   if(!is_null($dispensary)) {

    //     if($request->business_type == 'dispensary') {
    //         return redirect()->back()->with('error', 'Email already exist.')->withInput();
    //     }

    //     $delivery = Business::where('email', $request->email)->where('business_type', 'delivery')->first();

    //     if(!is_null($delivery)) {
    //         return redirect()->back()->with('error', 'Email already exist.')->withInput();
    //     }
    //   }


      $businessTypes = ['brand', 'delivery', 'dispensary'];

      if(!in_array($request->business_type, $businessTypes)) {
        return redirect()->back()->with('error', 'Sorry something went wrong.')->withInput();
      } else {
          $business = Business::where('email', $request->email)->where('business_type', $request->business_type)->first();

          if(!is_null($business)) {
            return redirect()->back()->with('error', 'Email already exist.')->withInput();
          }
      }

      $business = new Business;

      $business->first_name = $request->first_name;
      $business->last_name = $request->last_name;
      $business->phone_number = $request->phone_number;
      $business->email = $request->email;
      $business->password = Hash::make($request->password);
      $business->role = $request->role;
      $business->business_name = $request->business_name;
      $business->business_type = $request->business_type;
      $business->country = $request->country;
      $business->address_line_1 = $request->address_line_1;
      $business->address_line_2 = $request->address_line_2;
      $business->city = $request->city;
      $business->profile_picture = "https://420finder.net/assets/img/logo.png";
      $business->state_province = $request->state_province;
      $business->postal_code = $request->postal_code;
      $business->website = $request->website;
      $business->license_number = $request->license_number;
      $business->license_type = $request->license_type;
      $business->license_expiration = $request->license_expiration;
      $business->status = 1;

      if ($business->save()) {

        //   $user = new User;

        //   $user->name = $request->first_name . ' ' . $request->last_name;

        //   $user->email = $request->email;

        //   $user->profile = "https://420finder.net/assets/img/logo.png";

        //   $user->password = Hash::make($request->password);

        //   $user->save();

          Mail::to($request->email)->send(new AddBusiness($business));

          return redirect()->route('businesssubmitted')->with('info', 'Your business details are submitted. Our account manager will process your submitted information and reach out to your soon.');

      } else {

          return redirect()->back()->with('error', 'Problem saving your business details.')->withInput();

      }

  }

  public function savenewstore(Request $request) {

      $business = new Business;

      $business->first_name = $request->first_name;
      $business->last_name = $request->last_name;
      $business->phone_number = $request->phone_number;

      $check = Business::where('email', session('business_email'))->first();

      $business->email = session('business_email');
      $business->password = $check->password;

      $business->role = $request->role;
      $business->business_name = $request->business_name;
      $business->business_type = $request->business_type;
      $business->country = $request->country;
      $business->address_line_1 = $request->address_line_1;
      $business->address_line_2 = $request->address_line_2;
      $business->city = $request->city;
      $business->state_province = $request->state_province;
      $business->postal_code = $request->postal_code;
      $business->website = $request->website;
      $business->license_number = $request->license_number;
      $business->license_type = $request->license_type;
      $business->license_expiration = $request->license_expiration;
      $business->status = 1;

      if ($business->save()) {

        $checkEmail = User::where('email', $request->email)->count();

        if ($checkEmail > 0) {
          return redirect()->back()->with('error', 'Email already exists.');
        } else {

          $user = new User;

          $user->name = $request->first_name . ' ' . $request->last_name;

          $user->email = $request->email;

          $user->password = Hash::make($request->password);

          $user->save();

          return redirect()->back()->with('info', 'Your store has been created.');

        }

      } else {

          return redirect()->back()->with('error', 'Problem saving your business details.');

      }

  }

  public function businesssubmitted() {

      return view('businesssubmitted');

  }

  public function brands() {

      if (!empty(session('latitude')) AND !empty(session('longitude'))) {

          $latitude = session('latitude');
          $longitude = session('longitude');


          $geo = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $latitude . "," . $longitude . "&key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8");

          $dat = json_decode($geo, true);
          $location = $dat['results'][3]['formatted_address'];
          // $location = $dat['results'][0]['address_components'][3]['long_name'];

          $brands = DB::table('brands')
              ->selectRaw("brands.* ,
               ( 6371000 * acos( cos( radians(?) ) *
                 cos( radians( latitude ) )
                 * cos( radians( longitude ) - radians(?)
                 ) + sin( radians(?) ) *
                 sin( radians( latitude ) ) )
               ) AS distance", [$latitude, $longitude, $latitude])
              ->having("distance", "<", 250000)
              ->orderBy("distance",'asc')
              ->where('status', 1)
              ->get();

      } else {
          $location = [];
          $brands = [];
      }

      return view('brands')
          ->with('location', $location)
          ->with('brands', $brands);

  }

  public function brandsingle($slug, $id) {

      $brand = Brand::with('business:id,business_name,phone_number,email,business_type,country,address_line_1,address_line_2,city,state_province,postal_code')->where('id', $id)->first();

      $feeds = BrandFeed::where('brand_id', $id)->get();

      $featuredproducts = BrandProduct::with('reviews')->where('brand_id', $id)
          ->where('is_featured', 1)
          ->where('status', 1)
          ->get();

      $products = BrandProduct::with('reviews')->where('brand_id', $id)
          ->where('status', 1)
          ->get();

      return view('brandsingle')
          ->with('brand', $brand)
          ->with('feeds', $feeds)
          ->with('featuredproducts', $featuredproducts)
          ->with('products', $products);

  }

  public function brandproductsingle($slug, $id) {

      $id = decrypt($id);

      $product = BrandProduct::with('reviews')->with('gallery')->where('id', $id)->first();
      // dd($product);
      return view('brandproductsingle')
          ->with('product', $product);

  }

  public function favoritebrand(Request $request) {

      $check = Favorite::where('customer_id', session('customer_id'))
          ->where('type_id', $request->brand_id)
          ->where('fav_type', $request->fav_type)
          ->count();

      if ($check > 0) {

          $response = [
                          'statuscode'=> 400,
                          'message' => 'Already added to favorite.'
                      ];

          echo json_encode($response);

      } else {

          $fav = new Favorite;

          $fav->customer_id = session('customer_id');

          $fav->type_id = $request->brand_id;

          $fav->fav_type = $request->fav_type;

          if ($fav->save()) {

              $response = [
                              'statuscode'=> 200,
                              'message' => 'Added to favorite.'
                          ];

              echo json_encode($response);

          } else {

              $response = [
                              'statuscode'=> 400,
                              'message' => 'Something went wrong.'
                          ];

              echo json_encode($response);

          }

      }

  }

  public function favbrandproduct(Request $request) {

      $check = Favorite::where('customer_id', session('customer_id'))
          ->where('type_id', $request->brand_product_id)
          ->where('fav_type', $request->fav_type)
          ->count();

      if ($check > 0) {

          $response = [
                          'statuscode'=> 400,
                          'message' => 'Already added to favorite.'
                      ];

          echo json_encode($response);

      } else {

          $fav = new Favorite;

          $fav->customer_id = session('customer_id');

          $fav->type_id = $request->brand_product_id;

          $fav->fav_type = $request->fav_type;

          if ($fav->save()) {

              $response = [
                              'statuscode'=> 200,
                              'message' => 'Added to favorite.'
                          ];

              echo json_encode($response);

          } else {

              $response = [
                              'statuscode'=> 400,
                              'message' => 'Something went wrong.'
                          ];

              echo json_encode($response);

          }

      }

  }

  public function favdispensary(Request $request) {

      $check = Favorite::where('customer_id', session('customer_id'))
          ->where('type_id', $request->dispensary_id)
          ->where('fav_type', $request->fav_type)
          ->count();

      if ($check > 0) {

          $response = [
                          'statuscode'=> 400,
                          'message' => 'Already added to favorite.'
                      ];

          echo json_encode($response);

      } else {

          $fav = new Favorite;

          $fav->customer_id = session('customer_id');

          $fav->type_id = $request->dispensary_id;

          $fav->fav_type = $request->fav_type;

          if ($fav->save()) {

              $response = [
                              'statuscode'=> 200,
                              'message' => 'Added to favorite.'
                          ];

              echo json_encode($response);

          } else {

              $response = [
                              'statuscode'=> 400,
                              'message' => 'Something went wrong.'
                          ];

              echo json_encode($response);

          }

      }

  }

  public function favretailerproduct(Request $request) {

      $check = Favorite::where('customer_id', session('customer_id'))
          ->where('type_id', $request->retailer_id)
          ->where('fav_type', $request->fav_type)
          ->count();

      if ($check > 0) {

          $response = [
                          'statuscode'=> 400,
                          'message' => 'Already added to favorite.'
                      ];

          echo json_encode($response);

      } else {

          $fav = new Favorite;

          $fav->customer_id = session('customer_id');

          $fav->type_id = $request->retailer_id;

          $fav->fav_type = $request->fav_type;

          if ($fav->save()) {

              $response = [
                              'statuscode'=> 200,
                              'message' => 'Added to favorite.'
                          ];

              echo json_encode($response);

          } else {

              $response = [
                              'statuscode'=> 400,
                              'message' => 'Something went wrong.'
                          ];

              echo json_encode($response);

          }

      }

  }

  public function favdelivery(Request $request) {

      $check = Favorite::where('customer_id', session('customer_id'))
          ->where('type_id', $request->delivery_product_id)
          ->where('fav_type', $request->fav_type)
          ->count();

      if ($check > 0) {

          $response = [
                          'statuscode'=> 400,
                          'message' => 'Already added to favorite.'
                      ];

          echo json_encode($response);

      } else {

          $fav = new Favorite;

          $fav->customer_id = session('customer_id');

          $fav->type_id = $request->delivery_product_id;

          $fav->fav_type = $request->fav_type;

          if ($fav->save()) {

              $response = [
                              'statuscode'=> 200,
                              'message' => 'Added to favorite.'
                          ];

              echo json_encode($response);

          } else {

              $response = [
                              'statuscode'=> 400,
                              'message' => 'Something went wrong.'
                          ];

              echo json_encode($response);

          }

      }

  }

  public function termsofuse() {

      $terms = TermOfUse::all();

      return view('termsofuse')
          ->with('terms', $terms);

  }

  public function privacypolicy() {

      $policy = Admin::select('privacypolicy')->first();

      return view('privacypolicy')
          ->with('policy', $policy);

  }

  public function cookiepolicy() {

      $cookie = Admin::select('cookiepolicy')->first();

      return view('cookiepolicy')
          ->with('cookie', $cookie);

  }

  public function referalprogram() {

      $referral = Admin::select('referalprogram')->first();

      return view('referalprogram')
          ->with('referral', $referral);

  }

  public function business() {

      return view('business');

  }

  public function businesspages() {

      return view('businesspages');

  }

  public function businessads() {

      return view('businessads');

  }

  public function businessdeals() {

      return view('businessdeals');

  }

  public function businessorders() {

      return view('businessorders');

  }


  public function addnewstore() {

    return view('business.stores.create');

  }

}

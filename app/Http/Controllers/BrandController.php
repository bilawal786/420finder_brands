<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Image;

use App\Models\Brand;

use App\Models\Strain;

use App\Models\Genetic;

use App\Models\Business;

use App\Models\Category;

use App\Models\BrandFeed;

use App\Models\RetailOrder;

use App\Models\SubCategory;

use Illuminate\Support\Str;

use App\Models\BrandProduct;

use App\Models\CategoryType;

use Illuminate\Http\Request;

use App\Models\ProductRequest;

use App\Models\DeliveryProducts;
use App\Models\DispenseryProduct;
use App\Services\AuthorizeService;
use App\Models\BrandProductGallery;
use Illuminate\Support\Facades\File;
use App\Models\DeliveryProductGallery;
use App\Models\DispenseryProductGallery;

class BrandController extends Controller {

    public function index() {
        $brands = Business::where('email', session('business_email'))->where('business_type', 'Brand')->get();
//        $brands = Brand::where('business_id', session('business_id'))
//            ->get();

        return view('business.brands.index')
            ->with('brands', $brands);

    }

    public function create() {

        $state = \Illuminate\Support\Facades\DB::table('states')->get();

        return view('business.brands.create', compact('state'));

    }

    public function save(Request $request) {

        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'license_type' => 'required',
            'license_number' => 'required',
            'yt_featured_url' => 'required',
            'yt_playlist_url' => 'required',
            'website_url' => 'required',
            'instagram_url' => 'required',
            'twitter_url' => 'required',
            'facebook_url' => 'required',
            'status' => 'required',
            'logo' => 'required|image',
            'cover' => 'required|image'
        ]);

        $myBusiness = Business::where('id', session('business_id'))->first();
        $brand = new Business();
        $brand->business_name = $request->name;
        $brand->introduction = $request->description;
        $brand->email = $myBusiness->email;
        $brand->phone_number = $myBusiness->phone_number;
        $brand->business_type = "Brand";
        $brand->address_line_1 = $request->address_line_1;
        $brand->address_line_2 = $request->address_line_2;
        $brand->city = $request->city;
//        $brand->state_province = $request->state_province;
        $brand->country = 'United States';
        $brand->postal_code = $request->postal_code;
        $brand->license_expiration = $request->license_expiration;
        $brand->latitude = $request->latitude;
        $brand->longitude = $request->longitude;


        if($request->hasFile('logo')) {
            $avatar = $request->file('logo');
            $filename = time() . '.' . $avatar->GetClientOriginalExtension();
            $avatar_img = Image::make($avatar);
            $avatar_img->resize(256,250)->save(public_path('images/brands/logo/' . $filename));
            $brand->profile_picture = asset("images/brands/logo/" . $filename);
        }
        if($request->hasFile('cover')) {
            $avatar = $request->file('cover');
            $filename = time() . '.' . $avatar->GetClientOriginalExtension();
            $avatar_img = Image::make($avatar);
            $avatar_img->resize(770,218)->save(public_path('images/brands/cover/' . $filename));
            $brand->cover = asset("images/brands/cover/" . $filename);
        }
        $brand->license_type = $request->license_type;
        $brand->license_number = $request->license_number;
        $brand->yt_featured_url = $request->yt_featured_url;
        $brand->yt_playlist_url = $request->yt_playlist_url;
        $brand->website = $request->website_url;
        $brand->instagram = $request->instagram_url;
        $brand->twitter = $request->twitter_url;
        $brand->facebook = $request->facebook_url;
        $brand->status = $request->status;
        $brand->approve = "0";
        $brand->save();

        DB::table('brand_addresses')->insertGetId([
            'state_id'=>$request->state_province, 'brand_id'=>$brand->id, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()
        ]);

        return redirect()->back()->with('info', 'Brand Created.');

    }

    public function edit($id) {

//        if(is_null($this->checkIfUserBrand($id))) {
//            return redirect()->back();
//        }
        $state = \Illuminate\Support\Facades\DB::table('states')->get();

        $brand = Business::where('id', $id)->first();

        return view('business.brands.edit')
            ->with('brand', $brand)
            ->with('state', $state);

    }

    public function update(Request $request) {

        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'brand_id' => 'required',
            'license_type' => 'required',
            'license_number' => 'required',
            'yt_featured_url' => 'required',
            'yt_playlist_url' => 'required',
            'website_url' => 'required',
            'instagram_url' => 'required',
            'twitter_url' => 'required',
            'facebook_url' => 'required',
            'status' => 'required'
        ]);

//        if(is_null($this->checkIfUserBrand($request->brand_id))) {
//            return redirect()->back();
//        }


        $brand = Business::find($request->brand_id);
        $brand->business_name = $request->name;
        $brand->introduction = $request->description;
        $brand->address_line_1 = $request->address_line_1;
        $brand->address_line_2 = $request->address_line_2;
        $brand->city = $request->city;
//        $brand->state_province = $request->state_province;
        $brand->country = 'United States';
        $brand->postal_code = $request->postal_code;
        $brand->license_expiration = $request->license_expiration;
        $brand->latitude = $request->latitude;
        $brand->longitude = $request->longitude;
        $brandLogo = NULL;
        $brandCover = NULL;
        if($request->hasFile('logo')) {
            $avatar = $request->file('logo');
            $filename = time() . '.' . $avatar->GetClientOriginalExtension();
            $avatar_img = Image::make($avatar);
            $avatar_img->resize(256,250)->save(public_path('images/brands/logo/' . $filename));
            $brandLogo = $brand->logo;
            $brand->profile_picture = asset("images/brands/logo/" . $filename);

        }
        if($request->hasFile('cover')) {
            $avatar = $request->file('cover');
            $filename = time() . '.' . $avatar->GetClientOriginalExtension();
            $avatar_img = Image::make($avatar);
            $avatar_img->resize(770,218)->save(public_path('images/brands/cover/' . $filename));
            $brandCover = $brand->cover;
            $brand->cover = asset("images/brands/cover/" . $filename);
        }
        $brand->license_type = $request->license_type;
        $brand->license_number = $request->license_number;
        $brand->yt_featured_url = $request->yt_featured_url;
        $brand->yt_playlist_url = $request->yt_playlist_url;
        $brand->website = $request->website_url;
        $brand->instagram = $request->instagram_url;
        $brand->twitter = $request->twitter_url;
        $brand->facebook = $request->facebook_url;
        $brand->status = $request->status;
        $saved = $brand->save();
        if($saved) {
            if(!is_null($brandLogo)) {
                $exp = explode('/', $brandLogo);
                $expImage = $exp[count($exp) - 1];

                if(File::exists(public_path('images/brands/logo/'. $expImage))) {
                    File::delete(public_path('images/brands/logo/'. $expImage));
                }
            }

            if(!is_null($brandCover)) {
                $exp = explode('/', $brandCover);
                $expImage = $exp[count($exp) - 1];

                if(File::exists(public_path('images/brands/cover/'. $expImage))) {
                    File::delete(public_path('images/brands/cover/'. $expImage));
                }
            }
        }

        return redirect()->back()->with('info', 'Brand Updated.');

    }

    public function view($id) {

//        if(is_null($this->checkIfUserBrand($id))) {
//            return redirect()->back();
//        }

        $business = Business::where('id', session('business_id'))->first();

        $brand =  Business::where('id', $id)->first();

        $active = "contact-details";

        return view('business.brands.view')
            ->with('active', $active)
            ->with('brand', $brand)
            ->with('business', $business);

    }
    public function accountSetting($id) {

        $brand =  Business::where('id', $id)->first();
        $active = "account-setting";


        return view('business.brands.accountSetting')
            ->with('active', $active)
            ->with('brand', $brand);

    }
    public function brandStates($id) {

        $brand =  Business::where('id', $id)->first();
        $active = "states";
        $states =  DB::table('brand_addresses')->where('brand_id', $id) ->join('states', 'state_id', '=', 'states.id')->get();

        $statesids =  DB::table('brand_addresses')->where('brand_id', $id)->pluck('state_id');

        if(count($statesids) > 0){

            $getstate = DB::table('states')->whereNotIn('id',  $statesids)->get();
        }else{
            $getstate = DB::table('states')->get();
        }

        return view('business.brands.states')
            ->with('active', $active)
            ->with('brand', $brand)
            ->with('states', $states)
            ->with('getstate', $getstate);
    }
    public function addstate(Request $request, $id){
        validator([
            'state_id'=> 'required'
        ]);
        DB::table('brand_addresses')->insertGetId([
            'state_id'=>$request->state_id, 'brand_id'=>$id, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()
        ]);

        return redirect()->back()->with('success', 'State Successfully Added!');
    }
    public function deleteState($id){
        $stateid = request()->state_id;
        DB::table('brand_addresses')->where('brand_id', $id)->where('state_id', $stateid)->delete();
        return redirect()->back()->with('info', 'State Successfully Deleted!');
    }
    public function products($id) {

//        if(is_null($this->checkIfUserBrand($id))) {
//            return redirect()->back();
//        }

        $brand =  Business::where('id', $id)->first();

        $active = "product-management";

        $products = BrandProduct::where('brand_id', $id)
            ->select('id', 'name', 'image', 'sku', 'subcategory_names', 'status', 'category_id', 'suggested_price')
            ->get();

        return view('business.brands.products')
            ->with('active', $active)
            ->with('brand', $brand)
            ->with('products', $products);

    }

    public function savebrandproduct(Request $request) {

        // $authorizePayment = resolve(AuthorizeService::class);
        // $response = $authorizePayment->chargeCreditCard($request);
        // $tresponse = $response->getTransactionResponse();

        // if ($tresponse != null && $tresponse->getMessages() != null) {

        $UUID = (string) Str::uuid();

        $validated = $request->validate([
            'brand_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'sku' => 'required',
            'suggested_price' => 'required',
        ]);

//        if(is_null($this->checkIfUserBrand($request->brand_id))) {
//            return redirect()->back();
//        }

        $product = new BrandProduct;

        $product->brand_id = $request->brand_id;

        $product->name = $request->name;

        $product->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));

        $product->description = $request->description;

        if($request->hasFile('image')) {

            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->GetClientOriginalExtension();

            $avatar_img = Image::make($avatar);
            $avatar_img->resize(274,274)->save(public_path('images/brands/products/' . $filename));

            $product->image = asset("images/brands/products/" . $filename);

        }

        $product->sku = $request->sku;
        $product->suggested_price = $request->suggested_price;
        $product->category_id = $request->category_id;

        // $idsArray = array();
        // $subcategoriesArray = array();
        // $search = "type_";
        // $search_length = strlen($search);

        // foreach ($_POST as $key => $value) {
        //     if (substr($key, 0, $search_length) == $search) {
        //         array_push($subcategoriesArray, substr($key, 5));
        //         array_push($idsArray, $value);
        //     }
        // }

        // $subcategoryids = implode(", ", $idsArray);

        $subcategoryids = NULL;

        // $subcategorynames = implode(", ", $subcategoriesArray);

        $subcategorynames = NULL;

        $product->subcategory_ids = $subcategoryids;
        $product->subcategory_names = $subcategorynames;

        $product->strain_id = $request->strain_id;
        $product->genetic_id = $request->genetic_id;
        $product->thc_percentage = $request->thc_percentage;
        $product->cbd_percentage = $request->cbd_percentage;

        if ($request->is_featured == 'on') {

            $product->is_featured = 1;

        } else {

            $product->is_featured = 0;

        }

        // $product->status = $request->status;
        // $product->is_paid = 1;

        if ($product->save()) {

            // RetailOrder::create([
            //     'brand_id' => $request->brand_id,
            //     'product_id' => $product->id,
            //     'business_id' => session('business_id'),
            //     'amount' => '5.00',
            //     'name_on_card' => $request->name_on_card,
            //     'response_code' => $tresponse->getResponseCode(),
            //     'transaction_id' => $tresponse->getTransId(),
            //     'auth_id' => $tresponse->getAuthCode(),
            //     'message_code' => $tresponse->getMessages()[0]->getCode(),
            //     'quantity' => 1,
            // ]);

            if ($request->hasFile('galleryimages')) {

                foreach($request->file('galleryimages') as $image) {

                    $name = $image->getClientOriginalName();
                    $name = $UUID . '-' . $name;
                    $image->move(public_path('images/brands/products/gallery'), $name);

                    $bpg = new BrandProductGallery;

                    $bpg->brand_product_id = $product->id;
                    $bpg->image = asset("images/brands/products/gallery/" . $name);
                    $bpg->save();

                }

            }

            return redirect()->back()->with('info', 'Product Created.');

        } else {

            return redirect()->back()->with('error', 'Problem occured while creating product.');

        }

    //   } else {

    //     return redirect()->back()->with('error', "Sorry we couldn't process the payment");

    //   }

    }

    public function editbrandproduct($brand_id, $product_id) {


//        if(is_null($this->checkIfUserBrand($brand_id))) {
//            return redirect()->back();
//        }

        $brand = Business::where('id', $brand_id)->first();

        $active = "product-management";

        $categories = Category::all();

        $product = BrandProduct::where('id', $product_id)
            ->first();

        $gallery = BrandProductGallery::where('brand_product_id', $product_id)->get();

        $genetics = Genetic::all();

        $strains = Strain::all();

        return view('business.brands.editproducts')
            ->with('active', $active)
            ->with('brand', $brand)
            ->with('categories', $categories)
            ->with('product', $product)
            ->with('gallery', $gallery)
            ->with('genetics', $genetics)
            ->with('strains', $strains);

    }

    public function removegalleryimage($id) {

        $image = BrandProductGallery::find($id);

        $oldImage = $image->image;

        if(is_null($this->checkIfBrandProduct($image->brand_product_id))) {
            dd('here');
            return redirect()->back();
        }

        $deleted = $image->delete();

        if($deleted) {
            if($oldImage) {
                $exp = explode('/', $oldImage);
                $expImage = $exp[count($exp) - 1];
                if(File::exists(public_path('images/brands/products/gallery/' . $expImage))) {
                    File::delete(public_path('images/brands/products/gallery/' . $expImage));
                }
            }
            return redirect()->back()->with('info', 'Gallery Image Removed Successfully.');
        } else {
            return redirect()->back()->with('info', 'Sorry something went wrong.');
        }


    }

    public function updatebrandproduct(Request $request) {

        $UUID = (string) Str::uuid();

        $validated = $request->validate([
            'product_id' => 'required',
            'brand_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'sku' => 'required',
            'suggested_price' => 'required',
            'status' => 'required'
        ]);

//        if(is_null($this->checkIfUserBrand($request->brand_id))) {
//            return redirect()->back();
//        }

        $product = BrandProduct::find($request->product_id);

        $product->name = $request->name;

        $product->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));

        $product->description = $request->description;

        $oldBrandImage = NULL;
        if($request->hasFile('image')) {

            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->GetClientOriginalExtension();

            $avatar_img = Image::make($avatar);
            $avatar_img->resize(274,274)->save(public_path('images/brands/products/' . $filename));

            $oldBrandImage = $product->image;
            $product->image = asset("images/brands/products/" . $filename);

        }

        $product->sku = $request->sku;
        $product->suggested_price = $request->suggested_price;

        if ($request->is_featured == 'on') {

            $product->is_featured = 1;

        } else {

            $product->is_featured = 0;

        }

        $product->strain_id = $request->strain_id;
        $product->genetic_id = $request->genetic_id;
        $product->thc_percentage = $request->thc_percentage;
        $product->cbd_percentage = $request->cbd_percentage;

        $product->status = $request->status;

        if ($product->save()) {

            // DELETE OLD AVATAR
            if(!is_null($oldBrandImage)) {
                $exp = explode('/', $oldBrandImage);
                $expImage = $exp[count($exp) - 1];

                if(File::exists(public_path('images/brands/products/'.$expImage)))
                {
                    File::delete(public_path('images/brands/products/'.$expImage));
                }
            }

            if ($request->hasFile('galleryimages')) {

                $galleryImages = BrandProductGallery::where('brand_product_id', $product->id)->get();
                                 BrandProductGallery::where('brand_product_id', $product->id)->delete();

                foreach($request->file('galleryimages') as $image) {

                    $name = $image->getClientOriginalName();
                    $name = $UUID . '-' . $name;
                    $image->move(public_path('images/brands/products/gallery'), $name);

                    $bpg = new BrandProductGallery;

                    $bpg->brand_product_id = $product->id;
                    $bpg->image = asset("images/brands/products/gallery/" . $name);
                    $bpg->save();

                }
                // DELETE PREVIOUS GALLERY IMAGES
                if(!is_null($galleryImages)) {
                    foreach($galleryImages as $image) {
                        $exp = explode('/', $image->image);
                        $expImage = $exp[count($exp) - 1];

                        if(File::exists(public_path('images/brands/products/gallery/'.$expImage)))
                        {
                            File::delete(public_path('images/brands/products/gallery/'.$expImage));
                        }
                    }
                }


            }

            // UPDATE DELIVERY PRODUCT
            $deliveryProduct = DeliveryProducts::where('brand_product_id', $request->product_id)->first();

            if(!is_null($deliveryProduct)) {

            $deliveryProduct->name = $request->name;

            $deliveryProduct->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));

            $deliveryProduct->description = $request->description;

            $oldDeliveryImage = NULL;
            if($request->hasFile('image')) {

                $avatar = $request->file('image');
                $filename = time() . '.' . $avatar->GetClientOriginalExtension();

                $avatar_img = Image::make($avatar);
                $avatar_img->resize(274,274)->save(public_path('images/brands/products/' . $filename));

                $oldDeliveryImage = $deliveryProduct->image;

                $deliveryProduct->image = asset("images/brands/products/" . $filename);

            }

            $deliveryProduct->sku = $request->suggested_price;
            $deliveryProduct->price = $request->suggested_price;
            $deliveryProduct->off = $request->off;

            if ($request->is_featured == 'on') {

                $deliveryProduct->is_featured = 1;

            } else {

                $deliveryProduct->is_featured = 0;

            }

            $deliveryProduct->strain_id = $request->strain_id;
            $deliveryProduct->genetic_id = $request->genetic_id;
            $deliveryProduct->thc_percentage = $request->thc_percentage;
            $deliveryProduct->cbd_percentage = $request->cbd_percentage;

            if ($deliveryProduct->save()) {

                // DELETE OLD AVATAR
                if(!is_null($oldDeliveryImage)) {
                    $exp = explode('/', $oldDeliveryImage);
                    $expImage = $exp[count($exp) - 1];

                    if(File::exists(public_path('images/brands/products/'.$expImage)))
                    {
                        File::delete(public_path('images/brands/products/'.$expImage));
                    }
                }

                if ($request->hasFile('galleryimages')) {

                    $deliveryGalleryImgs = DeliveryProductGallery::where('delivery_product_id', $deliveryProduct->id)->get();
                    DeliveryProductGallery::where('delivery_product_id', $deliveryProduct->id)->delete();

                    foreach($request->file('galleryimages') as $image) {

                        $name = $image->getClientOriginalName();
                        $name = $UUID . '-' . $name;
                        $image->move(public_path('images/brands/products/gallery'), $name);

                        $bpg = new DeliveryProductGallery;

                        $bpg->dispensery_product_id = $deliveryProduct->id;
                        $bpg->image = asset("images/brands/products/gallery/" . $name);
                        $bpg->save();

                    }

                    // DELETE PREVIOUS GALLERY IMAGES
                    if(!is_null($deliveryGalleryImgs)) {
                    foreach($deliveryGalleryImgs as $image) {
                        $exp = explode('/', $image->image);
                        $expImage = $exp[count($exp) - 1];

                        if(File::exists(public_path('images/brands/products/gallery/'.$expImage)))
                        {
                            File::delete(public_path('images/brands/products/gallery/'.$expImage));
                        }
                    }
                    }

                }
            }

        }

        // UPDATE DISPENSARY PRODUCT
        $dispensaryProduct = DispenseryProduct::where('brand_product_id', $request->product_id)->first();

        if(!is_null($dispensaryProduct)) {

        $dispensaryProduct->name = $request->name;

        $dispensaryProduct->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));

        $dispensaryProduct->description = $request->description;

        $oldDispensaryImage = NULL;
        if($request->hasFile('image')) {

            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->GetClientOriginalExtension();

            $avatar_img = Image::make($avatar);
            $avatar_img->resize(274,274)->save(public_path('images/brands/products/' . $filename));

            $oldDispensaryImage = $dispensaryProduct->image;
            $dispensaryProduct->image = asset("images/brands/products/" . $filename);

        }

        $dispensaryProduct->sku = $request->sku;
        $dispensaryProduct->price = $request->price;
        $dispensaryProduct->off = $request->off;

        if ($request->is_featured == 'on') {

            $dispensaryProduct->is_featured = 1;

        } else {

            $dispensaryProduct->is_featured = 0;

        }

        $dispensaryProduct->strain_id = $request->strain_id;
        $dispensaryProduct->genetic_id = $request->genetic_id;
        $dispensaryProduct->thc_percentage = $request->thc_percentage;
        $dispensaryProduct->cbd_percentage = $request->cbd_percentage;

        if ($dispensaryProduct->save()) {

            // DELETE OLD AVATAR
            if(!is_null($oldDispensaryImage)) {
                $exp = explode('/', $oldDispensaryImage);
                $expImage = $exp[count($exp) - 1];

                if(File::exists(public_path('images/brands/products/'.$expImage)))
                {
                    File::delete(public_path('images/brands/products/'.$expImage));
                }
            }

            if ($request->hasFile('galleryimages')) {

                $dispensaryGalleryImgs = DispenseryProductGallery::where('dispensery_product_id', $dispensaryProduct->id)->get();
                DispenseryProductGallery::where('dispensery_product_id', $dispensaryProduct->id)->delete();

                foreach($request->file('galleryimages') as $image) {

                    $name = $image->getClientOriginalName();
                    $name = $UUID . '-' . $name;
                    $image->move(public_path('images/brands/products/gallery'), $name);

                    $bpg = new DispenseryProductGallery;

                    $bpg->dispensery_product_id = $dispensaryProduct->id;
                    $bpg->image = asset("images/brands/products/gallery/" . $name);
                    $bpg->save();

                }

                // DELETE PREVIOUS GALLERY IMAGES
                if(!is_null($dispensaryGalleryImgs)) {
                    foreach($dispensaryGalleryImgs as $image) {
                        $exp = explode('/', $image->image);
                        $expImage = $exp[count($exp) - 1];

                        if(File::exists(public_path('images/brands/products/gallery/'.$expImage)))
                        {
                            File::delete(public_path('images/brands/products/gallery/'.$expImage));
                        }
                    }
                }
            }
        }

    }

            return redirect()->back()->with('info', 'Product Updated.');

        } else {

            return redirect()->back()->with('error', 'Problem occured while updated product.');

        }

    }

    public function viewbrandfeeds($id) {

//        if(is_null($this->checkIfUserBrand($id))) {
//            return redirect()->route('index');
//        }

        $brand = Business::where('id', $id)->first();

        $active = "feeds";

        $feeds = BrandFeed::where('business_id', session('business_id'))
            ->where('brand_id', $id)
            ->get();

        return view('business.feeds.index')
            ->with('active', $active)
            ->with('brand', $brand)
            ->with('feeds', $feeds);

    }

    public function savebrandfeed(Request $request) {

        $validated = $request->validate([
            'brand_id' => 'required',
            'description' => 'required',
            'image' => 'required|image'
        ]);

//        if(is_null($this->checkIfUserBrand($request->brand_id))) {
//            return redirect()->back();
//        }

        $feed = new BrandFeed;

        $feed->business_id = session('business_id');

        $feed->brand_id = $request->brand_id;

        if($request->hasFile('image')) {

            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->GetClientOriginalExtension();

            $avatar_img = Image::make($avatar);
            $avatar_img->resize(500,500)->save(public_path('images/brands/posts/' . $filename));

            $feed->image = asset("images/brands/posts/" . $filename);

        }

        $feed->description = $request->description;

        $feed->save();

        return redirect()->back()->with('info', 'New Post Created.');

    }

    public function getfeedsingle(Request $request) {

        $feed = BrandFeed::where('id', $request->feed_id)->first();

        $response = [
                        'statuscode'=> 200,
                        'feed_id'=> $feed->id,
                        'image'=> $feed->image,
                        'description' => $feed->description
                    ];

        echo json_encode($response);

    }

    public function updatebrandfeed(Request $request) {


        $validated = $request->validate([
            'brand_id' => 'required',
            'description' => 'required',
            'feed_id' => 'required'
        ]);

        $checkIfBusinessFeed = BrandFeed::where('id', $request->feed_id)->where('business_id', session('business_id'))->first();

        if(is_null($this->checkIfUserBrand($request->brand_id)) || is_null($checkIfBusinessFeed)) {
            return redirect()->back();
        }

        $feed = BrandFeed::find($request->feed_id);

        $oldImage = NULL;

        if($request->hasFile('image')) {

            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->GetClientOriginalExtension();

            $avatar_img = Image::make($avatar);
            $avatar_img->resize(500,500)->save(public_path('images/brands/posts/' . $filename));

            $oldImage = $feed->image;

            $feed->image = asset("images/brands/posts/" . $filename);

        }

        $feed->description = $request->description;

        if($feed->save()) {

            if(!is_null($oldImage)) {
                $exp = explode('/', $oldImage);
                $expImage = $exp[count($exp) - 1];
                if(File::exists(public_path('images/brands/posts/' . $expImage))) {
                    File::delete(public_path('images/brands/posts/' . $expImage));
                }
            }

            return redirect()->back()->with('info', 'New Post Created.');

        } else {
            return redirect()->back()->with('error', 'Sorry something went wrong.');
        }

    }

    public function removebrandfeed($id) {

        $checkIfUserFeed = BrandFeed::where('id', $id)->where('business_id', session('business_id'))->first();

        if(is_null($checkIfUserFeed)) {
            return redirect()->back();
        }

        $feed = BrandFeed::find($id);

        $oldImage = $feed->image;

        $deleted = $feed->delete();

        if($deleted) {
            if($oldImage) {
                $exp = explode('/', $oldImage);
                $expImage = $exp[count($exp) - 1];
                if(File::exists(public_path('images/brands/posts/' . $expImage))) {
                    File::delete(public_path('images/brands/posts/' . $expImage));
                }
            }

            return redirect()->back()->with('info', 'Feed removed successfully.');

        } else {
            return redirect()->back()->with('error', 'Sorry something went wrong.');
        }

    }

    public function manageverifications( $id) {

//        if(is_null($this->checkIfUserBrand($id))) {
//            return redirect()->route('index');
//        }

        $brand = Business::where('id', $id)->first();

        $requests = ProductRequest::where('brand_id', $id)->get();

        $active = "manage-verifications";

        return view('business.verifications.index')
            ->with('active', $active)
            ->with('brand', $brand)
            ->with('requests', $requests);

    }

    public function approveproductrequest($id) {

        $approve = ProductRequest::find($id);

        $approve->status = 1;

        $approve->save();

        $getBP = ProductRequest::where('id', $id)->first();

        $product_ids = explode(", ", $getBP->products);

        $retailer = Business::where('id', $getBP->retailer_id)->first();

        if ($retailer->business_type == 'Delivery') {

            foreach($product_ids as $product_id) {

                $brandproduct = BrandProduct::where('id', $product_id)->first();

                $dproduct = new DeliveryProducts;

                $dproduct->delivery_id        = $getBP->retailer_id;
                $dproduct->brand_product        = 1;
                $dproduct->brand_product_id     = $brandproduct->id;
                $dproduct->brand_id             = $brandproduct->brand_id;
                $dproduct->name                 = $brandproduct->name;
                $dproduct->slug                 = $brandproduct->name;
                $dproduct->description          = $brandproduct->name;
                $dproduct->price                = $brandproduct->suggested_price;
                $dproduct->image                = $brandproduct->image;
                $dproduct->sku                  = $brandproduct->sku;
                $dproduct->category_id          = $brandproduct->category_id;
                $dproduct->subcategory_ids      = $brandproduct->subcategory_ids;
                $dproduct->subcategory_names    = $brandproduct->subcategory_names;
                $dproduct->strain_id            = $brandproduct->strain_id;
                $dproduct->genetic_id           = $brandproduct->genetic_id;
                $dproduct->thc_percentage       = $brandproduct->thc_percentage;
                $dproduct->cbd_percentage       = $brandproduct->cbd_percentage;
                $dproduct->is_featured          = $brandproduct->is_featured;
                $dproduct->verify       = 1;

                $dproduct->save();

                $gallery = BrandProductGallery::where('brand_product_id', $product_id)->get();

                foreach($gallery as $single) {

                    $image = new DeliveryProductGallery;

                    $image->delivery_product_id = $dproduct->id;

                    $image->image = $single->image;

                    $image->save();

                }

            }

        } else {

            foreach($product_ids as $product_id) {

                $brandproduct = BrandProduct::where('id', $product_id)->first();

                $dproduct = new DispenseryProduct;

                $dproduct->dispensery_id        = $getBP->retailer_id;
                $dproduct->brand_product        = 1;
                $dproduct->brand_product_id     = $brandproduct->id;
                $dproduct->brand_id             = $brandproduct->brand_id;
                $dproduct->name                 = $brandproduct->name;
                $dproduct->slug                 = $brandproduct->name;
                $dproduct->description          = $brandproduct->name;
                $dproduct->price                = $brandproduct->suggested_price;
                $dproduct->image                = $brandproduct->image;
                $dproduct->sku                  = $brandproduct->sku;
                $dproduct->category_id          = $brandproduct->category_id;
                $dproduct->subcategory_ids      = $brandproduct->subcategory_ids;
                $dproduct->subcategory_names    = $brandproduct->subcategory_names;
                $dproduct->strain_id            = $brandproduct->strain_id;
                $dproduct->genetic_id           = $brandproduct->genetic_id;
                $dproduct->thc_percentage       = $brandproduct->thc_percentage;
                $dproduct->cbd_percentage       = $brandproduct->cbd_percentage;
                $dproduct->is_featured          = $brandproduct->is_featured;
                $dproduct->verify       = 1;

                $dproduct->save();

                $gallery = BrandProductGallery::where('brand_product_id', $product_id)->get();

                foreach($gallery as $single) {

                    $image = new DispenseryProductGallery;

                    $image->dispensery_product_id = $dproduct->id;

                    $image->image = $single->image;

                    $image->save();

                }

            }

        }

        return redirect()->back()->with('info', 'Request approved.');

    }

    public function rejectproductrequest($id) {

        $reject = ProductRequest::find($id);

        $reject->status = 0;

        $reject->save();

        return redirect()->back()->with('error', 'Request rejected.');

    }

    public function getrequestedproductslist(Request $request) {

        $request_id = $request->request_id;

        $products = ProductRequest::where('id', $request_id)->first();

        $pids = explode(", ", $products->products);

        $data = "";

        foreach ($pids as $index => $pid) {

            $product = BrandProduct::where('id', $pid)->select('name')->first();

            $data .= "<p class='border-bottom pb-3'><strong>" . $index + 1 . ":</strong> " . $product['name'] . "</p>";

        }

        echo $data;

    }

    public function addbrandproduct($id) {

        $brand =  Business::where('id', $id)->first();

        $active = "product-management";

        $categories = Category::all();

        $genetics = Genetic::all();

        $strains = Strain::all();

        return view('business.brands.createproduct')
            ->with('active', $active)
            ->with('brand', $brand)
            ->with('categories', $categories)
            ->with('genetics', $genetics)
            ->with('strains', $strains);

    }

    public function gettypesubcat(Request $request) {

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

                                <li class="mb-2"><label><input rel="' . $subcat->name . '" type="radio" class="childOfParentSC" name="type_' . $type->name . '" value="' . $subcat->id . '" required=""> ' . $subcat->name . '</label></li>

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
                        $('#typesubcategories').addClass('loader');
                        $.ajax({
                            headers: {
                              'X-CSRF-TOKEN': '" . csrf_token() . "'
                            },
                            url:'" . route("getparentchildsc") . "',
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
                                $('#typesubcategories').removeClass('loader');
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

    public function getparentchildsc(Request $request) {

        $subcategories = SubCategory::where('parent_id', $request->subcat_id)->get();
        $data = '';

        if ($subcategories->count() > 0) {

            $data .='
                <div class="col-md-3 subchild">
                    <h6 class="pb-2"><strong>' . $request->type_name . ' Type</strong></h6>
                    <ul class="list-unstyled">';

                    foreach($subcategories as $subcat) {
                        $data .= '

                            <li class="mb-2"><label><input rel="' . $subcat->name . '" type="radio" class="childOfParentSC" name="type_' . $request->type_name . '" value="' . $subcat->id . '" required=""> ' . $subcat->name . '</label></li>

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

    /*
    *   BRAND PAYMENT
    *
    */
    public function brandPayments($brandSlug, $brandId) {

        if(is_null($this->checkIfUserBrand($brandId))) {

            return redirect()->route('dashboardbrands');

        } else {

            $brand = Brand::where('id', $brandId)->select('id', 'name', 'slug', 'is_paid')->first();

            $active = "payments";

            return view('business.brands.brandpayment')
                ->with('active', $active)
                ->with('brand', $brand);
        }
    }

    /*
    *  STORE BRAND PAYMENT
    *
    */
    public function storeBrandPayment(Request $request) {

        $validated = request()->validate([
            'name_on_card' => 'required|min:2',
            'cvv' => 'required|numeric|digits:3',
            'card_number' => 'required|numeric|digits:16',
            'expiration_month' => 'required',
            'expiration_year' => 'required'
        ]);

        if(!is_null($request->brand_id)) {

        $brand = $this->checkIfUserBrand($request->brand_id);
        if(!is_null($brand)) {

            $createdOuter = "";
            try {

                $authorizePayment = resolve(AuthorizeService::class);
                $response = $authorizePayment->chargeCreditCard($validated);
                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getMessages() != null) {

                    $created = RetailOrder::create([
                        'brand_id' => $brand->id,
                        'business_id' => session('business_id'),
                        'amount' => '5.00',
                        'name_on_card' => $validated['name_on_card'],
                        'response_code' => $tresponse->getResponseCode(),
                        'transaction_id' => $tresponse->getTransId(),
                        'auth_id' => $tresponse->getAuthCode(),
                        'message_code' => $tresponse->getMessages()[0]->getCode(),
                        'quantity' => 1,
                    ]);

                    $brand->update([
                        'is_paid' => 1
                    ]);

                    $createdOuter = $created;

                    if($created) {

                        session()->flash('success', 'Your payment has been successful');
                        return redirect()->route('managebrandpayments', [$brand->slug, $brand->id])->with('paid', $created);

                    } else {

                        session()->flash('error', 'Sorry something went wrong');
                        return redirect()->route('managebrandpayments', [$brand->slug, $brand->id]);

                    }
                } else {

                    session()->flash('error', 'Sorry we couldn\'t process the payment');

                    return redirect()->route('managebrandpayments', [$brand->slug, $brand->id]);

                }

            } catch(Exception $e) {

                $createdOuter->delete();

                $brand->update([
                    'is_paid' => 1
                ]);

                abort(503);
            }


        } else {

            return redirect()->route('dashboardbrands');
        }

        } else {
            return redirect()->route('dashboardbrands');
        }

    }
    /*
    *   CHECK IF USER BRAND
    *
    */
    private function checkIfUserBrand($brandId) {

        $businessId = session('business_id');

        $brand = Brand::where([
            ['id', $brandId],
            ['business_id', $businessId]
        ])->first();

        return $brand;
    }

    /*
    *   CHECK IF BRAND PRODUCT
    *
    */
    private function checkIfBrandProduct($productId) {
        $businessId = session('business_id');

        $product = BrandProduct::where([
            ['id', $productId],
            ['brand_id', $businessId]
        ])->first();

        return $product;
    }



}

<?php

namespace App\Http\Controllers;

use Image;

use Carbon\Carbon;
use App\Models\Deal;
use App\Models\DealOrder;
use App\Models\DealProduct;
use Illuminate\Http\Request;
use App\Models\DeliveryProducts;
use App\Services\AuthorizeService;

class DealsController extends Controller {

    public function index() {

        $deals = Deal::where('retailer_id', session('business_id'))->get();

        return view('deals.index')
            ->with('deals', $deals);

    }

    public function create() {

        $products = DeliveryProducts::where('delivery_id', session('business_id'))->get();
        return view('deals.create', [
            'products' => $products
        ]);

    }

    public function save(Request $request) {

        $validated = request()->validate([
            'title' => 'required',
            'tier_id' => 'required',
            'description' => 'required',
            'deal_price' => 'required',
            'name_on_card' => 'required|min:2',
            'cvv' => 'required|numeric|digits:3',
            'card_number' => 'required|numeric|digits:16',
            'expiration_month' => 'required',
            'expiration_year' => 'required'
        ]);

        if(!is_null($request->product_id) && !is_null($request->product_id_2)) {
            if($request->product_id == $request->product_id_2) {
                return redirect()->back()->with('error', 'Deal products must be different');
            }
        }

            $tiers = [1, 2, 3];
            $price = 0;
            $ending_date = "";

            if(!in_array($validated['tier_id'], $tiers)) {
                return back();
            }

            if($validated['tier_id'] == 1) {

                $ending_date = Carbon::now()->addDays(7)->format('Y-m-d');
                $price = 50.00;

            } elseif($validated['tier_id'] == 2) {

                $ending_date = Carbon::now()->addDays(14)->format('Y-m-d');
                $price = 80.00;

            } elseif($validated['tier_id'] == 3) {

                $ending_date = Carbon::now()->addDays(30)->format('Y-m-d');
                $price = 140.00;

            }

            $starting_date = Carbon::now()->format('Y-m-d');

            $authorizePayment = resolve(AuthorizeService::class);
            $response = $authorizePayment->chargeCreditCard($validated, $price);
            $tresponse = $response->getTransactionResponse();

            if ($tresponse != null && $tresponse->getMessages() != null) {

            $deal = new Deal;

            $deal->retailer_id = session('business_id');
            $deal->title = $request->title;

            $picturePaths = [];

            if($request->hasFile('picture')) {

                $avatars = $request->file('picture');

                foreach($avatars as $avatar) {
                    $filename = time() . '.' . $avatar->GetClientOriginalExtension();

                    $avatar_img = Image::make($avatar);
                    $avatar_img->resize(373,373)->save(public_path('images/deals/' . $filename));

                    $dealPicture = asset("images/deals/" . $filename);
                    array_push($picturePaths, $dealPicture);
                }

            }

            $deal->picture = json_encode($picturePaths);
            $deal->coupon_code = $request->coupon_code;
            $deal->percentage = $request->percentage;
            $deal->tier_id = $validated['tier_id'];
            $deal->deal_price = $validated['deal_price'];
            $deal->starting_date = $starting_date;
            $deal->ending_date = $ending_date;
            $deal->description = $request->description;
            $deal->is_paid = 1;
            $deal->save();

            DealOrder::create([
                'retailer_id' => session('business_id'),
                'deal_id' => $deal->id,
                'amount' => $price,
                'name_on_card' => $validated['name_on_card'],
                'response_code' => $tresponse->getResponseCode(),
                'transaction_id' => $tresponse->getTransId(),
                'auth_id' => $tresponse->getAuthCode(),
                'message_code' => $tresponse->getMessages()[0]->getCode(),
                'quantity' => 1,
            ]);

            if($request->product_id) {
                DealProduct::create([
                    'deal_id' => $deal->id,
                    'product_id' => $request->product_id
                ]);
            }

            if($request->product_id_2) {
                DealProduct::create([
                    'deal_id' => $deal->id,
                    'product_id' => $request->product_id_2
                ]);
            }

            return redirect()->back()->with('info', 'Deal created.');

        } else {

            return redirect()->back()->with('error', 'Sorry we couldn\'t process the payment');

        }

    }

    public function edit($id) {

        $deal = Deal::find($id);
        $dealProducts = DealProduct::where('deal_id', $id)->get();

        $dealProduct1 = $dealProducts->has(0) ? $dealProducts[0] : null;
        $dealProduct2 = $dealProducts->has(1) ? $dealProducts[1] : null;

        $products = DeliveryProducts::where('delivery_id', session('business_id'))->get();

        return view('deals.edit')
            ->with('deal', $deal)
            ->with('dealProduct1', $dealProduct1)
            ->with('dealProduct2', $dealProduct2)
            ->with('products', $products);
    }

    public function update(Request $request) {

        $deal = Deal::find($request->deal_id);

        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deal_price' => 'required',
        ]);

        if(!is_null($request->product_id) && !is_null($request->product_id_2)) {
            if($request->product_id == $request->product_id_2) {
                return redirect()->back()->with('error', 'Deal products must be different');
            }
        }

        $deal->title = $validated['title'];

        $picturePaths = [];

        $avatars = [];

        if($request->hasFile('picture')) {

            $avatars = $request->file('picture');

            foreach($avatars as $avatar) {
                $filename = time() . '.' . $avatar->GetClientOriginalExtension();

                $avatar_img = Image::make($avatar);
                $avatar_img->resize(373,373)->save(public_path('images/deals/' . $filename));

                $dealPicture = asset("images/deals/" . $filename);
                array_push($picturePaths, $dealPicture);
            }

        }

        if(count($avatars) > 0) {
            $deal->picture = json_encode($picturePaths);
        }

        $deal->deal_price = $validated['deal_price'];
        $deal->description = $validated['description'];

        $deal->save();

        DealProduct::where('deal_id', $deal->id)->delete();

        if($request->product_id) {
            DealProduct::create([
                'deal_id' => $deal->id,
                'product_id' => $request->product_id
            ]);
        }

        if($request->product_id_2) {
            DealProduct::create([
                'deal_id' => $deal->id,
                'product_id' => $request->product_id_2
            ]);
        }

        return redirect()->back()->with('info', 'Deal updated.');

    }

    public function deletedeal($id) {

         $deal = Deal::find($id);

         $deal->delete();

         return redirect()->back()->with('info', 'Deal Deleted Successfully.');

    }

}

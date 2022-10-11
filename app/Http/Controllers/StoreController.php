<?php
namespace App\Http\Controllers;
use App\Models\Business;
class StoreController extends Controller
{
    public function index()
    {
        $brands = Brand::where('status', 1)->select('id', 'name')->get();
        return view('requestproducts.index')
            ->with('brands', $brands);
    }
    public function stores()
    {
        $stores = Business::where('email', session('business_email'))->where('email', '!=', null)->where('business_type', '!=', 'Brand')->get();
        return view('business.stores.index')
            ->with('stores', $stores);
    }
}

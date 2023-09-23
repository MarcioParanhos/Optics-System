<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// Models
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        $loggedInUser = Auth::user();
        return view('brands.show_brands', [
            'loggedInUser' => $loggedInUser,
            'brands' => $brands,
        ]);
    }

    public function create(Request $request)
    {

        $loggedInUser = Auth::user();
        $brand = new Brand;
        $brand->brand = $request->brand;
        $brand->category = $request->category;
        $brand->situation = $request->situation;
        $brand->user_id = $request->user_id;
        $brand->release_date = $request->release_date;
        $brand->additional_information = $request->additional_information;
        $brand->company = $loggedInUser->profile->company;
        $brand->save();
        return  redirect()->to(url()->previous())->with('msg', 'success');

    }
}

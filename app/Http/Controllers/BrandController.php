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
        $brands = Brand::withCount('frames')->get();
        $loggedInUser = Auth::user();
        $title = "Marcas";
        return view('brands.show_brands', [
            'loggedInUser' => $loggedInUser,
            'brands' => $brands,
            'title' => $title,
        ]);
    }

    public function create(Request $request)
    {

        $loggedInUser = Auth::user();
        $brand = new Brand;
        $brand->name = $request->brand;
        $brand->category = $request->category;
        $brand->situation_id = $request->situation;
        $brand->user_id = $request->user_id;
        $brand->description = $request->additional_information;
        $brand->save();
        return  redirect()->to(url()->previous())->with('msg', 'success');
    }

    public function destroy($id)
    {
        try {

            $brand = Brand::findOrFail($id);
            if ($brand) {
                $brand->delete();
                return  redirect()->to(url()->previous())->with('msg', 'deleted');
            } else {
                return  redirect()->to(url()->previous())->with('msg', 'error');
            }
        } catch (\Exception $e) {
            return  redirect()->to(url()->previous())->with('msg', 'error');
        }
    }

    public function select($id)
    {

        $brand = Brand::find($id);
        return response()->json(['brand' => $brand]);
    }

    public function update(Request $request)
    {

        Brand::findOrFail($request->id)->update($request->all());
        return  redirect()->to(url()->previous())->with('msg', 'updated');
    }
}

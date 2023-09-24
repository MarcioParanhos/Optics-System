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

    public function destroy($id)
    {
        try {

            $brand = Brand::findOrFail($id); // Encontra o registro com o ID especificado
            if ($brand) {
                $brand->delete();
                return  redirect()->to(url()->previous())->with('msg', 'deleted');
            } else {
                return redirect()->route('brands.show')->with('error');
            }
        } catch (\Exception $e) {
            return redirect()->route('brands.show')->with('error', 'Ocorreu um erro ao excluir o Brand: ' . $e->getMessage());
        }
    }

    public function select($id) {

        $brand = Brand::find($id);
        return response()->json(['brand' => $brand]);
        
    }

    public function update (Request $request) {

        Brand::findOrFail($request->id)->update($request->all());
        return  redirect()->to(url()->previous())->with('msg', 'updated');

    }
}
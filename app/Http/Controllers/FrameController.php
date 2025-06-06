<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// Models
use App\Models\Brand;
use App\Models\Frame;

class FrameController extends Controller
{
    public function index()
    {

        $frames = Frame::whereHas('brand', function ($query) {
            $query->where('situation_id', '!=', 2);
        })->with('brand')->get();

        $brands = Brand::where('situation_id', 1)->get();
        $loggedInUser = Auth::user();

        return view('frames.show_frames', [
            'loggedInUser' => $loggedInUser,
            'frames' => $frames,
            'brands' => $brands,
        ]);
    }

    public function create(Request $request)
    {

        $loggedInUser = Auth::user();
        $frame = new Frame;
        $frame->brand_id = $request->brand_id;
        $frame->frame_ref = $request->frame_ref;
        $frame->price = $request->price;
        $frame->os = $request->os;
        $frame->situation_id = $request->situation_id;
        $frame->user_id = $request->user_id;
        $frame->description = $request->description;
        $frame->release_date_of = $request->release_date_of;
        $frame->save();
        return  redirect()->to(url()->previous())->with('msg', 'success');
    }

    public function update(Request $request)
    {

        Frame::findOrFail($request->id)->update($request->all());
        return  redirect()->to(url()->previous())->with('msg', 'updated');
    }

    public function select($id)
    {

        $frame = Frame::find($id);
        return response()->json(['frame' => $frame]);
    }
}

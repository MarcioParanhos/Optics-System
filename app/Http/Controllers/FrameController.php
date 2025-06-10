<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// Models
use App\Models\Brand;
use App\Models\Frame;
use Yajra\DataTables\DataTables;

class FrameController extends Controller
{
    public function index()
    {

        $frames = Frame::whereHas('brand', function ($query) {
            $query->where('situation_id', '!=', 2);
        })->with('brand')->get();
        $title = "Armações";
        $brands = Brand::where('situation_id', 1)->get();
        $loggedInUser = Auth::user();

        return view('frames.show_frames', [
            'loggedInUser' => $loggedInUser,
            'frames' => $frames,
            'brands' => $brands,
            'title' => $title,
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

    public function data()
    {

        $loggedInUser = Auth::user();

        $query = Frame::whereHas('brand', function ($query) {
            $query->where('situation_id', 1);
        })->with('brand', 'situation');

        return DataTables::of($query)
            ->editColumn('brand_name', function ($frame) {
                return $frame->brand->name ?? 'N/A';
            })
            ->editColumn('ref', function ($frame) {
                return $frame->frame_ref ?? 'N/A';
            })
            ->addColumn('price', function ($frame) {
                return 'R$ ' . number_format($frame->price, 2, ',', '.');
            })
            ->addColumn('situation_badge', function ($frame) {
                if (!$frame->situation) {
                    return '<span class="badge bg-secondary-lt">Indefinido</span>';
                }

                $colorClass = match ($frame->situation->id) {
                    1 => 'bg-green',
                    2 => 'bg-danger',
                    default => 'bg-secondary-lt',
                };

                return "<span style=\"width: 80px;\" class=\"badge p-1 {$colorClass}\">{$frame->situation->translated_name}</span>";
            })
            ->addColumn('os', function ($frame) {
                return $frame->os ?? 'N/A';
            })
            ->addColumn('created_at', function ($frame) {
                if ($frame->created_at) {
                    return $frame->created_at->format('d/m/Y');
                }
                return 'N/A';
            })
            ->addColumn('actions', function ($frame) use ($loggedInUser) {
                $buttons = '<a class="btn btn-primary text-white btn p-1 me-1" href="/frames/select/' . $frame->id . '">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                    <path d="M21 21l-6 -6" />
                                </svg>
                            </a>';


                $buttons .= '<a class="btn btn-danger text-white p-1" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="currentColor"
                                                    class="icon icon-tabler icons-tabler-filled icon-tabler-trash">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z" />
                                                    <path
                                                        d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" />
                                                </svg>
                                </a>';


                return $buttons;
            })
            ->filter(function ($query) {
                if (request()->has('search') && !empty(request('search')['value'])) {
                    $searchValue = request('search')['value'];

                    $query->where(function ($q) use ($searchValue) {
                        $q->where('os', 'like', "%{$searchValue}%")
                            ->orWhere('frame_ref', 'like', "%{$searchValue}%")
                            ->orWhere('price', 'like', "%{$searchValue}%")
                            ->orWhereHas('brand', function ($brandQuery) use ($searchValue) {
                                $brandQuery->where('name', 'like', "%{$searchValue}%");
                            })
                            ->orWhereHas('situation', function ($situationQuery) use ($searchValue) {
                                $situationQuery->where('name', 'like', "%{$searchValue}%");
                            });
                    });
                }
            })
            ->rawColumns(['situation_badge', 'actions'])
            ->make(true);
    }
}

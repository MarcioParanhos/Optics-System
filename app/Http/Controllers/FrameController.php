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
        // A sua consulta inicial com Eager Loading está perfeita.
        $query = Frame::with('brand', 'situation');

        return DataTables::of($query)
            ->editColumn('brand_name', function ($frame) {
                // Modifica a coluna 'brand' para exibir apenas o nome.
                return $frame->brand->name ?? 'N/A';
            })
            ->editColumn('ref', function ($frame) {
                // Modifica a coluna 'ref' para usar 'frame_ref'.
                return $frame->frame_ref ?? 'N/A';
            })
            // CORRIGIDO: A coluna 'price' foi adicionada corretamente.
            ->addColumn('price', function ($frame) {
                return 'R$ ' . number_format($frame->price, 2, ',', '.');
            })
            ->addColumn('situation_badge', function ($frame) {
                // Verificação de segurança para evitar erro se a situação for nula.
                if (!$frame->situation) {
                    return '<span class="badge bg-secondary-lt">Indefinido</span>';
                }

                // Sua lógica de 'match' está ótima.
                $colorClass = match ($frame->situation->id) {
                    1 => 'bg-green',
                    2 => 'bg-danger',
                    default => 'bg-secondary-lt',
                };

                return "<span style=\"width: 80px;\" class=\"badge p-1 {$colorClass}\">{$frame->situation->translated_name}</span>";
            })
            // Adicionamos a coluna 'os' aqui.
            ->addColumn('os', function ($frame) {
                return $frame->os ?? 'N/A';
            })
            ->rawColumns(['situation_badge'])
            ->make(true);
    }
}

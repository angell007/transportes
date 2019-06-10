<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Accesorio;
use App\Imports\AccesoriosImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class AccesorioController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:Admin']);
    }

    public function index(Request $request, $idvehiculo)
    {
        $request->session()->put('vehiculo', $idvehiculo);
        $html = app('datatables.html')->columns([
            // ['title' => 'Id', 'data' => 'id'],
            ['title' => 'Descripcion', 'data' => 'descripcion'],
            ['title' => 'Disponible', 'data' => 'disponibilidad'],
            ['title' => 'Oservacion', 'data' => 'observacion'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->ajax(route('accesoris.datatables'));
        $html->setTableAttribute('id', 'accesorios_datatables');

        return view('admin.accesorios.index', compact('html'));
    }

    public function datatables(Request $request)
    {
        $datatables = datatables(Accesorio::where('vehiculo_placa',$request->session()->get('vehiculo')))
            ->editColumn('actions', function ($accesorio) {
                return view('admin.accesorios.datatables.actions', compact('accesorio'));
            })
            ->rawColumns(['actions']);

        $request->session()->forget('vehiculo');
        return $datatables->toJson();
    }

    public function create()
    {
        return view('admin.accesorios.create');
    }

    public function store()
    {
        request()->validate([
            'descripcion' => 'required|unique:accesorios',
            'disponibilidad' => 'required',
            'observacion'
        ]);

        $accesorio = Accesorio::create(request()->all());

        return response()->json([
            'flash_now' => ['success', 'Accesorio created!'],
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }

    public function edit(Accesorio $accesorio)
    {
        return view('admin.accesorios.update', compact('accesorio'));
    }

    public function update(Accesorio $accesorio)
    {
        request()->validate([
            'name' => 'required|unique:accesorios,name,' . $accesorio->id,
        ]);

        $accesorio->update(request()->all());

        return response()->json([
            'flash_now' => ['success', 'Accesorio updated!'],
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }

    public function destroy(Accesorio $accesorio)
    {
        $accesorio->delete();

        return response()->json([
            'flash_now' => ['success', 'Accesorio deleted!'],
            'reload_page' => true,
        ]);
    }

    public function import()
    {
        Excel::import(new AccesoriosImport, request()->file('file'));

        return back()->with('success', 'All good!');
    }
}

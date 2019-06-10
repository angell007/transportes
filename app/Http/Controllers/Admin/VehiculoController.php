<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use App\Vehiculo;
use App\Proveedor;


class VehiculoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:Admin']);
    }

    public function index(Request $request)
    {
        // dd(url()->previous();
        $html = app('datatables.html')->columns([
            ['title' => 'Propietario', 'data' => 'proveedor.fullnombre'],
            ['title' => 'Placa', 'data' => 'placa'],
            ['title' => '# Lic', 'data' => 'numero_licencia'],
            ['title' => 'Marca', 'data' => 'marca'],
            // ['title' => 'Soat', 'data' => 'soat'],
            ['title' => 'Modelo', 'data' => 'modelo'],
            ['title' => 'Color', 'data' => 'color'],
            // ['title' => 'Poliza', 'data' => 'poliza'],
            ['title' => 'Km', 'data' => 'kilometraje'],

            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);


        $html->ajax(route('vehiculos.datatables'));
        $html->setTableAttribute('id', 'vehiculos_datatables');
        return view('admin.vehiculos.index', compact('html'));
    }

    public function datatables()
    {

            $datatables = datatables(Vehiculo::with('proveedor'))
                ->editColumn('actions', function ($vehiculo) {
                    return view('admin.vehiculos.datatables.actions', compact('vehiculo'));
                })
                ->rawColumns(['actions']);

            return $datatables->toJson();
    }

    public function create()
    {
        $proveedors = Proveedor::select('fullnombre','id')->get();
        return view('admin.vehiculos.create', compact('proveedors'));
    }

    public function show()
    {

        return 'hola';
    }

    public function store()
    {
        request()->validate([
            // 'name' => 'required|unique:vehiculos',
        ]);

        $vehiculo = Vehiculo::create(request()->all());

        return response()->json([
            'flash_now' => ['success', 'Vehiculo created!'],
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }

    public function edit(Vehiculo $vehiculo)
    {
        return view('admin.vehiculos.update', compact('vehiculo'));
    }

    public function update(Vehiculo $vehiculo)
    {
        request()->validate([
            'name' => 'required|unique:vehiculos,name,' . $vehiculo->id,
        ]);

        $vehiculo->update(request()->all());

        return response()->json([
            'flash_now' => ['success', 'Vehiculo updated!'],
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }

    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();

        return response()->json([
            'flash_now' => ['success', 'Vehiculo deleted!'],
            'reload_datatables' => true,
        ]);
    }
}

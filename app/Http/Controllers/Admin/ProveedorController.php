<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Proveedor;
use App\Vehiculo;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:Admin']);
    }

    public function index()
    {
        $html = app('datatables.html')->columns([
            ['title' => 'Nombre de propietario', 'data' => 'fullnombre'],
            ['title' => 'Documento', 'data' => 'documento'],
            ['title' => 'Contacto', 'data' => 'contacto'],
            ['title' => 'Email', 'data' => 'email'],

            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->ajax(route('proveedors.datatables'));
        $html->setTableAttribute('id', 'proveedors_datatables');

        return view('admin.proveedors.index', compact('html'));
    }

    public function datatables()
    {
        $datatables = datatables(Proveedor::query())
            ->editColumn('actions', function ($proveedor) {
                return view('admin.proveedors.datatables.actions', compact('proveedor'));
            })
            ->rawColumns(['actions']);

        return $datatables->toJson();
    }

    public function create()
    {
        return view('admin.proveedors.create');
    }

    public function store()
    {
        request()->validate([
            'fullnombre' => 'required',
            'documento' => 'required|unique:proveedors'
        ]);

        $proveedor = Proveedor::create(request()->all());

        return response()->json([
            'flash_now' => ['success', 'Proveedor created!'],
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }

    public function edit(Proveedor $proveedor)
    {
        return view('admin.proveedors.update', compact('proveedor'));
    }

    public function update(Proveedor $proveedor)
    {
        request()->validate([
            'name' => 'required|unique:proveedors,name,' . $proveedor->id,
        ]);

        $proveedor->update(request()->all());

        return response()->json([
            'flash_now' => ['success', 'Proveedor updated!'],
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();

        return response()->json([
            'flash_now' => ['success', 'Proveedor deleted!'],
            'reload_datatables' => true,
        ]);
    }

    public function misVehiculos(Request $request, $idproveedor)
    {
        $request->session()->put('key', $idproveedor);
        // dd($request->session()->get('key'));
        $html = app('datatables.html')->columns([
            ['title' => 'Placa', 'data' => 'placa'],
            ['title' => '# Lic', 'data' => 'numero_licencia'],
            ['title' => 'Marca', 'data' => 'marca'],
            ['title' => 'Soat', 'data' => 'soat'],
            ['title' => 'Modelo', 'data' => 'modelo'],
            ['title' => 'Color', 'data' => 'color'],
            ['title' => 'Poliza', 'data' => 'poliza'],
            ['title' => 'Km', 'data' => 'kilometraje'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);

        $html->ajax(route('misVehiculos.datatables'));
        $html->setTableAttribute('id', 'misVehiculos_datatables');
        return view('admin.vehiculos.index', compact('html'));
    }

    public function datatablesMisVehiculos(Request $request)
    {
        // $request->session()->get('key');
            $datatables = datatables(Vehiculo::where('proveedor_id',$request->session()->get('key')))
                ->editColumn('actions', function ($vehiculo) {
                    return view('admin.vehiculos.datatables.actions', compact('vehiculo'));
                })
                ->rawColumns(['actions']);

            return $datatables->toJson();
    }
}

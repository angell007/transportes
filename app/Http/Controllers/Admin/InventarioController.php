<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Inventario;
use App\User;
class InventarioController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:Admin']);
    }

    public function index()
    {
        $html = app('datatables.html')->columns([
            ['title' => 'Id', 'data' => 'id'],
            ['title' => 'Name', 'data' => 'name'],
            ['title' => 'Email', 'data' => 'email'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->ajax(route('inventarios.datatables'));
        $html->setTableAttribute('id', 'inventarios_datatables');

        return view('admin.inventarios.index', compact('html'));
    }

    public function datatables()
    {
        $datatables = datatables(User::query())
            ->editColumn('actions', function ($inventario) {
                return view('admin.inventarios.datatables.actions', compact('inventario'));
            })
            ->rawColumns(['actions']);

        return $datatables->toJson();
    }

    public function create()
    {
        return view('admin.inventarios.create');
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|unique:inventarios',
            'descripcion',
        ]);

        $inventario = Inventario::create(request()->all());

        return response()->json([
            'flash_now' => ['success', 'Inventario created!'],
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }

    public function edit(Inventario $inventario)
    {
        return view('admin.inventarios.update', compact('inventario'));
    }

    public function update(Inventario $inventario)
    {
        request()->validate([
            'name' => 'required|unique:inventarios,name,' . $inventario->id,
        ]);

        $inventario->update(request()->all());

        return response()->json([
            'flash_now' => ['success', 'Inventario updated!'],
            'dismiss_modal' => true,
            'reload_datatables' => true,
        ]);
    }

    public function destroy(Inventario $inventario)
    {
        $inventario->delete();

        return response()->json([
            'flash_now' => ['success', 'Inventario deleted!'],
            'reload_datatables' => true,
        ]);
    }
}

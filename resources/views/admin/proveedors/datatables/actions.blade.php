<div class="text-lg-right text-nowrap">
    <a class="btn btn-round btn-icon btn-success" title="vehiculos" href="{{ route('vehiculos.misVehiculos', $proveedor->id) }}">
        <i class="fal fa-fw fa-truck text-white"></i>
    </a>

    <button type="button" class="btn btn-round btn-icon btn-primary" title="Update" data-modal="{{ route('proveedors.edit', $proveedor->id) }}">

        <i class="fal fa-fw fa-pencil"></i>
    </button>

    <form method="POST" action="{{ route('proveedors.destroy', $proveedor->id) }}" class="d-inline-block" data-ajax-form>

        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-round btn-icon btn-danger" title="Delete" data-confirm>
            <i class="fal fa-fw fa-trash"></i>
        </button>
    </form>
</div>

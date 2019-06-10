<div class="text-lg-right text-nowrap">
        <a  class="btn btn-round btn-icon btn-success" title="Accesorios" href="{{route('accesorios.index', $vehiculo->placa)}}">
                <i class="fa fa-cogs fa-fw" aria-hidden="true"></i>
        </a>

    <button type="button" class="btn btn-round btn-icon btn-primary" title="Update" data-modal="">
        <i class="fal fa-fw fa-pencil"></i>
    </button>

    <form method="POST" action="" class="d-inline-block" data-ajax-form>
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-round btn-icon btn-danger" title="Delete" data-confirm>
            <i class="fal fa-fw fa-trash"></i>
        </button>
    </form>
</div>

@extends('layouts.auth')

@section('title', 'Accesorios')
@section('child-content')
    <div class="row align-items-center mb-3">
        <div class="col-lg">
            <h2 class="mb-2 mb-lg-0">@yield('title')</h2>
        </div>
        <div class="col-lg-auto">
            <button type="button" class="btn btn-round btn-primary mb-2" data-modal="{{ route('accesorios.create') }}">
                <i class="fal fa-plus"></i> Registrar Accesorio
            </button>
        </div>
        <div class="col-lg-auto">
                <form method="POST" class="md-form" action=" {{route('accesorios.import') }}" enctype="multipart/form-data">
                    @csrf
                    <label for="file-upload" class="subir">
                                <i class="fas fa-cloud-upload-alt"></i> Importar info
                            </label>
                            <input id="file-upload" onchange='cambiar()' name="file" type="file" style='display: none;'/>
                            <div id="info"></div>
                            <input class="btn btn-info btn-xs" type="submit" value="Enviar">
                </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            {!! $html->table(['class'=> 'table bg-muted']) !!}
        </div>
    </div>
@endsection
@section('scripts')
<script type="application/javascript">
        function cambiar(){
            var pdrs = document.getElementById('file-upload').files[0].name;
            document.getElementById('info').innerHTML = pdrs;
        }
</script>
@endsection

@push('scripts')
    {!! $html->scripts() !!}
@endpush

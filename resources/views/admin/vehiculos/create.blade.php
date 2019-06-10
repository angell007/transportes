@extends('layouts.modal')

@section('title', 'Registrar vehiculo')
@section('content')
    <form method="POST" action="{{ route('vehiculos.store') }}" data-ajax-form>
        @csrf

        <div class="modal-body">
            <div class="row">

                    <div class="form-group col-md-6">
                            <label class="label"  for="proveedor_id">Propietario</label>
                            <select class="custom-select" name="proveedor_id" id="proveedor_id">
                                <option disabled selected>Selecciona</option>
                                @foreach ($proveedors as $item)
                                <option value="{{$item->id}}">{{$item->fullnombre}}</option>
                                @endforeach
                                {{--  <option value="no" @if (old('proveedor_id') == "no") {{ 'selected' }} @endif>No</option>  --}}
                            </select>
                    </div>

                    <div class="form-group col-md-6">
                            <label class="label"  for="tipo">Tipo de vehiculo</label>
                            <select class="custom-select" name="tipo" id="tipo">
                                <option disabled selected>Selecciona</option>
                                <option value="publico" @if (old('tipo') == "publico") {{ 'selected' }} @endif>Publico</option>
                                <option value="particular" @if (old('tipo') == "particular") {{ 'selected' }} @endif>Particular</option>
                            </select>
                    </div>


                <div class="form-group col-md-3">
                    <label for="placa">Placa</label>
                    <input type="text" name="placa" id="lacap" class="form-control" value="{{ old('placa') }}">
                </div>

                <div class="form-group col-md-3">
                        <label for="numero_licencia"># Licencia </label>
                        <input type="text" name="numero_licencia" id="numero_licencia" class="form-control" value="{{ old('numero_licencia') }}">
                </div>

                <div class="form-group col-md-3">
                        <label for="marca">Marca</label>
                        <input type="text" name="marca" id="marca" class="form-control" value="{{ old('marca') }}">
                </div>

                <div class="form-group col-md-3">
                        <label for="soat">Soat</label>
                        <input type="text" name="soat" id="soat" class="form-control" value="{{ old('soat') }}">
                </div>

                <div class="form-group col-md-3">
                        <label for="tecnomecanica">Tecnomecanica</label>
                        <input type="text" name="tecnomecanica" id="tecnomecanica" class="form-control" value="{{ old('tecnomecanica') }}">
                </div>

                <div class="form-group col-md-3">
                        <label for="poliza">Poliza</label>
                        <input type="text" name="poliza" id="poliza" class="form-control" value="{{ old('poliza') }}">
                </div>

                <div class="form-group col-md-3">
                        <label for="modelo">Modelo</label>
                        <input type="text" name="modelo" id="modelo" class="form-control" value="{{ old('modelo') }}">
                </div>

                <div class="form-group col-md-3">
                        <label for="color">Color</label>
                        <input type="text" name="color" id="color" class="form-control" value="{{ old('color') }}">
                </div>

                <div class="form-group col-md-3">
                        <label for="kilometraje">Kilometraje</label>
                        <input type="text" name="kilometraje" id="kilometraje" class="form-control" value="{{ old('kilometraje') }}">
                </div>

            </div>
         </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-round btn-primary">Save</button>
            <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
    </form>
@endsection

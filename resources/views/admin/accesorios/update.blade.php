@extends('layouts.modal')

@section('title', 'Update Accesorio')
@section('content')
    <form method="POST" action="{{ route('accesorios.update', $accesorio->id) }}" data-ajax-form>
        @csrf
        @method('PATCH')

       <div class="modal-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ old('descripcion', $accesorio->descripcion) }}">
                </div>

                <div class="form-group col-md-6">
                    <label class="label"  for="disponibilidad">Disponible</label>
                    <select class="form-control" name="disponibilidad" id="disponibilidad">
                        <option disabled selected>{{ old('disponibilidad', $accesorio->disponibilidad) }} </option>
                        <option value="si" @if (old('disponibilidad') == "si") {{ 'selected' }} @endif>Si</option>
                        <option value="no" @if (old('disponibilidad') == "no") {{ 'selected' }} @endif>No</option>
                    </select>
                </div>

            <div class="form-group col-md-12">
                <label for="observacion">Observacion</label>
                <textarea cols="10" rows="5"  name="observacion" id="observacion" class="form-control" >{{ old('observacion', $accesorio->observacion) }}</textarea>
            </div>
        </div>
    </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-round btn-primary">Save</button>
            <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
    </form>
@endsection




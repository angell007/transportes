@extends('layouts.modal')

@section('title', 'Registrar Propietario')
@section('content')
    <form method="POST" action="{{ route('proveedors.store') }}" data-ajax-form>
        @csrf

        <div class="modal-body">
            <div class="row">
                <div class="form-group col-md-12">
                    <label class="label"  for="name">Nombre Completo </label>
                    <input type="text" name="fullnombre" id="fullnombre" class="form-control" value="{{ old('fullnombre') }}">
                </div>

                <div class="form-group col-md-3">
                        <label for="documento"># Documento </label>
                        <input type="text" name="documento" id="documento" class="form-control" value="{{ old('documento') }}">
                </div>

                <div class="form-group col-md-3">
                        <label for="contacto"># Contacto </label>
                        <input type="text" name="contacto" id="contacto" class="form-control" value="{{ old('contacto') }}">
                </div>

                <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                </div>

                {{--  <div class="form-group col-md-6">
                    <label class="label"  for="disponibilidad">Disponible</label>
                    <select class="form-control" name="disponibilidad" id="disponibilidad">
                        <option disabled selected>Selecciona</option>
                        <option value="si">Si</option>
                        <option value="no">No</option>
                    </select>
                </div>  --}}
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-round btn-primary">Save</button>
            <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
    </form>
@endsection

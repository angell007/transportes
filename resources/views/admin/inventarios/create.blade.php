@extends('layouts.modal')

@section('title', 'Create Inventario')
@section('content')
    <form method="POST" action="{{ route('inventarios.store') }}" onsubmit="document.forms['myform']['enviar'].disabled=true;" name="myform" data-ajax-form>
        @csrf

        <div class="modal-body">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <textarea cols="10" rows="5"  name="descripcion" id="descripcion" class="form-control" ></textarea>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-round btn-primary" name="enviar" id="enviar">Save</button>
            <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
    </form>
@endsection

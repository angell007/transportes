@can('Admin')
    {{--  <li class="nav-item{!! request()->is('accesorios') ? ' active' : '' !!}">
        <a href="{{ route('accesorios.index') }}" class="nav-link">Accesorios</a>
    </li>  --}}

    {{--  <li class="nav-item {!! request()->is('inventarios') ? 'active' : '' !!} ">
        <a href="{{ route('inventarios.all') }}" class="nav-link text-dark">Inventarios</a>
    </li>  --}}
    <li class="nav-item {!! request()->is('vehiculos') ? 'active' : '' !!}">
        <a href="{{ route('vehiculos.index') }}" class="nav-link text-dark">Vehiculos</a>
    </li>
    <li class="nav-item {!! request()->is('proveedors') ? 'active' : '' !!} ">
        <a href="{{ route('proveedors.index') }}" class="nav-link text-dark">Propietarios</a>
    </li>
@endcan

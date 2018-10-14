@extends('layouts.main')
@section('content')
@include('layouts.menssage_success')
@push('navbar_items_right')
{{--<li class="nav-item">--}}
    {{--<a class="btn btn-success rounded mr-5" href="{{ url('role/create') }}"><i class="fa fa-plus"></i> Nuevo Rol</a>--}}
{{--</li>--}}
@endpush
<div class="row mt-5">
    <div class="col-12" id="render_roles">
        @include('role.partials.roles')
    </div>
</div>
@endsection

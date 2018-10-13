@extends('layouts.portal')
@section('content')
    @push('sidebar')
    @include('portal.event.sidebar')
    @endpush
    @include('layouts.menssage_success')
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @include('portal.order.partials.details')
                </div>
            </div>
        </div>
    </div>
@endsection
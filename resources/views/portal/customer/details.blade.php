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
                    <h4 class="text-center">{{ $event->title }}</h4>
                    <h1 class="text-center"><i class="fa fa-ticket" aria-hidden="true"></i> Tiquetes</h1>
                    <hr>
                    @include('portal.order.partials.details')
                </div>
            </div>
        </div>
    </div>
@endsection
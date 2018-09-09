@extends('layouts.portal')
@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{ route('event.page',[$data['key_app'],$data['page_id']]) }}">volver a la pagina del evento</a>
                    <code>
                    {{ $tickets }}
                    </code>
                </div>
            </div>
        </div>
    </div>
@endsection

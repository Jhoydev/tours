@extends('layouts.template.melody')

@section('content')
    @if ($errors->any())
        <div class="row mt-2">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="row mt-3">

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-center"><i class="icon-calendar"></i> Últimos eventos</h6>
                    <div class="list-group">
                        @foreach($events as $event)
                        <a href="{{ url("events/$event->id") }}" class="list-group-item list-group-item-action">{{ $event->title }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

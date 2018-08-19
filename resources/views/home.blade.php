@extends('layouts.main')

@section('content')
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

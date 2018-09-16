@extends('layouts.portal')

@section('content')
    <div class="row mt-5 d-flex justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    @foreach($events as $event)
                        <div class="row">
                            <div class="col-12">
                                <p>{{ $event->company->name }}</p>
                                <p>{{ $event->title }} <i class="icon-calendar"></i> {{ $event->start_date }}</p>
                                @if($event->start_date > now() && $event->page)
                                    <a href="{{ url('evento/' . $event->id . '/' . $event->page->id ) }}" target="_blank">WEB</a>
                                @endif
                            </div>
                            <div class="col-10 offset-1 text-center">
                                <img src="http://www.urbanui.com/melody/template/images/samples/1280x768/12.jpg" alt="" class="img-fluid rounded">
                            </div>
                            <div class="col-10 offset-1 text-center">
                                <p class="text-muted">{{ $event->description }}</p>
                            </div>
                            <div class="col-12 my-4">
                                <hr>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
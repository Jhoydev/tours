<div class="row mt-2">
    @foreach($events as $event)
    <div class="col-lg-3 col-md-4">
        <div class="card rounded">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="badge badge-primary rounded pl-2 pr-2">{{ $event->start_date->toFormattedDateString() }}</small>
                    <h6>
                        {{ $event->title }}
                    </h6>
                </div>
                <hr>
                <p class="card-text pb-3 description-block" data-toggle="tooltip" data-placement="top" title="{{ $event->location }}">{{ $event->location }}</p>
                <hr>
                <div class="d-flex justify-content-around">
                    <a href="{{ url("events/$event->id") }}" class="btn btn-sm btn-success rounded"><i class="fa fa-tachometer"></i> </a>
                    <a href="{{ url("events/$event->id/edit") }}" class="btn btn-sm btn-primary rounded"><i class="fa fa-cog"></i> </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['url' => url('events'),'method' => 'POST', 'id' => 'form_create_event']) !!}
            <div class="modal-header">
                <h5>Crear Evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @include('events.partials.general')
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
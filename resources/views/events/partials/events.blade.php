<div class="card rounded">
    <div class="card-body">
        <p class="display-4 text-center">Eventos</p>
        <hr>
        <div class="table-responsive">
            <table id="order-listing" class="table">
                <thead class="bg-primary text-white">
                <tr>
                    <th>Evento</th>
                    <th>Lugar</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->address }}</td>
                        <td>{{ $event->start_date->toFormattedDateString() }}</td>
                        <td class="text-right">
                            <a href="{{ url("events/$event->id") }}" class="btn btn-sm btn-primary"><i class="fas fa-sign-in-alt"></i> </a>
                            @can('event.edit')
                            <a href="{{ url("events/$event->id/edit") }}" class="btn btn-sm btn-light"><i class="fa fa-cog"></i> </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['url' => url('events'),'method' => 'POST', 'id' => 'form_create_event','enctype'=>'multipart/form-data']) !!}
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
@push('scripts')
<script src="/template/js/data-table.js"></script>
    @include('layouts.js.datatable')
@endpush
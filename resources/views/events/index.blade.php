@extends('layouts.main')
@section('content')
    @include('layouts.menssage_success')
    <div class="row pt-3">
        <div class="col-12">
            <div class="row">
                <div class="col-4">
                    <button type="button" class="btn btn-success btn-sm mb-2 rounded" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i> Crear evento </button>
                </div>
                <div class="col-4"><h4 class="text-center">Listado de eventos</h4></div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($events as $event)
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <small class="badge badge-primary">{{ $event->start_date->toFormattedDateString() }}</small>
                        <h6>
                            {{ $event->title }}
                        </h6>

                    </div>
                    <div class="card-body">
                        <p>{{ $event->location }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-around">
                        <a href="{{ url("events/$event->id/edit") }}" class="btn btn-sm btn-primary rounded">Editar</a>
                        <a href="{{ url("events/$event->id") }}" class="btn btn-sm btn-success rounded">Administrar</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                {!! Form::open(['url' => url('events'),'method' => 'POST', 'id' => 'form_create_event']) !!}
                <div class="modal-body">
                    @include('events.partials.general')
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

        $('#form_search_user').submit(function (e) {
            e.preventDefault();
            searchUsers();
        });

        function searchUsers() {
            url = $('#form_search_user').attr('action');
            axios.get(url,{
                params : {
                    "full_name" : $('input[id = full_name ]').val()
                }
            }).then(response => {
                $("#render_users").html(response.data);
        }).catch(function (error) {
                console.log(error);
            });
        }

        $('#deleteModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);// Button that triggered the modal
            let recipient = button.data('event_id'); // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            let modal = $(this);
            modal.find('form').attr('action', 'events/' + recipient);
        });
    </script>
@endsection
@extends('layouts.main')
@section('content')
    @include('layouts.menssage_success')
    @push('navbar_items_right')
        <li class="nav-item">
            <button type="button" class="btn btn-success rounded mr-5" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i> Crear evento </button>
        </li>
    @endpush
    <div class="row pt-3">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12 col-lg-6"><h4>Listado de Eventos</h4></div>
            </div>
        </div>
    </div>
    <div class="row">
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
                        <p class="card-text pb-3">{{ $event->location }}</p>
                        <hr>
                        <div class="d-flex justify-content-around">
                            <a href="{{ url("events/$event->id") }}" class="btn btn-sm btn-success rounded"><i class="fa fa-cog"></i> Administrar</a>
                            <a href="{{ url("events/$event->id/edit") }}" class="btn btn-sm btn-primary rounded"><i class="fa fa-pencil"></i> Editar</a>
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
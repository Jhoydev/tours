@extends('layouts.main')
@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="row pt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <a href="{{ url('events/create') }}" class="text-success">
                        <span class="fa-stack fa-lg ">
                            <i class="fa fa-circle fa-stack-2x "></i>
                            <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <h2 class="ml-3">Listado de eventos</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>title</th>
                            <th>location</th>
                            <th>start_date</th>
                            <th>end_date</th>
                            <th>falta</th>
                            <th>event_type</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{ $event->id }}</td>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->location }}</td>
                                <td>{{ $event->start_date }}</td>
                                <td>{{ $event->end_date }}</td>
                                <td>{{ $event->end_date->diffForHumans(null,true) }}</td>
                                <td>{{ $event->event_type->name }}</td>
                                <td class="text-center">
                                    <a href="{{ url("events/$event->id") }}" class="text-success">
                                        <span class="fa-stack fa-lg ">
                                            <i class="fa fa-circle fa-stack-2x "></i>
                                            <i class="fa fa-eye fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                    <a href="{{ url("events/$event->id/edit") }}">
                                        <span class="fa-stack fa-lg ">
                                            <i class="fa fa-circle fa-stack-2x "></i>
                                            <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                    <a href="" class="text-danger"  data-toggle="modal" data-target="#deleteModal" data-event_id="{{ $event->id }}">
                                        <span class="fa-stack fa-lg ">
                                            <i class="fa fa-circle fa-stack-2x "></i>
                                            <i class="fa fa-eraser fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Aviso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Esta seguro de eliminar este usuario
                </div>
                <div class="modal-footer">
                    {!! Form::open([ 'id' => 'form_delete' ,'url' => '','method' => 'DELETE','class' => 'd-inline-block']) !!}
                    {!! Form::submit('Eliminar',['class' => 'btn btn-danger btn-sm'])  !!}
                    {!! Form::close() !!}
                    <button type="button" class="btn btn-secondary btn-sm text-light" data-dismiss="modal">Cancelar</button>
                </div>
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
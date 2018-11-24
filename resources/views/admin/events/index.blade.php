@extends('layouts.template.melody')
@section('content')
@include('layouts.menssage_success')
@can('event.create')
    <div class="row mb-3">
        <div class="col-12 text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i> Crear evento </button>
        </div>
    </div>
@endcan
<div class="row">
    <div class="col-12" id="render_events">
        @include('admin.events.partials.events')
    </div>
</div>
@endsection
@section('script')
<script>

    $('#form_search_event').submit(function (e) {
        e.preventDefault();
        searchEvents();
    });

    function searchEvents() {
        var url = $('#form_search_event').attr('action');
        axios.get(url, {
            params: {
                "title": $('input[id = title ]').val()
            }
        }).then(response => {
            $("#render_events").html(response.data);
            $('[data-toggle="tooltip"]').tooltip();
        }).catch(function (error) {
            console.log(error);
        });
    }

    $('#deleteModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let recipient = button.data('event_id');
        let modal = $(this);
        modal.find('form').attr('action', 'events/' + recipient);
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>
@endsection
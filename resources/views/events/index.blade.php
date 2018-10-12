@extends('layouts.main')
@section('content')
@include('layouts.menssage_success')
@push('navbar_items_right')
<li class="nav-item">
    <button type="button" class="btn btn-success rounded mr-5" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i> Crear evento </button>
</li>
@endpush
<div class="row mt-5">
    <div class="col-12" id="render_events">
        @include('events.partials.events')
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
        url = $('#form_search_event').attr('action');
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
        let button = $(event.relatedTarget);// Button that triggered the modal
        let recipient = button.data('event_id'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        let modal = $(this);
        modal.find('form').attr('action', 'events/' + recipient);
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>
@endsection
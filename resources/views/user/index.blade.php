@extends('layouts.template.melody')
@section('content')
@include('layouts.menssage_success')
@can('user.create')
    <div class="row mb-3">
        <div class="col-12 text-right">
            <a class="btn btn-primary" href="{{ url('user/create') }}"><i class="fa fa-plus"></i> Nuevo usuario</a>
        </div>
    </div>
@endcan
<div class="row">
    <div class="col-12" id="render_users">
        @include('user.partials.users')
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
        axios.get(url, {
            params: {
                "full_name": $('input[id = full_name ]').val()
            }
        }).then(response => {
            $("#render_users").html(response.data);
        }).catch(function (error) {
            console.log(error);
        });
    }

    $('#deleteModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);// Button that triggered the modal
        let recipient = button.data('user_id'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        let modal = $(this);
        modal.find('form').attr('action', 'user/' + recipient);
    });

</script>
@endsection
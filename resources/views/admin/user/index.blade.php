@extends('layouts.template.melody')
@section('content')
@include('layouts.menssage_success')
@can('user.create')
    <div class="row mb-3">
        <div class="col-12 text-right">
            <a class="btn btn-primary" href="{{ route('admin.user.create') }}"><i class="fa fa-plus"></i> Nuevo usuario</a>
        </div>
    </div>
@endcan
<div class="row">
    <div class="col-12" id="render_users">
        @include('admin.user.partials.users')
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
        var url = $('#form_search_user').attr('action');
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
        let button = $(event.relatedTarget);
        let recipient = button.data('user_id');
        let modal = $(this);
        modal.find('form').attr('action', 'user/' + recipient);
    });
</script>
@endsection
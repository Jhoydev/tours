@extends('layouts.main')
@section('content')
@include('layouts.menssage_success')
@push('navbar_items_right')
<li class="nav-item">
    <a class="btn btn-success rounded mr-5" href="{{ url('role/create') }}"><i class="fa fa-plus"></i> Nuevo Rol</a>
</li>
@endpush
<div class="row mt-2">
    <div class="col-12" id="render_roles">
        @include('role.partials.roles')
    </div>
</div>
@endsection
@section('script')
<script>
    $('#form_search_role').submit(function (e) {
        e.preventDefault();
        searchRoles();
    });

    function searchRoles() {
        url = $('#form_search_role').attr('action');
        axios.get(url, {
            params: {
                "name": $('input[id = name ]').val()
            }
        }).then(response => {
            $("#render_roles").html(response.data);
            $('[data-toggle="tooltip"]').tooltip();
        }).catch(function (error) {
            console.log(error);
        });
    }

    $('#deleteModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let recipient = button.data('role_id');
        let modal = $(this);
        modal.find('form').attr('action', 'role/' + recipient);
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>
@endsection

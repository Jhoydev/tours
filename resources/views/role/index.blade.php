@extends('layouts.main')
@section('content')
@include('layouts.menssage_success')
@push('navbar_items_right')
<li class="nav-item">
    <form id="form_search_role" action="{{ url('role') }}">
        <div class="col input-group">
            <input type="text" id="full_name" class="form-control" placeholder="Buscar rol" aria-label="Buscar rol" aria-describedby="addon">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" onclick="searchRoles()"><span class="fa fa-search"></span> Buscar Rol </button>
            </div>
        </div>
    </form>
</li>
<li class="nav-item">
    <a class="btn btn-success rounded mr-5" href="{{ url('role/create') }}"><i class="fa fa-plus"></i> Nuevo Rol</a>
</li>
@endpush
<div class="row mt-5">
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
                "full_name": $('input[id = full_name ]').val()
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

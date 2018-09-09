@extends('layouts.main')
@section('content')
    @include('layouts.menssage_success')
    @push('navbar_items_right')
        <li class="nav-item mr-4">
            <a class="btn btn-success rounded" href="{{ url('user/create') }}"><i class="fa fa-user"></i> Nuevo usuario</a>
        </li>
    @endpush
    <div class="row mt-5">
        <div class="col-12">
            <div class="row">
                <div class="col-md mb-3">
                    <form id="form_search_user" action="{{ url('user') }}">
                        <div class="form-row">
                           <div class="col input-group mb-3">
                                <input type="text" id="full_name" class="form-control" placeholder="Buscar usuario" aria-label="Buscar usuario" aria-describedby="addon">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" onclick="searchUsers()"><span class="fa fa-search"></span> Buscar usuario </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12" id="render_users">
            @include('user.partials.users')
        </div>
    </div>

    <!-- Modal -->


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
            let recipient = button.data('user_id'); // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            let modal = $(this);
            modal.find('form').attr('action', 'user/' + recipient);
        });

    </script>
@endsection
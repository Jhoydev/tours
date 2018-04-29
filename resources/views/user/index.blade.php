@extends('layouts.main')
@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="row mt-5">
        <div class="col-12">
            <div class="row">
                <div class="col-auto mb-3">
                    @if( Auth::user()->can('user.create') )
                        <div>
                            <a class="btn btn-success" href="{{ url('user/create') }}"><i class="fa fa-user"></i> Nuevo usuario</a>
                        </div>
                    @endif
                </div>
                <div class="col-md mb-3">
                    <form id="form_search_user" action="{{ url('user') }}">
                        <div class="form-row">
                            @if( Auth::user()->can('company.show') )
                                <div class="col-md-3 input-group mb-3">
                                    <div class="input-group-prepend ">
                                        <label class="input-group-text bg-primary" for="company_id"><span class="fa fa-building mr-1" aria-hidden="true"></span>  Compañia</label>
                                    </div>
                                    {{ Form::select('company_id', ['' => ''] + $companies, '', ['id' => 'company_id' ,'class' => "form-control"]) }}
                                </div>
                            @endif
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
                    "full_name" : $('input[id = full_name ]').val(),
                    "company_id" : $('select[name = company_id ]').val(),
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
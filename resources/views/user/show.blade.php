<div class="container-fluid">
    <div class="row justify-content-center mb-5">
        <div class="col-12">
            @if (Auth::user()->can('user.edit'))
                <a href="{{ url("user/$user->id/edit") }}" class="btn btn-primary btn-sm mb-2 pull-right"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            @endif
        </div>
        <div class="row">
            <div class="col-md-3">
                <img class="img-fluid" src="{{ url("user/avatar/$user->company_id/$user->id") }}" alt="">
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-12">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item p-1"><i class="icon-user"></i> {{ $user->full_name }}</li>
                            <li class="list-group-item p-1"><i class="fa fa-envelope-o"></i> {{ $user->email }}</li>
                            <li class="list-group-item p-1"><i class="fa fa-phone"></i> {{ $user->phone }}</li>
                            <li class="list-group-item p-1"><i class="fa fa-building-o"></i> {{ $user->company->name }}</li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <hr>
                        <strong><i class="fa fa-shield" aria-hidden="true"></i> Rol</strong>
                        <ul class="list-group list-group-flush">
                        @foreach($user->roles as $rol)
                            <li class="list-group-item p-1 text-capitalize">
                                {{ $rol->name }}
                            </li>
                        @endforeach
                        </ul>
                    </div>
                    <div class="col-12">
                        <hr>
                        <strong><i class="fa fa-shield" aria-hidden="true"></i> Permisos</strong>
                        <ul class="list-group list-group-flush">
                            @foreach($permissions as $permission)
                                <li class="list-group-item p-1">
                                    {{ $permission->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
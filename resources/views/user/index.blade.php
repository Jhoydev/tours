@extends('layouts.main')
@section('content')
    <div class="row mt-5">
        <div class="col-12 mb-3">
            @if(Auth::user()->can('user.create'))
                <div>
                    <a class="btn btn-success btn-lg" href="{{ url('user/create') }}"><i class="fa fa-plus"></i> Nuevo usuario</a>
                </div>
            @endif
        </div>
        @foreach($users as $user)
            <div class="col-lg-2 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <img class="img-fluid" src="https://cdn0.iconfinder.com/data/icons/avatars-6/500/Avatar_boy_man_people_account_boss_client_beard_male_person_user-512.png" alt="">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item p-1"><i class="icon-user"></i> {{ $user->full_name }}</li>
                            <li class="list-group-item p-1"><i class="fa fa-envelope-o"></i> {{ $user->email }}</li>
                            <li class="list-group-item p-1"><i class="fa fa-phone"></i> {{ $user->phone }}</li>
                            <li class="list-group-item p-1"><i class="fa fa-building-o"></i> {{ $user->company->name }}</li>
                        </ul>
                        <div class="mt-2 text-center">
                            @if (Auth::user()->can('user.edit'))
                                <a href="#" class="btn btn-primary btn-sm mb-2">Editar</a>
                            @endif
                            <a href="{{ url('user/'.$user->id) }}" class="btn btn-success btn-sm mb-2">Ver</a>
                            @if (Auth::user()->can('user.destroy'))
                                <a href="#" class="btn btn-danger btn-sm mb-2">Eliminar</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
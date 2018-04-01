@extends('layouts.main')
@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <img class="img-fluid" src="https://cdn0.iconfinder.com/data/icons/avatars-6/500/Avatar_boy_man_people_account_boss_client_beard_male_person_user-512.png" alt="">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item p-1"><i class="icon-user"></i> {{ $user->full_name }}</li>
                                <li class="list-group-item p-1"><i class="fa fa-envelope-o"></i> {{ $user->email }}</li>
                                <li class="list-group-item p-1"><i class="fa fa-building-o"></i> {{ $user->company->name }}</li>

                            </ul>
                        </div>
                        <div class="col-md-9">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.main')
@section('content')
    <div class="row mt-5 justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <img class="img-fluid" src="http://www.expoyoga.com.co/wp-content/uploads/2018/03/logo-2018-expoyoga.png" alt="">
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">{{ ucfirst($company->name) }}</li>
                                        <li class="list-group-item">{{ $company->phone }}</li>
                                        <li class="list-group-item">{{ $company->email }}</li>
                                        <li class="list-group-item">{{ $company->address }}</li>
                                        <li class="list-group-item">{{ $company->created_at }}</li>
                                    </ul>
                                </div>
                                <div class="col-auto d-flex justify-content-around flex-column" style="font-size: 2em">
                                    <a class="d-block" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a class="d-block" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    <a class="d-block" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center" style="font-size: 5em">{{ $count_users_company }}</div>
                            <div>
                                <a class="btn btn-primary" href="{{ url("user?company_id=$company->id") }}"><i class="fa fa-user" aria-hidden="true"></i> Usuarios</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center" style="font-size: 5em">12</div>
                            <div>
                                <a class="btn btn-primary" href="{{ url("user?company_id=$company->id") }}"><i class="fa fa-calendar" aria-hidden="true"></i> Eventos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

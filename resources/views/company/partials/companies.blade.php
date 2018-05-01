<div class="row row animated bounceInRight">
    @foreach($companies as $company)
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-text">
                        <div class="text-center mb-2">
                            <img class="img-fluid mx-auto" src="{{ url('img/avatar_default.jpg') }}" alt="">
                            <hr>
                            <div style="font-size: 2em">{{ ucfirst($company->name) }} <i class="fa fa-calendar text-info" aria-hidden="true"></i></div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ url("company/$company->id") }}" class="btn btn-success btn-sm rounded">Ver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
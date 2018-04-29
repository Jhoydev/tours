@extends('layouts.main')
@section('content')
    <div class="row mt-5 justify-content-center">
        <div class="col-12">
            <div class="row">
                <div class="col-auto mb-3">
                    @if( Auth::user()->can('company.create') )
                        <div>
                            <a class="btn btn-success" href="{{ url('company/create') }}"><i class="fa fa-building"></i> Nueva compañia</a>
                        </div>
                    @endif
                </div>
                <div class="col-md mb-3">
                    <form id="form_search_company" action="{{ url('company') }}">
                        <div class="form-row">
                            <div class="col input-group mb-3">
                                <input type="text" id="company_id" class="form-control" placeholder="Buscar compañia" aria-label="Buscar compañia" aria-describedby="addon">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" onclick="searchCompany()"><span class="fa fa-search"></span> Buscar compañia</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12" id="render_companies">
            @include('company.partials.companies')
        </div>
        <div class="col-12">
            <div class="d-flex justify-content-center mt-3">
                {{ $companies->links() }}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#form_search_company').submit(function (e) {
            e.preventDefault();
            searchCompany();
        });

        function searchCompany() {
            url = $('#form_search_company').attr('action');
            axios.get(url,{
                params : {
                    "company_name" : $('input[id = company_id ]').val()
                }
            }).then(response => {
                $("#render_companies").html(response.data);
            }).catch(function (error) {
                console.log(error);
            });
        }
    </script>
@endsection
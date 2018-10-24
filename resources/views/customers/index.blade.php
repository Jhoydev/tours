@extends('layouts.template.melody')
@section('content')
@include('layouts.menssage_success')
<div class="row mb-3">
    <div class="col-12 text-right">
        <a class="btn btn-primary" href="{{ url('customer/create') }}"><i class="fa fa-plus"></i> Nuevo Asistente</a>
    </div>
</div>
<div class="row">
    <div class="col-12" id="render_customers">
        @include('customers.partials.customers')
    </div>
</div>
@endsection
@section('script')
<script>
    $('#form_search_customer').submit(function (e) {
        e.preventDefault();
        searchCustomers();
    });

    function searchCustomers() {
        url = $('#form_search_customer').attr('action');
        axios.get(url, {
            params: {
                "full_name": $('input[id = full_name ]').val()
            }
        }).then(response => {
            $("#render_customers").html(response.data);
        }).catch(function (error) {
            console.log(error);
        });
    }

    $('#deleteModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let recipient = button.data('customer_id');
        let modal = $(this);
        modal.find('form').attr('action', 'customer/' + recipient);
    });
</script>
@endsection

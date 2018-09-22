@extends('layouts.main')
@section('content')
    @include('layouts.menssage_success')
@push('navbar_items_right')
<li class="nav-item">
    <a class="btn btn-success rounded mr-5" href="{{ url('customer/create') }}"><i class="fa fa-plus"></i> Nuevo Asistente</a>
</li>
@endpush
<div class="row mt-2">
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

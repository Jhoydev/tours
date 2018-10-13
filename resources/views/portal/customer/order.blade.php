@extends('layouts.portal')
@section('content')
    @push('sidebar')
    @include('portal.event.sidebar')
    @endpush
    <div class="row mt-5">
        @if ($order->customer_id == Auth::user()->id)
        <div class="col-12 mb-3 text-right">
            <a class="btn btn-light border rounded" href="{{ route('order.invoice',['order'=> $order->id]) }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Factura</a>
        </div>
        @endif
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2><strong>Referencia</strong> {{ $order->reference }}</h2>
                    <hr>
                    @include('portal.order.partials.details')
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @include('layouts.js.datatable')
    <script>
        $(".radio-assign").on('click',function () {
            let content = $(this).closest(".content-radios");
            let radios = content.find('.radio-assign');
            radios.each(function (k,radio) {
                radio = $(radio);
                let target = radio.data('target');
                if (radio.prop('checked')){
                    $("#"+target).removeClass('d-none');
                }else{
                    $("#"+target).addClass('d-none');
                }
            })
        });
        function confirmAssign() {
            let form = event.target;
            let email = $(form).find('input[type=email]').val();
           if (!confirm("Enviar tiquete al correo electronico " + email)){
               event.preventDefault();
           }
        }
    </script>
@endpush
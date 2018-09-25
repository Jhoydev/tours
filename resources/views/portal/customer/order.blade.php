@extends('layouts.portal')
@section('content')
    <div class="row mt-5 d-flex justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <p>{{ $order->reference }}</p>
                    @foreach($order->orderDetails as $detail)
                        <ul>
                            <li>{{ $detail->code }}</li>
                            <li>{{ $detail->ticket->title }}</li>
                            <li>$ {{ number_format($detail->price,2) }}</li>
                            @if ($detail->customer)
                                <li>{{ $detail->customer->full_name }} - {{ $detail->customer->email }}</li>
                            @else
                                <li>Sin asignar
                                    <form action="{{ url("portal/events/order/$order->id/send-ticket-email/$detail->id") }}" method="POST">
                                        @csrf
                                        <input type="text" name="email"><button>Enviar</button>
                                    </form>
                                </li>
                            @endif
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>

    </script>
@endpush
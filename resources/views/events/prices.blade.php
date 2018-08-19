@extends('layouts.main')
@section('link')
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
@endsection
@push('sidebar')
    @include('events.sidebar')
@endpush
@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="row" id="event_price" v-cloak>
        <div class="col-12">
            <div class="row mt-5">
                <div class="col-md-12">
                    <h3>{{ $event->title }}</h3>
                </div>
                @foreach ($event->prices as $price)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5>{{ $price->name }}</h5>
                                <p>{{ $price->amount }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-2 text-center" v-show="!visible">
                    <div class="card">
                        <div class="card-body">
                            <a v-on:click="showSetPrice">
                                <h2><i class="fa fa-plus" aria-hidden="true"></i></h2>
                                <p>Establecer precio</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" v-show="visible">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Detalle</label>
                                <input class="form-control" type="text" v-model="name">
                            </div>
                            <div class="form-group">
                                <label for="">Valor</label>
                                <input class="form-control" type="text" v-model="amount">
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 form-group text-center">
                                    <button class="btn btn-success btn-sm">Establecer</button>
                                </div>
                                <div class="col-md-6 form-group text-center">
                                    <button class="btn btn-light btn-sm border border-secondary" v-on:click="showSetPrice">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        var event_prices = new Vue({
            el : '#event_price',
            data : {
                name : '',
                amount : 0,
                visible : false
            },
            methods : {
                showSetPrice: function(){
                    this.name = '';
                    this.amount = 0;
                    this.visible = !this.visible;
                },
                sendForCreate: function (){
                    axios.post('events/prices',{
                        name: this.name,
                        amount: this.amount
                    }).then(response => {
                        this.name = '';
                        this.amount = 0;
                        this.visible = false;
                    }).catch(function (){
                        console.log(error);
                    })
                }
            }
        });
    </script>
@endsection
@extends('layouts.portal')
@section('content')
    <div class="row mt-5 justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['url' => $payu->url,'method' => 'POST']) !!}
                        {{--<input name="merchantId"    type="hidden"  value="{{$payu->merchantId}}"   >
                        <input name="accountId"     type="hidden"  value="{{$payu->accountId}}" >
                        <input name="description"   type="hidden"  value="{{$payu->description}}"  >
                        <input name="referenceCode" type="hidden"  value="{{$payu->referenceCode}}" >
                        <input name="amount"        type="hidden"  value="{{$payu->amount}}"   >
                        <input name="tax"           type="hidden"  value="{{$payu->tax}}"  >
                        <input name="taxReturnBase" type="hidden"  value="{{$payu->taxReturnBase}}" >
                        <input name="currency"      type="hidden"  value="{{$payu->currency}}" >
                        <input name="signature"     type="hidden"  value="{{$payu->signature}}"  >
                        <input name="test"          type="hidden"  value="{{$payu->test}}" >
                        <input name="responseUrl"    type="hidden"  value="{{$payu->responseUrl}}" >
                        <input name="confirmationUrl"    type="hidden"  value="{{$payu->confirmationUrl}}" >--}}
                        <div class="row">
                            <div class="col-12 form-group">
                                <label for="buyerEmail"><i class="fa fa-envelope" aria-hidden="true"></i> Correo Electrónico</label>
                                <input class="form-control rounded"  id="buyerEmail"  name="buyerEmail"    type="email"  value="{{Auth::user()->email}}" >
                                
                            </div>
                        </div>

                    <button class="btn btn-success rounded" type="submit"><i class="fa fa-check" aria-hidden="true"></i> Confirmar</button>
                    {!! Form::close() !!}
                </div>
            </div>
            
        </div>
    </div>
@endsection
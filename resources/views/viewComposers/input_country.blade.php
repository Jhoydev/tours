{!!Form::select('country_id', $country, $customer->country_id ? $customer->country_id : old('country_id'), ['id' => 'inp_country', 'class' => 'form-control rounded','placeholder' => 'Seleciona un país'])!!}
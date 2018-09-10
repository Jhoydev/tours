

@include('customers.form.form',[
    'method' => 'PUT',
    'url_form' => url("customer/$customer->id"),
    'title' => "Editar Asistente: " . ucfirst($customer->first_name) . " " . ucfirst($customer->last_name),
    $customer
])
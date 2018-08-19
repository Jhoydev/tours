@include('user.form.form',[
    'method' => 'POST',
    'url_form' => url('user'),
    'title' => 'Nuevo usuario',
    $user
])
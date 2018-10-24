@include('user.form.form',[
    'method' => 'POST',
    'url_form' => url('user'),
    'title' => '<strong>Nuevo usuario</strong>',
    $user
])
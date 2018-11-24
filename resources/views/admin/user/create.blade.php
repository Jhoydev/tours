@include('admin.user.form.form',[
    'method' => 'POST',
    'url_form' => route('admin.user.store'),
    'title' => '<strong>Nuevo usuario</strong>',
    $user
])
@include('user.form.form',[
    'method' => 'PUT',
    'url_form' => url("user/$user->id")
])
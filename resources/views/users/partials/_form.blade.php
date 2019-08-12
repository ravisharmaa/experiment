<?php
//$customers = App\Customer::pluck('name', 'slug');
?>
<div class="form-group">
    {{Form::label('username','Company Name')}}
    {{--{{Form::select('username', $customers, null, ['class'=>'form-control','placeholder'=>'Please select a Customer'])}}--}}
</div>
<div class="form-group">
    {{Form::label('Hosts To Monitor','User Role')}}
    {{Form::select('role',['admin'=>'Admin','guest'=>'Guest'],null,
    [
        'class'=>'form-control'
    ])}}
</div>
<div class="form-group">
    {{Form::label('username','User Name')}}
    {{Form::text('name',  null, ['class'=>'form-control', 'id' => 'name','placeholder'=>'Please Add a Username'])}}
</div>

<div class="form-group">
    {{Form::label('email','Email')}}
    {{Form::email('email',null, ['class'=>'form-control'])}}
</div>

<div class="form-group">
    {{Form::label('password','Password')}}
    {{Form::password('password', ['class'=>'form-control'])}}
</div>

<div class="form-group">
    {{Form::label('password','Password Confirmation')}}
    {{Form::password('password_confirmation', ['class'=>'form-control'])}}
</div>

<button type="submit" class="btn btn-primary">Submit</button>
<button type="reset" class="btn btn-danger">Reset</button>

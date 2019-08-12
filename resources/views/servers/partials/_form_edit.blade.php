<div class="form-group">
    {{Form::label('customer','Customer:')}}
    {{ Form::hidden('customer_id', $server->customers[0]->id, ['class'=>'form-control','readonly']) }}
    {{ Form::text('customer_name', $server->customers[0]->name, ['class'=>'form-control','readonly']) }}
</div>
<div class="form-group">
    {{Form::label('hostname','Host Name')}}
    {{Form::text('hostname',null, ['class'=>'form-control'])}}
</div>

<div class="form-group">
    {{Form::label('ipaddress','IP')}}
    {{Form::text('ipaddress',null, ['class'=>'form-control'])}}
</div>

<button type="submit" class="btn btn-primary">Submit</button>









<div class="centredFlex">
    @foreach($server->customers as $customer)
        <div class="form-group">
            {{Form::label('customer','Customer:')}}
            {{ Form::text('customer_name', $customer->name, ['class'=>'form-control','readonly']) }}

        </div>
        <div class="form-group">
            {{Form::label('hostname','Hostname:')}}
            {{ Form::text('hostname', $server->hostname, ['class'=>'form-control','readonly']) }}
        </div>
        <div class="form-group">
            {{Form::label('hostname','Hostname:')}}
            {{ Form::text('hostname', $server->ipaddress, ['class'=>'form-control','readonly']) }}
        </div>
    @endforeach
</div>

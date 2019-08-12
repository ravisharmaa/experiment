<?php
/*if (auth()->user()->email == 'admin@javra.com') {
    $customers = App\Customer::all();
} else {
    $customers = App\Customer::where('id', (auth()->user()->customer->id))->get();
}
$services = App\Service::all();
*/?>
<div class="form-group">
    {{Form::label('customer','Customer')}}
    <select class="form-control" name="customer_id">
    @foreach($customers as $customer)
    <option value="{{$customer->id}}">{{$customer->name}}</option>
    @endforeach
    </select>
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










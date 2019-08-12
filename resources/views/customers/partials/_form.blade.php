<div class="form-group">
    {{Form::label('company_name','Company Name')}}
    {{Form::text('name',null, ['class'=>'form-control'])}}
</div>

<div class="form-group">
    {{Form::label('contact_person','Contact Person')}}
    {{Form::text('contact_person',null, ['class'=>'form-control'])}}
</div>

<div class="form-group">
    {{Form::label('Email','Email')}}
    {{Form::text('email',null, ['class'=>'form-control'])}}
</div>

<div class="form-group">
    {{Form::label('phone','Phone')}}
    {{Form::text('phone',null, ['class'=>'form-control'])}}
</div>

<div class="form-group">
    {{Form::label('Address','Address')}}
    {{Form::textarea('address', null, ['class'=>'form-control','rows'=>5])}}
</div>

<div class="form-group">
    {{Form::label('remarks','Remarks')}}
    {{Form::textarea('remarks', null, ['class'=>'form-control','rows'=>5])}}
</div>


<button type="submit" class="btn btn--primary">Submit </button>
<button type="reset" class="btn btn-danger">Reset </button>

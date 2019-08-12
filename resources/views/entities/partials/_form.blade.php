<div class="form-group">
    {{Form::label('name','Entity Name')}}
    {{Form::text('name',null, ['class'=>'form-control'])}}
</div>

<div class="form-group">
    {{Form::label('url','Url')}}
    {{Form::text('url',null, ['class'=>'form-control'])}}
</div>


<button type="submit" class="btn btn-primary">Submit </button>
<button type="reset" class="btn btn-danger">Reset </button>

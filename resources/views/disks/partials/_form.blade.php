<div class="form-group">
    {{Form::label('disk_name','Disk Name')}}
    {{Form::text('disk_name',null, ['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('remarks','Remarks')}}
    {{Form::text('remarks',null, ['class'=>'form-control'])}}
</div>
{{--<div class="form-group">--}}
    {{--{{Form::label('active','Active')}}--}}
    {{--{{Form::checkbox('active','0', ['class'=>'form-control'])}}--}}
{{--</div>--}}

<button type="submit" class="btn btn-primary">Submit</button>
<button type="reset" class="btn btn-danger">Reset</button>

<div class="form-group">
    {{Form::label('cpu_warn_threshold','%Cpu Warn')}}
    {{Form::text('cpu_warn_threshold',null, ['class'=>'form-control'])}}
</div>

<div class="form-group">
    {{Form::label('cpu_critical_threshold','%Cpu Critical')}}
    {{Form::text('cpu_critical_threshold',null, ['class'=>'form-control'])}}
</div>

<div class="form-group">
    {{Form::label('memory_warn_threshold','%Memory Warn')}}
    {{Form::text('memory_warn_threshold',null, ['class'=>'form-control'])}}
</div>

<div class="form-group">
    {{Form::label('memory_critical_threshold','%Memory Critical')}}
    {{Form::text('memory_critical_threshold',null, ['class'=>'form-control'])}}
</div>

<div class="form-group">
    {{Form::label('disk_warn_threshold','%Disk Warn')}}
    {{Form::text('disk_warn_threshold', null, ['class'=>'form-control'])}}
</div>

<div class="form-group">
    {{Form::label('disk_critical_threshold','%Disk Critical')}}
    {{Form::text('disk_critical_threshold', null, ['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('disk_command','Disk Name')}}
    {{Form::text('disk_command', null, ['class'=>'form-control'])}}
</div>


<button type="submit" class="btn btn-primary">Submit </button>
<button type="reset" class="btn btn-danger">Reset </button>

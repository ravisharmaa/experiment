<div class="form-group">

    {{Form::label('path','Path')}}
    {{Form::text('path',null, ['placeholder' => 'Enter your Script Path','class'=>'form-control'])}}
</div>

<div class="form-group">
    {{Form::label('result','Result')}}
    {{Form::textarea('result', null, ['placeholder' => 'Enter your Valid Result','class'=>'form-control', 'rows' => 10, 'style' =>' resize: vertical;'])}}
</div>

<button type="submit" class="btn btn--primary">Submit</button>
<button type="reset" class="btn btn-danger">Reset</button>

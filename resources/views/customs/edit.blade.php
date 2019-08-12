@extends('main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Custom Script</h1>
        </div>
        {{--<a data-toggle="tooltip" title="Add Custom Field"--}}
           {{--class="btn btn--small btn--primary"--}}
           {{--href="{{route('customs.create',['server' => $server->hostname])}}">Add Custom Field</a>--}}
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('customs.create', ['server' => $server->hostname]) }}"> Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="card-body">
                        {{Form::model($customs, ['url'=>['customs/update', $customs->id],'role'=>'form'])}}
                        @include('customs.partials._editform')
                        {{Form::close()}}
                    </div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        <div class="col-md-4">
            @if(session()->has('errors'))
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        <p>{{$error}}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <!-- /.row -->

@endsection
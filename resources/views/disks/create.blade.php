@extends('master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Disk</h1>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('disks.index') }}"> Back</a>
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
                        {{Form::open(['route'=>'disks.store','role'=>'form'])}}
                        @include('disks.partials._form')
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
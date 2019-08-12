@extends('main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">User Management</h1>
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
                        {{--{{Form::open(['route'=>'users.update','role'=>'form'])}}--}}
                        @include('users.partials._changepassword')
                        {{--{{Form::close()}}--}}
                    </div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        @if(session()->has('errors'))
            @include('errors.errors');
        @endif
    </div>
    <!-- /.row -->

@endsection
@extends('main')

@section('content')
    <div class="content__topPanel">
        <div class="content__topPanel-left">
            <h2 class="content__topPanel-title">Customr2 Management</h2>
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
                        {{Form::open(['route'=>'customers.store','role'=>'form'])}}
                        @include('customers.partials._form')
                        {{Form::close()}}
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
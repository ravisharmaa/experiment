@extends('main')

@section('content')
    <div class="content__topPanel">
        <div class="content__topPanel-left">
            <h2 class="content__topPanel-title">Add Custom Scripts</h2>
        </div>
        @if(session('message'))
            {{session('message')}}
        @endif
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="card-body">
                        {{Form::open(['url'=>'customs/store','role'=>'form'])}}
                        @include('customs.partials._form')
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

    @if(count($server->customs)>0)
        <div class="content__body container-fluid control-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tablePanel--wrapper dashboard_graph x_panel table-responsive">
                        <div class="row x_title x_flat_title">
                            <div class="col-md-6">
                                <h3>Customs list </h3>
                            </div>
                        </div>
                        <table class="tablePanel tblCustomer table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Location</th>
                                <th>Scripts</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($count = 1)
                            @foreach($server->customs as $custom)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{$custom->path}}</td>
                                    <td>{{$custom->result}}</td>
                                    <td>
                                        <a href="{{route('customs.edit', [ $custom->id])}}"
                                           data-toggle="tooltip"
                                           title="Edit"><i class="fa fa-edit"></i></a>
                                        {{Form::open(['url'=>['customs/destroy', $custom->id,],'role'=>'form'])}}
                                        <button type="submit" data-toggle="tooltip" title="Delete"
                                                class="btn--plainText text--danger fa fa-trash"></button>
                                        {{Form::close()}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection




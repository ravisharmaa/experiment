@extends('main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Server Detail</h1>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('servers.index') }}"> Back</a>
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
                        {{Form::model($server, ['route'=>['servers.update', $server->hostname],'method'=>'PUT','role'=>'form'])}}
                        @include('servers.partials._form_edit')
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






{{--@extends('master')--}}

{{--@section('content')--}}
    {{--<div class="row">--}}
        {{--<div class="col-lg-12">--}}
            {{--<h1 class="page-header">Service Management </h1>--}}
        {{--</div>--}}
        {{--<div class="pull-right">--}}
            {{--<a class="btn btn-primary" href="{{ url('/servers/index', [$id ,$hostname]) }}"> Back</a>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">--}}
                {{--</div>--}}
                {{--<!-- /.panel-heading -->--}}
                {{--<div class="panel-body">--}}
                    {{--<div class="card-body">--}}
                        {{--{{Form::model($server, ['route'=>['servers.update', $server->id],'method'=>'PUT','role'=>'form'])}}--}}
                        {{--@include('servers.partials._form')--}}
                        {{--{{Form::close()}}--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<!-- /.table-responsive -->--}}
            {{--</div>--}}

            {{--@if(count($serverdetails)>0)--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading"></div>--}}
                {{--<!-- /.panel-heading -->--}}
                {{--<div class="panel-body">--}}
                    {{--<div class="table-responsive">--}}
                        {{--<table class="table table-striped table-bordered table-hover">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th>Service Name</th>--}}
                                {{--<th>Service Port</th>--}}
                                {{--<th>Service Command</th>--}}
                                {{--<th>Active</th>--}}
                                {{--<th>Actions</th>--}}
                                {{--<th>Delete</th>--}}
                            {{--</tr>--}}
                            {{--@foreach($serverdetails as $serveretail)--}}
                                {{--<tr>--}}
                                    {{--<td>{{$serveretail->disktype}}</td>--}}
                                    {{--<td>{{$serveretail->server_name}}</td>--}}
                                    {{--<td>{{$serveretail->server_port}}</td>--}}
                                    {{--<td>{{$serveretail->server_command}}</td>--}}
                                    {{--<td>--}}
                                        {{--@if($serveretail->active)--}}
                                            {{--<button type="button" class="btn btn-xs btn-success">Open</button>--}}
                                        {{--@else--}}
                                            {{--<button type="button" class="btn btn-xs btn-danger">Closed</button>--}}
                                        {{--@endif--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<a href="{{url('servers/edit', [$id, $server->id, $hostname])}}">Edit Entity</a>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<a href="{{route('servers.destroy',  $server->id)}}">Delete</a>--}}

                                    {{--</td>--}}
                                {{--</tr>--}}
                            {{--@endforeach--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                    {{--</div>--}}
                    {{--<!-- /.table-responsive -->--}}
                {{--</div>--}}
                {{--<!-- /.panel-body -->--}}
            {{--</div>--}}
            {{--@endif--}}
            {{--<!-- /.panel-body -->--}}
        {{--</div>--}}
        {{--<!-- /.panel -->--}}
        {{--<div class="col-md-4">--}}
            {{--@if(session()->has('errors'))--}}
                {{--@foreach($errors->all() as $error)--}}
                    {{--<div class="alert alert-danger">--}}
                        {{--<p>{{$error}}</p>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<!-- /.row -->--}}

{{--@endsection--}}
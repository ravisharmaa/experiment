@extends('master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Threshold %</h1>
            @if(session('message'))
                {{session('message')}}
            @endif
            <a href="{{route('thresholds.create',['server_id' => $id])}}" data-toggle="toggle" title="Add Company"
               class="btn btn-primary btn-sm pull-right fa fa-plus"></a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                {{--<th>SN</th>--}}
                                <th>Cpu Warn Threshold(%)</th>
                                <th>Memory Warn Threshold(%)</th>
                                <th>Disk Threshold(%)</th>
                                <th>Actions</th>
                            </tr>

                            </thead>
                            <tbody>
                            @php($count = 1)
                            @foreach($thresholds as $threshold)
                                <tr>
                                    {{--<td>{{ $count++ }}</td>--}}
                                    <td>{{$threshold->cpu_warn_threshold}}</td>
                                    <td>{{$threshold->memory_warn_threshold}}</td>
                                    <td>{{$threshold->disk_warn_threshold}}</td>
                                    {{--<td>{{$serverMonitor->address}}</td>--}}
                                    <td>
                                        <div class="col-md-3 no-padding">
                                            <a href="{{route('thresholds.edit', $threshold->id)}}"
                                               data-toggle="tooltip" title="Edit"><i
                                                        class="fa fa-edit"></i></a>
                                        </div>
                                        <div class="col-md-3 no-padding">
                                            {{Form::open(['route'=>['thresholds.destroy', $threshold->id,],'method'=>'DELETE'])}}
                                            <button type="submit" data-toggle="tooltip" title="Delete"><i
                                                        class="fa fa-trash"></i></button>
                                            {{Form::close()}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
    <!-- /.row -->

@endsection
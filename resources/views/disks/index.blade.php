@extends('master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Service Management</h1>
        </div>
    </div>
    <div class="row">
        <a href="{{route('disks.create')}}" class="btn btn-primary pull-right btn-sm">Add Disk</a>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Disk Name</th>
                                <th>Actions</th>

                            </tr>
                            @foreach($disks as $disk)
                                <tr>
                                    <td>{{$disk->disk_name}}</td>
                                    <td>
                                        @if($disk->active)
                                            <button type="button" class="btn btn-xs btn-success">Open</button>
                                        @else
                                            <button type="button" class="btn btn-xs btn-danger">Closed</button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('disks.edit', $disk->id)}}">Edit Entity</a> |
                                        <a href="{{route('disks.destroy',  $disk->id)}}">Delete</a>
                                    </td>

                                </tr>
                            @endforeach
                            </thead>
                            <tbody>
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
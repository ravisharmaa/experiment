@extends('main')
@section('content')

        <div class="content__topPanel">
            <div class="content__topPanel-left">
                <h1 class="content__topPanel-title">Services Management</h1>
            </div>
            <div class="content__topPanel-right">
            <a href="{{route('services.create')}}" class="btn btn--primary">Add Service</a>
            <button type="button" class="btn btn--primary right-sidebar-toggler">Add service</button>
            </div>
        </div>
            <!-- Right side panel to fill form -->
            <div class="right-sidebarPanel" id="right-sidebar">
                <div class="right-sidebarPanel__header">Service</div>
                <div class="right-sidebarPanel__body">
                        Please put here form for adding and creating.
                </div>
            </div>
            <div class="content__body container-fluid control-container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tablePanel--wrapper dashboard_graph x_panel table-responsive">
                            <div class="row x_title x_flat_title">
                                <div class="col-md-6">
                                    <h3>Services list</h3>
                                </div>
                            </div>
                            <table class="tablePanel table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Hostname</th>
                                        <th>Ip</th>
                                        <th>Memory</th>
                                        <th>Disk</th>
                                        <th>CPU</th>
                                        <th>#</th>
                                        <th>Actions</th>
                                        <th>Services</th>
                                        {{--<th>Generate file</th>--}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services as $service)
                                        <tr>
                                            <td>{{$service->hostname}}</td>
                                            <td>{{$service->ipaddress}}</td>
                                            <td>
                                                @if($service->memory)
                                                    <button type="button" class="btn btn-xs btn-success"></button>
                                                @else
                                                    <button type="button" class="btn btn-xs btn-danger"></button>
                                                @endif
                                            </td>
                                            <td>
                                                @if($service->disk)
                                                    <button type="button" class="btn btn-xs btn-success"></button>
                                                @else
                                                    <button type="button" class="btn btn-xs btn-danger"></button>
                                                @endif
                                            </td>
                                            <td>
                                                @if($service->cpu)
                                                    <button type="button" class="btn btn-xs btn-success"></button>
                                                @else
                                                    <button type="button" class="btn btn-xs btn-danger"></button>
                                                @endif
                                            </td>
                                            <td><a href="{{route('values.show', $service->hostname)}}">View Detail Graph</a>
                                            </td>
                                            <td>
                                                <a href="{{route('services.edit', $service->id)}}">Edit Entity</a> |
                                                <a href="{{route('services.destroy',  $service->id)}}">Delete</a>
                                            </td>
                                            <td>
                                                <a href="{{ url('/servers/index', [$service->id ,$service->hostname]) }}">Services</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

@endsection




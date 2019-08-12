@extends('main')

@section('content')
    <div class="content__topPanel">
        <div class="content__topPanel-left">
            <h1 class="content__topPanel-title">Servers Management</h1>
        </div>
        <div class="content__topPanel-right">
            <button type="button" class="btn btn--primary right-sidebar-toggler">Add server</button>
        </div>
    </div>
    <!-- Right side panel to fill form -->
    <div class="right-sidebarPanel" id="right-sidebar">
        <div class="right-sidebarPanel__header">Add New Server</div>
        <div class="right-sidebarPanel__body">
            <server-form-component></server-form-component>
            {{--{{Form::open(['route'=>'servers.store','role'=>'form'])}}--}}
            {{--@include('servers.partials._form')--}}
            {{--{{Form::close()}}--}}
        </div>
    </div>
    <div class="content__body container-fluid control-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="tablePanel--wrapper dashboard_graph x_panel table-responsive">
                    <div class="row x_title x_flat_title">
                        <div class="col-md-6">
                            <h3>Servers list</h3>
                        </div>
                    </div>
                    <div class="serverBasic-url">
                        @if(session()->has('file-url'))
                            <div class="serverBasic-url__panel">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon3">Copy Url</span>
                                        <input type="text" class="form-control"
                                               value="{{ session()->get('file-url') }}"
                                               id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <table class="tablePanel tblServer table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Hostname</th>
                            <th>Ip</th>
                            <th>Services</th>
                            <th>ServerMonitor</th>
                            <th>Generator</th>
                            <th>Custom Field</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($count = 1)
                        @foreach($servers as $server)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{$server->hostname}}</td>
                                <td>{{$server->ipaddress}}</td>
                                <td>
                                    <a data-toggle="tooltip" title="Add Service" class="btn btn--small btn--primary"
                                       href="{{ url('/services/index', [$server->id ,$server->hostname]) }}">Add
                                        service</a>

                                </td>
                                <td>
                                    <input type="hidden" name="server_id" value="{{$server->id}}">
                                    <a data-toggle="tooltip" title="Add ServerMonitor"
                                       class="btn btn--small btn--primary"
                                       href="{{route('server-attribute.create', ['server' => $server->hostname])}}">Add
                                        server monitor</a>

                                </td>
                                <td>
                                    <a data-toggle="tooltip" title="Generator" class="btn btn--small btn--primary"
                                       href="{{ url('/services/generate', [$server->id,$server->id])}}">Generate File
                                    </a>
                                </td>
                                <td>
                                    <a data-toggle="tooltip" title="Add Custom Field"
                                       class="btn btn--small btn--primary"
                                       href="{{route('customs.create',['server' => $server->hostname])}}">Add Custom Field</a>
                                </td>
                                <td>
                                    <a href="{{route('servers.edit', [$server->hostname])}}"
                                       data-toggle="tooltip"
                                       title="Edit"><i class="fa fa-edit"></i></a>
                                    {{Form::open(['route'=>['servers.destroy', $server->hostname,],'method'=>'DELETE'])}}
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



@endsection

@section('scripts')
    <script type="text/javascript">
      $(document).ready(function () {
        $('[data-toggle=confirmation]').confirmation({
          rootSelector: '[data-toggle=confirmation]',
          onConfirm: function (event, element) {
            element.closest('form').submit()
          }
        })
      })
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>

@endsection

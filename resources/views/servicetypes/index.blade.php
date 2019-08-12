@extends('main')

@section('content')
    <div class="content__topPanel">
        <div class="content__topPanel-left">
            <h1 class="content__topPanel-title">Services Management</h1>
        </div>
        <div class="content__topPanel-right">
            <button type="button" class="btn btn--primary right-sidebar-toggler">Add service</button>
        </div>
    </div>

    <div class="right-sidebarPanel" id="right-sidebar">
        <div class="right-sidebarPanel__header">Server Type</div>
        <div class="right-sidebarPanel__body">
            <servicetypes-form-component></servicetypes-form-component>
        </div>
    </div>
    <div class="content__body container-fluid control-container">
        <div class="row">

            <div class="col-lg-12">
                <div class="tablePanel--wrapper dashboard_graph x_panel table-responsive">
                    <div class="row x_title x_flat_title">
                        <div class="col-md-6">
                            <h3>Service lists</h3>
                        </div>
                    </div>
                    <table class="tablePanel table table-striped table-bordered tbl-services table-hover">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Service Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($count = 1)
                        @foreach($serviceTypes as $serviceType)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{$serviceType->server_name}}</td>

                                <td>
                                    <a href="{{route('servicetypes.edit', [$serviceType->id])}}"
                                       data-toggle="tooltip"
                                       title="Edit"><i class="btn--plainText fa fa-edit"></i></a>

                                    {{Form::open(['route'=>['servicetypes.destroy', $serviceType->id,],'method'=>'DELETE'])}}
                                    <button class="btn--plainText text--danger fa fa-trash" type="submit"
                                            data-toggle="confirmation" data-placement="left"
                                            title="Delete"></button>
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
    <!-- /.row -->

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
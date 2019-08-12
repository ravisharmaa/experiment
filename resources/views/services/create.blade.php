@extends('main')
@section('content')
    <div class="content__topPanel">
        <div class="content__topPanel-left">
            <h1 class="content__topPanel-title">Server Services Management</h1>
        </div>
    </div>
    <div class="content__body container-fluid control-container">
        @if (Session::has('message'))
            <div class="alert alert-info" id="success_generate">{{ Session::get('message') }}</div>
        @elseif (Session::has('error-message'))
            <div class="alert alert-danger">{{ Session::get('error-message') }}</div>
        @endif

        @if(session()->has('errors'))
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    <p>{{$error}}</p>
                </div>
            @endforeach
        @endif
        <div class="row">
            <div class="col-md-12">
                <div id="server_load" class="tablePanel--wrapper dashboard_graph x_panel table-responsive">
                    <div class="row x_title x_flat_title">
                        <div class="col-xs-6">
                            <button data-toggle="tooltip" title="Add Service" id="service_name" type="submit"
                                    class="btn btn--small btn--primary">
                                Add server service
                            </button>
                        </div>
                        <div class="col-xs-6" style="text-align:right">
                            {{--@if(!empty($services))--}}
                            @if(count($services))
                                <div class="form-group">
                                    <span><strong>Server Name: </strong></span>
                                    {{$servers->hostname}}
                                    <span><strong>IP:</strong></span>
                                    {{$servers->ipaddress}}
                                </div>
                        </div>
                    </div>
                    {{--<div class="serverBasic-url">--}}
                        {{--@if(session()->has('file-url'))--}}
                            {{--<div class="serverBasic-url__panel">--}}
                                {{--<div class="form-group">--}}
                                    {{--<div class="input-group">--}}
                                        {{--<span class="input-group-addon" id="basic-addon3">Copy Url</span>--}}
                                        {{--<input type="text" class="form-control"--}}
                                               {{--value="{{ session()->get('file-url') }}"--}}
                                               {{--id="basic-url" aria-describedby="basic-addon3">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                    <table class="tablePanel table table-striped table-bordered table-hover service-table">
                        <thead>
                        <tr>
                            <th>Service Type</th>
                            <th>Service Name</th>
                            <th>Service Port</th>
                            <th>Service Command</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td>{{$service->service_type}}</td>
                                <td>{{$service->service_name}}</td>
                                <td>{{$service->service_port}}</td>
                                <td>{{$service->service_command}}</td>

                                <td>
                                    {{--<a data-state_name="state_name" data-state_id="state_id">ADD STATE</a>--}}

                                    <a data-toggle="tooltip" title="Edit" data-state_name="state_name"
                                       data-state_id="state_id"
                                       onclick="showState('{{$service->id}}', '{{$service->service_type}}', '{{$service->service_name}}', '{{$service->service_port}}', '{{$service->service_command}}')">
                                        <i class="fa fa-edit"></i></a>
                                    <a href="{{url('services/destroy',  $service->id)}}"
                                       data-id="{{ $service->id }}" data-toggle="tooltip"
                                       class="service_delete btn--plainText text--danger fa fa-trash"
                                       title="Delete"></a>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                    {{--<div class="centered" style="margin:20px 0">--}}
                        {{--<a class="btn btn--primary btn--large"--}}
                           {{--href="{{ url('/services/generate', [$id, $services[0]->server_id]) }}">--}}
                            {{--Generate File--}}
                        {{--</a>--}}
                    {{--</div>--}}
                        @endif
                </div>
            </div>
        </div>
    </div>
    {{--Model for Edit Service--}}
    <div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h2 class="modal-title w-100 font-weight-bold-edit" id="title_edit">Edit Server Service</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body mx-3">

                    <!-- content goes here -->
                    <form>
                        <input type="hidden" name="id_edit" id="id_edit" class="form-control validate">
                        <div class="md-form mb-5 form-group">
                            <label data-error="wrong" data-success="right" for="form2">Service Type</label>
                            <input type="text" name="service_type_edit" class="form-control" id="service_type_edit">
                        </div>
                        <div class="md-form mb-5 form-group">
                            <label data-error="wrong" data-success="right" for="form2">Service Name</label>
                            <input type="text" name="service_name_edit" class="form-control" id="service_name_edit">
                        </div>
                        <div class="md-form mb-5 form-group">
                            <label data-error="wrong" data-success="right" for="form2">Service Port</label>
                            <input type="text" name="service_port_edit" class="form-control" id="service_port_edit">
                        </div>
                        <div class="md-form mb-5 form-group">
                            {{--<label data-error="wrong" data-success="right" for="form2">Service Command</label>--}}
                            <input type="hidden" name="service_command_edit" class="form-control"
                                   id="service_command_edit">
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button class="btn btn--primary btn-submit-edit">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{--Model for Adding Service--}}
    <div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h3 class="modal-title w-100 font-weight-bold" id="title">Add Server Service</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <input type="hidden" name="id" id="id" class="form-control validate">
                    @if(isset($id))
                        <input type="hidden" name="server_id" id="service_id" value="{{$id}}"
                               class="form-control validate">
                    @endif
                    {{--<input type="hidden" name="service_type" id="service_type" class="form-control validate">--}}
                    {{--<input type="hidden" name="service_name" id="service_name" class="form-control validate">--}}

                    <div class="md-form mb-5 form-group">
                        <label for="service_type">Service Type</label>
                        <select class="form-control" name="service_type" id="service_type">
                            @foreach($servicetype as $servicetype)
                                <option value="{{$servicetype->server_name}}"
                                        id="{{$servicetype->server_name}}">{{$servicetype->server_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md-form mb-5 form-group">
                        <label data-error="wrong" data-success="right" for="form2">Service Name</label>
                        <input type="text" name="service_name" id="service_name" class="form-control validate">

                    </div>
                    <div class="md-form mb-5 form-group">
                        <label data-error="wrong" data-success="right" for="form3">Service Port</label>
                        <input type="text" name="service_port" id="service_port" class="form-control validate">

                    </div>

                    <div class="md-form mb-4 form-group">
                        {{--<label data-error="wrong" data-success="right" for="form2">Service Command</label>--}}

                        <input type="hidden" name="service_command" id="service_command"
                               class="form-control validate"
                               value="/dev/tcp/127.0.0.1/">


                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn--primary btn-submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection
@section('scripts')

    <script type="text/javascript">

      $(document).ready(function () {
        $('#success_generate').delay(5000).slideUp(300)
      })

      $(document).ready(function () {
        // $('#addItemModal').modal('hide');

        $('#service_name').click(function () {

          $('#addItemModal').modal('show')
        })
      })

      $.ajaxSetup({
        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      //Ajax Request for Server add
      $('.btn-submit').click(function (e) {

        e.preventDefault()
        var server_id = $('input[name=server_id]').val()
        var service_type = $('#service_type').val()
        var service_name = $('input[name=service_name]').val()
        var service_port = $('input[name=service_port]').val()
        var service_command = $('input[name=service_command]').val()

        $.ajax({
          type: 'GET',
          url: '/ajaxRequest/server_id',
          data: {
            server_id: server_id,
            service_type: service_type,
            service_name: service_name,
            service_port: service_port,
            service_command: service_command
          },

          success: function (data) {
            alert(data.success)

            $('#addItemModal').modal('hide')

            $('#server_load').load(location.href + ' #server_load>*', '')

            // $("#addItemModal").load(location.href + " #addItemModal>*", "");

            window.location.reload()

          },
          error: function (data) {
            alert(data.error)
            $('#addItemModal').modal('hide')
            $('#addItemModal').load(location.href + ' #addItemModal>*', '')
          }
        })

      })

      $(document).ready(function () {
        $('#squarespaceModal').modal('hide')

        $('a[data-state_id]').click(function () {
          var $this = $(this)

          showState($this.data('id'), $this.data('service_type'), $this.data('service_name'),
            $this.data('service_port'), $this.data('service_command'))

        })
      })

      function showState (id, service_type, service_name, service_port, service_command) {
        var id = id
        var service_type1 = service_type
        var service_name = service_name
        var service_port = service_port
        var service_command = service_command

        $('#squarespaceModal').modal('show')

        $('#id_edit').attr('value', id)
        $('#title_edit').attr('value', service_type)
        $('#service_type_edit').attr('value', service_type1)
        $('#service_name_edit').attr('value', service_name)
        $('#service_port_edit').attr('value', service_port)
        $('#service_command_edit').attr('value', service_command)
      }

    </script>

    <script type="text/javascript">

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })

      $('.btn-submit-edit').click(function (e) {

        e.preventDefault()

        var id = $('input[name=id_edit]').val()
        var service_type = $('input[name=service_type_edit]').val()
        var service_name = $('input[name=service_name_edit]').val()
        var service_port = $('input[name=service_port_edit]').val()
        var service_command = $('input[name=service_command_edit]').val()

        $.ajax({
          type: 'GET',
          url: '/ajaxRequestUpdate/id',
          data: {
            id: id,
            service_type: service_type,
            service_name: service_name,
            service_port: service_port,
            service_command: service_command
          },
          success: function (data) {
            alert(data.success)
            $('#squarespaceModal').modal('hide')
            $('#squarespaceModal').load(location.href + ' #squarespaceModal>*', '')

            window.location.reload()

          },
          error: function (data) {
            alert(data.error)
            $('#squarespaceModal').modal('hide')
          }
        })

      })

      //    delete Service using ajax request

      $('.service_delete').click(function (e) {
        e.preventDefault()
        var id = $(this).data('id')

        if (confirm('Do you want to Delete?')) {

          $.ajax({
            type: 'GET',
            url: '/ajaxServiceDelete/' + id,
            data: {
              id: id,
            },
            success: function (data) {
              alert(data.success)
              window.location.reload()
            },
            error: function (data) {
              alert(data.error)
              window.location.reload()
            }
          })
        } else {
          return false
        }
      })


    </script>

    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
@endsection

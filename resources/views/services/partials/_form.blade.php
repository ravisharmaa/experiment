<input type="hidden" name="type_id" value="{{$id}}">

{{Form::close()}}

{{Form::open(['url'=>'services.store', '1'])}}
<div class="panel-body">
    <div class="card-body">
        {{Form::model($servicetype)}}
        @include('services.partials._formAjax')
        {{Form::close()}}

    </div>
</div>
{{--End of ajax form for Service name--}}

@section('scripts')
    <script type="text/javascript">
        //jquery for monitor_cpu
        $(document).ready(function () {
            $('#MonitorModal').modal('hide');
            //For monitor cpu
            $("#monitor_cpu").click(function (e) {
                var id = $("input[name=type_id]").val();

                $('#MonitorModal').modal('show');
                $("#title_monitor").replaceWith(
                    '<h4 class="modal-title w-100 font-weight-bold" id="title_monitor">Monitor Cpu</h4>'
                );
                $('#service_type').attr('value', sel);

            });
            //    for monitor memory
            $("#monitor_memory").click(function (e) {
                var id = $("input[name=type_id]").val();

                $('#MonitorModal').modal('show');

                $("#title_monitor").replaceWith(
                    '<h4 class="modal-title w-100 font-weight-bold" id="title_monitor">Monitor Memory</h4>'
                );
                $('#service_type').attr('value', sel);

            });

            //    for monitor disk
            $("#monitor_disk").click(function (e) {
                var id = $("input[name=type_id]").val();

                $('#MonitorModal').modal('show');

                $("#title_monitor").replaceWith(
                    '<h4 class="modal-title w-100 font-weight-bold" id="title_monitor">Monitor Disk</h4>'
                );
                $('#service_type').attr('value', sel);

            })

        });

    </script>


    {{--aja to edit or save value--}}
    <script type="text/javascript">

        // $.ajaxSetup({
        //     headers: {
        //
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        //Ajax Request for Server add
        // $(".btn-submit").click(function (e) {
        //
        //     e.preventDefault();
        //     var server_id = $("input[name=server_id]").val();
        //     var service_type = $("#service_type").val();
        //     var service_name = $("input[name=service_name]").val();
        //     var service_port = $("input[name=service_port]").val();
        //     var service_command = $("input[name=service_command]").val();
        //
        //     $.ajax({
        //         type: 'GET',
        //         url: '/ajaxRequest/server_id',
        //         data: {
        //             server_id: server_id,
        //             service_type: service_type,
        //             service_name: service_name,
        //             service_port: service_port,
        //             service_command: service_command
        //         },
        //
        //         success: function (data) {
        //             alert(data.success);
        //
        //             $('#addItemModal').modal('hide');
        //
        //             // $('#addItemModal').reset();
        //
        //             $("#server_load").load(location.href + " #server_load>*", "");
        //
        //             // $("#addItemModal").load(location.href + " #addItemModal>*", "");
        //
        //             // window.location.reload();
        //
        //         },
        //         error: function (data) {
        //             alert(data.error);
        //             $('#addItemModal').modal('hide');
        //             $("#addItemModal").load(location.href + " #addItemModal>*", "");
        //         }
        //     });
        //
        // });


        //    Monitor cpu ajax
        $(".btn-submit-monitor").click(function (e) {

            e.preventDefault();
            var server_id = $("input[name=id_monitor]").val();
            var monitor_name = $("input[name=monitor_name]").val();
            // var monitor_port = $("input[name=monitor_port]").val();
            var monitor_command = $("input[name=monitor_command]").val();
            var threshold_warn = $("input[name=threshold_warn]").val();
            var threshold_critical = $("input[name=threshold_critical]").val();

            $.ajax({
                type: 'GET',
                url: '/ajaxRequestMonitor/server_id',
                data: {
                    server_id: server_id,
                    monitor_name: monitor_name,
                    monitor_command: monitor_command,
                    threshold_warn: threshold_warn,
                    threshold_critical: threshold_critical
                },

                success: function (data) {
                    alert(data.success);
                    $('#MonitorModal').modal('hide');

                    $("#server_load").load(location.href + " #server_load>*", "");

                    $("#MonitorModal").load(location.href + " #MonitorModal>*", "");

                },
                error: function (data) {
                    alert(data.error);
                    $('#MonitorModal').modal('hide');
                }
            });
        });

    </script>

    {{--<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>--}}
    {{--<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>--}}
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"--}}
            {{--integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"--}}
            {{--crossorigin="anonymous"></script>--}}


@endsection
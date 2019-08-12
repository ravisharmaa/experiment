<div class="form-group">
    {{Form::label('customer','Customer:')}}
    {{ Form::text('hostname', $customer->name, ['class'=>'form-control','readonly']) }}
</div>
<div class="form-group">
    {{Form::label('hostname','Hostname:')}}
    {{ Form::text('hostname', $server->hostname, ['class'=>'form-control','readonly']) }}
</div>
<div class="form-group">
    {{Form::label('cpu','Cpu')}}
    <input type="checkbox" id="cpu" name="cpu"/>
</div>

<div class="form-group">
    {{Form::label('memory','Memory')}}
    <input type="checkbox" id="memory" name="memory"/>
</div>

<div class="form-group">
    {{Form::label('disk','Disk')}}
    <input type="checkbox" id="disk" name="disk">
</div>

<div class="modal fade" id="cpu_monitor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h3 class="modal-title w-100 font-weight-bold" id="title">Add Cpu Threshold</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <input type="hidden" name="server_id" id="server_id" value="{{$id}}" class="form-control validate">
                <div class="md-form mb-5">
                    <label data-error="wrong" data-success="right" for="form2">Warn Threshold</label>
                    <input type="text" name="warning_threshold" id="warning_threshold" class="form-control validate">

                </div>
                <div class="md-form mb-5">
                    <label data-error="wrong" data-success="right" for="form3">Critical Threshold</label>
                    <input type="text" name="critical_threshold" id="critical_threshold" class="form-control validate">
                </div>

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-primary btn-submit-cpu-monitor">Submit</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="memory_monitor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h3 class="modal-title w-100 font-weight-bold" id="title">Add Memory Threshold</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">

                <div class="md-form mb-5">
                    <label data-error="wrong" data-success="right" for="form2">Warn Threshold</label>
                    <input type="text" name="memory_warning_threshold" id="memory_warning_threshold"
                           class="form-control validate">

                </div>
                <div class="md-form mb-5">
                    <label data-error="wrong" data-success="right" for="form3">Critical Threshold</label>
                    <input type="text" name="memory_critical_threshold" id="memory_critical_threshold"
                           class="form-control validate">
                </div>

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-primary btn-submit-memory-monitor">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="disk_monitor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h3 class="modal-title w-100 font-weight-bold" id="title">Add Disk Threshold</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <label data-error="wrong" data-success="right" for="form2">Warn Threshold</label>
                    <input type="text" name="disk_warning_threshold" id="disk_warning_threshold"
                           class="form-control validate">

                </div>
                <div class="md-form mb-5">
                    <label data-error="wrong" data-success="right" for="form3">Critical Threshold</label>
                    <input type="text" name="disk_critical_threshold" id="disk_critical_threshold"
                           class="form-control validate">
                </div>

                <div class="md-form mb-5">
                    <label data-error="wrong" data-success="right" for="form3">Email</label>
                    <input type="text" name="emails" id="emails"
                           class="form-control validate">
                </div>

                <div class="md-form mb-5">
                    <label data-error="wrong" data-success="right" for="form3">Disk Name</label>
                    <input type="text" name="disk_value" id="disk_value"
                           class="form-control validate">
                </div>
                <a href="#" id="addScnt">ADD</a>

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-primary btn-submit-disk-monitor">Submit</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    {{--<script type="text/javascript">--}}
        {{--$(document).ready(function () {--}}
            {{--$('#cpu_monitor').modal('hide');--}}
            {{--$("#cpu").click(function () {--}}
                {{--if (this.checked) {--}}
                    {{--$('#cpu_monitor').modal('show');--}}
                {{--}--}}

                {{--$('#cpu_monitor').on('hidden.bs.modal', function () {--}}
                    {{--// do something here--}}
                    {{--$("#cpu").prop("checked", false);--}}
                {{--});--}}

            {{--})--}}

            {{--$("#memory").click(function () {--}}
                {{--if (this.checked) {--}}
                    {{--$('#memory_monitor').modal('show');--}}
                {{--}--}}

                {{--$('#memory_monitor').on('hidden.bs.modal', function () {--}}
                    {{--// do something here--}}
                    {{--$("#memory").prop("checked", false);--}}
                {{--});--}}
            {{--})--}}


            {{--$("#disk").click(function () {--}}
                {{--if (this.checked) {--}}
                    {{--$('#disk_monitor').modal('show');--}}
                {{--}--}}
                {{--$('#disk_monitor').on('hidden.bs.modal', function () {--}}
                    {{--// do something here--}}
                    {{--$("#disk").prop("checked", false);--}}
                {{--});--}}

            {{--})--}}
        {{--});--}}

        {{--//    Add New cpu Monitor--}}
        {{--$(".btn-submit-cpu-monitor").click(function (e) {--}}

            {{--e.preventDefault();--}}
            {{--var server_id = $("input[name=server_id]").val();--}}
            {{--var warning_threshold = $("input[name=warning_threshold]").val();--}}
            {{--var critical_threshold = $("input[name=critical_threshold]").val();--}}

            {{--debugger;--}}
            {{--$.ajax({--}}
                {{--type: 'GET',--}}
                {{--url: '/ajaxRequest_CpuMonitor/server_id',--}}
                {{--data: {--}}
                    {{--server_id: server_id,--}}
                    {{--cpu_warning_threshold: warning_threshold,--}}
                    {{--cpu_critical_threshold: critical_threshold--}}
                {{--},--}}

                {{--success: function (data) {--}}
                    {{--alert(data.success);--}}
                    {{--$('#cpu_monitor').modal('hide');--}}
                    {{--$("#cpu").prop("checked", false);--}}

                {{--},--}}
                {{--error: function (data) {--}}
                    {{--alert(data.error);--}}
                    {{--$('#cpu_monitor').modal('hide');--}}
                    {{--$("#cpu").prop("checked", false);--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}

        {{--$(".btn-submit-memory-monitor").click(function (e) {--}}
            {{--e.preventDefault();--}}
            {{--var server_id = $("input[name=server_id]").val();--}}
            {{--var warning_threshold = $("input[name=memory_warning_threshold]").val();--}}
            {{--var critical_threshold = $("input[name=memory_critical_threshold]").val();--}}


            {{--$.ajax({--}}
                {{--type: 'GET',--}}
                {{--url: '/ajaxRequest_CpuMonitor/server_id',--}}
                {{--data: {--}}
                    {{--server_id: server_id,--}}
                    {{--cpu_warning_threshold: warning_threshold,--}}
                    {{--cpu_critical_threshold: critical_threshold--}}
                {{--},--}}

                {{--success: function (data) {--}}
                    {{--alert(data.success);--}}
                    {{--$('#memory_monitor').modal('hide');--}}
                    {{--$("#memory").prop("checked", false);--}}

                {{--},--}}
                {{--error: function (data) {--}}
                    {{--alert(data.error);--}}
                    {{--$('#memory_monitor').modal('hide');--}}
                    {{--$("#memory").prop("checked", false);--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}

        {{--$(".btn-submit-disk-monitor").click(function (e) {--}}

            {{--debugger;--}}
            {{--e.preventDefault();--}}
            {{--var server_id = $("input[name=server_id]").val();--}}
            {{--var warning_threshold = $("input[name=disk_warning_threshold]").val();--}}
            {{--var critical_threshold = $("input[name=disk_critical_threshold]").val();--}}
            {{--var disk_value = $("input[name=disk_value]").val();--}}
            {{--var emails = $("input[name=emails]").val();--}}


            {{--$.ajax({--}}
                {{--type: 'GET',--}}
                {{--url: '/ajaxRequest_CpuMonitor/server_id',--}}
                {{--data: {--}}
                    {{--server_id: server_id,--}}
                    {{--cpu_warning_threshold: warning_threshold,--}}
                    {{--cpu_critical_threshold: critical_threshold,--}}
                    {{--disk_name: disk_value,--}}
                    {{--email: emails--}}
                {{--},--}}

                {{--success: function (data) {--}}
                    {{--alert(data.success);--}}
                    {{--$('#disk_monitor').modal('hide');--}}
                    {{--$("#disk").prop("checked", false);--}}

                {{--},--}}
                {{--error: function (data) {--}}
                    {{--alert(data.error);--}}
                    {{--$('#disk_monitor').modal('hide');--}}
                    {{--$("#disk").prop("checked", false);--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}

    {{--<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>--}}
    {{--<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>--}}
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"--}}
            {{--integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"--}}
            {{--crossorigin="anonymous"></script>--}}
@endsection
{{--Add Monitor--}}
<div class="modal fade" id="MonitorModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h2 class="modal-title w-100 font-weight-bold-edit" id="title_monitor"></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <input type="hidden" name="id_monitor" id="id_monitor" value="{{$id}}" class="form-control validate">
                <div class="md-form mb-5">
                    <label data-error="wrong" data-success="right" for="form2">Disk Name</label>
                    <input type="text" name="monitor_name" class="form-control" id="monitor_name">
                </div>
                <div class="md-form mb-5">
                    <label data-error="wrong" data-success="right" for="form2">Disk Command</label>
                    <input type="text" name="monitor_command" class="form-control" id="monitor_command">
                </div>
                <div class="md-form mb-5">
                    <label data-error="wrong" data-success="right" for="form2">Threshold Warn %</label>
                    <input type="text" name="threshold_warn" class="form-control" id="threshold_warn">
                </div>
                <div class="md-form mb-5">
                    <label data-error="wrong" data-success="right" for="form2">Threshold Critical %</label>
                    <input type="text" name="threshold_critical" class="form-control" id="threshold_critical">
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-primary btn-submit-monitor">Submit</button>
                </div>
            </div>

        </div>
    </div>
</div>
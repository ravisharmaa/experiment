<div class="modal fade" id="cpu_monitor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h3 class="modal-title w-100 font-weight-bold" id="title">Add {{$attribute_monitor->name}} Monitors</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <input type="hidden" name="server_id" id="server_id" value="{{$server->id}}"
                       class="form-control validate">
                <input type="hidden" name="cpu_name" id="{{$attribute_monitor->name}}_name" value="{{$attribute_monitor->name}}" class="form-control validate">
                <div class="md-form mb-5">
                    <label data-error="wrong" data-success="right" for="form2">Warn Threshold</label>
                    <input type="text" name="warning_threshold" id="warning_threshold"
                           class="form-control validate">

                </div>
                <div class="md-form mb-5">
                    <label data-error="wrong" data-success="right" for="form3">Critical Threshold</label>
                    <input type="text" name="critical_threshold" id="critical_threshold"
                           class="form-control validate">
                </div>

                <div class="md-form mb-5">
                    <label data-error="wrong" data-success="right" for="form3">Email</label>
                    <input type="text" name="cpu_emails" id="cpu_emails" value="{{auth()->user()->email}}"
                           class="form-control validate">
                </div>

                <div class="checkbox">
                    <label><input type="checkbox" name="visibility" id="visibility"/>Show in Dashboard</label>
                </div>

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-primary btn-submit-cpu-monitor">Submit</button>
            </div>
        </div>
    </div>
</div>
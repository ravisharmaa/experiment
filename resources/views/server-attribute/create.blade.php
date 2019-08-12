@extends('main')

@section('content')
    <div class="content__topPanel">
        <div class="content__topPanel-left">
            <h1 class="content__topPanel-title">Server Monitor</h1>
        </div>
    </div>
    <div class="content__body container-fluid control-container">
        <div class="row">
            <div class="col-xs-12">
                <div class="dashboard_graph x_panel">
                    @include('server-attribute.partials._customer')

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="tablePanel--wrapper dashboard_graph x_panel table-responsive">
                                <div class="row x_title x_flat_title">
                                    <div class="col-md-6">
                                        <div class="inlineElement">
                                            <h3>Cpu</h3>
                                            <div class="form-group" style="margin:0 0 0 10px;">
                                                <input class="styled-checkbox" type="checkbox" id="cpu" name="cpu"/>
                                                <label for="cpu"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach($server->getAttributeByName('Cpu') as $attribute)
                                    @include("server-attribute.partials.".strtolower($attribute->name))
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="tablePanel--wrapper dashboard_graph x_panel table-responsive">
                                <div class="row x_title x_flat_title">
                                    <div class="col-md-6">
                                        <div class="inlineElement">
                                            <h3>Memory</h3>
                                            <div class="form-group" style="margin:0 0 0 10px;">
                                                <input class="styled-checkbox" type="checkbox" id="memory"
                                                       name="memory"/>
                                                <label for="memory"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach($server->getAttributeByName('Memory') as $attribute)
                                    @include("server-attribute.partials.".strtolower($attribute->name))
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">

                        <div class="tablePanel--wrapper dashboard_graph x_panel table-responsive">
                            <div class="row x_title x_flat_title">
                                <div class="col-md-6">
                                    <h3>Disk</h3>
                                </div>
                            </div>
                            <div class="basicTblInfo">
                                <button type="button" class="btn btn-primary" id="disk" style="margin:20px 0">Add Disk
                                </button>
                            </div>
                            <table class="tablePanel tblServerMonitor table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Disk Name</th>
                                    <th>Warning Threshold</th>
                                    <th>Critical Threshodl</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    @foreach($server->getAttributeByName('Disk') as $attribute)
                                        @include("server-attribute.partials.".strtolower($attribute->name))
                                    @endforeach
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                {{--modal for cpu monitor--}}
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
                                <input type="hidden" name="server_id" id="server_id" value="{{$server->id}}"
                                       class="form-control validate">
                                <input type="hidden" name="cpu_name" id="cpu_name" value="CPU"
                                       class="form-control validate">
                                <div class="md-form mb-5">
                                    <label data-error="wrong" data-success="right" for="form2">Warn Threshold</label>
                                    <input type="text" name="warning_threshold" id="warning_threshold"
                                           class="form-control validate">

                                </div>
                                <div class="md-form mb-5">
                                    <label data-error="wrong" data-success="right" for="form3">Critical
                                        Threshold</label>
                                    <input type="text" name="critical_threshold" id="critical_threshold"
                                           class="form-control validate">
                                </div>

                                <div class="md-form mb-5">
                                    <label data-error="wrong" data-success="right" for="form3">Email</label>
                                    <input type="text" name="cpu_emails" id="cpu_emails"
                                           value="{{auth()->user()->email}}"
                                           class="form-control validate">
                                </div>

                                <div class="checkbox">
                                    <label><input type="checkbox" name="visibility" id="visibility"/>Show in
                                        Dashboard</label>
                                </div>

                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button class="btn btn-primary btn-submit-cpu-monitor">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{--modal for memmort_monitor--}}
                <div class="modal fade" id="memory_monitor" tabindex="-1" role="dialog"
                     aria-labelledby="myLargeModalLabel"
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
                                <input type="hidden" name="memory_name" id="memory_name" value="Memory"
                                       class="form-control validate">

                                <div class="md-form mb-5">
                                    <label data-error="wrong" data-success="right" for="form2">Warn Threshold</label>
                                    <input type="text" name="memory_warning_threshold" id="memory_warning_threshold"
                                           class="form-control validate">

                                </div>
                                <div class="md-form mb-5">
                                    <label data-error="wrong" data-success="right" for="form3">Critical
                                        Threshold</label>
                                    <input type="text" name="memory_critical_threshold" id="memory_critical_threshold"
                                           class="form-control validate">
                                </div>
                                <div class="md-form mb-5">
                                    <label data-error="wrong" data-success="right" for="form3">Email</label>
                                    <input type="text" name="memory_emails" id="memory_emails"
                                           value="{{auth()->user()->email}}"
                                           class="form-control validate">
                                </div>
                                <div class="checkbox">
                                    {{--<label data-error="wrong" data-success="left" for="form3">Show in Dashboard</label>--}}
                                    <label><input type="checkbox" name="visibility" id="visibility" checked="checked"/>Show
                                        in
                                        Dashboard</label>
                                </div>

                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button class="btn btn-primary btn-submit-memory-monitor">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{--modal for disk Monitor--}}

                <div class="modal fade" id="disk_monitor" tabindex="-1" role="dialog"
                     aria-labelledby="myLargeModalLabel"
                     aria-hidden="true">
                    <form action="#">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h3 class="modal-title w-100 font-weight-bold" id="title">Add Disk Threshold</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body mx-3">
                                    <input type="hidden" name="disk_name" id="disk_name" value="Disk"
                                           class="form-control validate">
                                    <div class="md-form mb-5">
                                        <label data-error="wrong" data-success="right" for="form2">Warn
                                            Threshold</label>
                                        <input type="text" name="disk_warning_threshold" id="disk_warning_threshold"
                                               class="form-control validate">

                                    </div>
                                    <div class="md-form mb-5">
                                        <label data-error="wrong" data-success="right" for="form3">Critical
                                            Threshold</label>
                                        <input type="text" name="disk_critical_threshold" id="disk_critical_threshold"
                                               class="form-control validate">
                                    </div>

                                    <div class="md-form mb-5">
                                        <label data-error="wrong" data-success="right" for="form3">Email</label>
                                        <input type="text" name="disk_emails" id="disk_emails"
                                               value="{{auth()->user()->email}}"
                                               class="form-control validate">
                                    </div>

                                    <div id="error" class="alert alert-danger disk_name_msg" role="alert">Please Enter
                                        Disk
                                        Name
                                    </div>

                                    <div class="md-form mb-5">
                                        <label data-error="wrong" data-success="right" for="form3">Disk Name</label>
                                        <input type="text" name="disk_value" id="disk_value"
                                               class="form-control validate"
                                               required="required"/>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="visibility" id="visibility"
                                                      checked="checked"/>Show
                                            in
                                            Dashboard</label>
                                    </div>

                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                    <button class="btn btn-primary btn-submit-disk-monitor">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{--Edit Modal for Cpu Monitor--}}
                <div class="modal fade" id="cpu_edit_monitor" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h2 class="modal-title w-100 font-weight-bold-edit" id="title_edit">Edit CPU
                                    Monitor</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body mx-3">

                                <!-- content goes here -->
                                <form>
                                    <input type="hidden" name="id_edit_monitor" id="id_edit_monitor"
                                           class="form-control validate">
                                    <div class="md-form mb-5">
                                        <label data-error="wrong" data-success="right" for="form2">Warn
                                            Threshold</label>
                                        <input type="text" name="cpu_warning_threshold_edit" class="form-control"
                                               id="cpu_warning_threshold_edit">
                                    </div>
                                    <div class="md-form mb-5">
                                        <label data-error="wrong" data-success="right" for="form2">Critical
                                            Threshold</label>
                                        <input type="text" name="cpu_critical_threshold_edit" class="form-control"
                                               id="cpu_critical_threshold_edit">
                                    </div>
                                    <div class="md-form mb-5">
                                        <label data-error="wrong" data-success="right" for="form2">Email</label>
                                        <input type="text" name="cpu_email_edit" class="form-control"
                                               id="cpu_email_edit">
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button class="btn btn-primary btn-submit-edit-cpu-monitor">Submit</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                {{--Edit Modal for Memory Monitor--}}
                <div class="modal fade" id="memory_edit_monitor" tabindex="-1" role="dialog"
                     aria-labelledby="modalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h2 class="modal-title w-100 font-weight-bold-edit" id="title_edit">Edit Memory
                                    Monitor</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body mx-3">

                                <!-- content goes here -->
                                <form>
                                    <input type="hidden" name="id_edit_monitor" id="id_edit_monitor"
                                           class="form-control validate">
                                    <div class="md-form mb-5">
                                        <label data-error="wrong" data-success="right" for="form2">Warn
                                            Threshold</label>
                                        <input type="text" name="memory_warning_threshold_edit" class="form-control"
                                               id="memory_warning_threshold_edit">
                                    </div>
                                    <div class="md-form mb-5">
                                        <label data-error="wrong" data-success="right" for="form2">Critical
                                            Threshold</label>
                                        <input type="text" name="memory_critical_threshold_edit" class="form-control"
                                               id="memory_critical_threshold_edit">
                                    </div>
                                    <div class="md-form mb-5">
                                        <label data-error="wrong" data-success="right" for="form2">Email</label>
                                        <input type="text" name="memory_email_edit" class="form-control"
                                               id="memory_email_edit">
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button class="btn btn-primary btn-submit-edit-memory-monitor">Submit</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                {{--Edit Modal for Disk Monitor--}}
                <div class="modal fade" id="disk_edit_monitor" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h2 class="modal-title w-100 font-weight-bold-edit" id="title_edit">Edit Disk
                                    Monitor</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body mx-3">

                                <!-- content goes here -->
                                <form>
                                    <input type="hidden" name="id_edit_monitor" id="id_edit_monitor"
                                           class="form-control validate">
                                    <div class="md-form mb-5">
                                        <label data-error="wrong" data-success="right" for="form2">Warn
                                            Threshold</label>
                                        <input type="text" name="disk_warning_threshold_edit" class="form-control"
                                               id="disk_warning_threshold_edit">
                                    </div>
                                    <div class="md-form mb-5">
                                        <label data-error="wrong" data-success="right" for="form2">Critical
                                            Threshold</label>
                                        <input type="text" name="disk_critical_threshold_edit" class="form-control"
                                               id="disk_critical_threshold_edit">
                                    </div>
                                    <div class="md-form mb-5">
                                        <label data-error="wrong" data-success="right" for="form2">Disk Name</label>
                                        <input type="text" name="disk_name_edit" class="form-control"
                                               id="disk_name_edit">
                                    </div>
                                    <div class="md-form mb-5">
                                        <label data-error="wrong" data-success="right" for="form2">Email</label>
                                        <input type="text" name="email_edit" class="form-control" id="email_edit">
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button class="btn btn-primary btn-submit-edit-monitor">Submit</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- /.panel -->
                @if(session()->has('errors'))
                    @include('errors.errors');
                @endif
            </div>

            @endsection

            @section('scripts')

                <script type="text/javascript">
                  $(document).ready(function () {

                    $('a[data-state_id_cpu]').click(function () {
                      var $this = $(this)
                      cpu_showState($this.data('id'), $this.data('warning_threshold'), $this.data('critical_threshold'), $this.data('email'))
                    })

                    $('a[data-state_id_memory]').click(function () {
                      var $this = $(this)
                      memory_showState($this.data('id'), $this.data('warning_threshold'), $this.data('critical_threshold'), $this.data('email'))
                    })

                    $('a[data-state_id]').click(function () {
                      var $this = $(this)
                      disk_showState($this.data('id'), $this.data('warning_threshold'), $this.data('critical_threshold'), $this.data('disk_name'), $this.data('email'))
                    })
                  })

                  //show State for cpu
                  function cpu_showState (id, warning_threshold, critical_threshold, email) {
                    var id = id
                    var warning_threshold = warning_threshold
                    var critical_threshold = critical_threshold
                    var email = email

                    $('#cpu_edit_monitor').modal('show')

                    $('#id_edit_monitor').attr('value', id)
                    $('#cpu_warning_threshold_edit').attr('value', warning_threshold)
                    $('#cpu_critical_threshold_edit').attr('value', critical_threshold)
                    $('#cpu_email_edit').attr('value', email)
                  }

                  $('.btn-submit-edit-cpu-monitor').click(function (e) {
                    e.preventDefault()

                    var id = $('input[name=id_edit_monitor]').val()
                    var warning_threshold = $('input[name=cpu_warning_threshold_edit]').val()
                    var critical_threshold = $('input[name=cpu_critical_threshold_edit]').val()
                    var email = $('input[name=cpu_email_edit]').val()

                    $.ajax({
                      type: 'GET',
                      url: '/ajaxRequestUpdateDiskMonitor/id',
                      data: {
                        id: id,
                        warning_threshold: warning_threshold,
                        critical_threshold: critical_threshold,
                        email: email
                      },
                      success: function (data) {
                        alert(data.success)
                        $('#cpu_edit_monitor').modal('hide')
                        // $("#squarespaceModal").load(location.href + " #squarespaceModal>*", "");
                        window.location.reload()
                      },
                      error: function (data) {
                        alert(data.error)
                        $('#disk_edit_monitor').modal('hide')
                      }
                    })

                  })

                  //show State for memory
                  function memory_showState (id, warning_threshold, critical_threshold, email) {
                    var id = id
                    var warning_threshold = warning_threshold
                    var critical_threshold = critical_threshold
                    var email = email

                    $('#memory_edit_monitor').modal('show')

                    $('#id_edit_monitor').attr('value', id)
                    $('#memory_warning_threshold_edit').attr('value', warning_threshold)
                    $('#memory_critical_threshold_edit').attr('value', critical_threshold)
                    $('#memory_email_edit').attr('value', email)
                  }

                  $('.btn-submit-edit-memory-monitor').click(function (e) {

                    e.preventDefault()

                    var id = $('input[name=id_edit_monitor]').val()
                    var warning_threshold = $('input[name=memory_warning_threshold_edit]').val()
                    var critical_threshold = $('input[name=memory_critical_threshold_edit]').val()
                    var email = $('input[name=memory_email_edit]').val()

                    $.ajax({
                      type: 'GET',
                      url: '/ajaxRequestUpdateDiskMonitor/id',
                      data: {
                        id: id,
                        warning_threshold: warning_threshold,
                        critical_threshold: critical_threshold,
                        email: email
                      },
                      success: function (data) {
                        alert(data.success)
                        $('#memory_edit_monitor').modal('hide')
                        // $("#squarespaceModal").load(location.href + " #squarespaceModal>*", "");
                        window.location.reload()

                      },
                      error: function (data) {
                        alert(data.error)
                        $('#memory_edit_monitor').modal('hide')
                      }
                    })

                  })

                  //showState for disk
                  function disk_showState (id, warning_threshold, critical_threshold, disk_name, email) {
                    var id = id
                    var warning_threshold = warning_threshold
                    var critical_threshold = critical_threshold
                    var disk_name = disk_name
                    var email = email

                    $('#disk_edit_monitor').modal('show')

                    $('#id_edit_monitor').attr('value', id)
                    $('#disk_warning_threshold_edit').attr('value', warning_threshold)
                    $('#disk_critical_threshold_edit').attr('value', critical_threshold)
                    $('#disk_name_edit').attr('value', disk_name)
                    $('#email_edit').attr('value', email)

                  }

                  //Edit disk monitor
                  $('.btn-submit-edit-monitor').click(function (e) {

                    e.preventDefault()

                    var id = $('input[name=id_edit_monitor]').val()
                    var warning_threshold = $('input[name=disk_warning_threshold_edit]').val()
                    var critical_threshold = $('input[name=disk_critical_threshold_edit]').val()
                    var disk_name = $('input[name=disk_name_edit]').val()
                    var email = $('input[name=email_edit]').val()

                    $.ajax({
                      type: 'GET',
                      url: '/ajaxRequestUpdateDiskMonitor/id',
                      data: {
                        id: id,
                        warning_threshold: warning_threshold,
                        critical_threshold: critical_threshold,
                        disk_name: disk_name,
                        email: email
                      },
                      success: function (data) {
                        alert(data.success)
                        $('#disk_edit_monitor').modal('hide')
                        // $("#squarespaceModal").load(location.href + " #squarespaceModal>*", "");
                        window.location.reload()
                      },
                      error: function (data) {
                        alert(data.error)
                        $('#disk_edit_monitor').modal('hide')
                      }
                    })

                  })

                  //End of Eddsit disk Monitor

                  $(document).ready(function () {
                    $('#cpu_monitor').modal('hide')
                    $('#cpu').click(function () {

                      if (this.checked) {
                        $('#cpu_monitor').modal('show')
                      }

                      $('#cpu_monitor').on('hidden.bs.modal', function () {
                        // do something here
                        $('#cpu').prop('checked', false)
                      })

                    })

                    $('#memory').click(function () {
                      if (this.checked) {
                        $('#memory_monitor').modal('show')
                      }

                      $('#memory_monitor').on('hidden.bs.modal', function () {
                        // do something here
                        $('#memory').prop('checked', false)
                      })
                    })

                    $('#disk').click(function () {
                      $('#disk_monitor').modal('show')
                      $('.disk_name_msg').hide()

                    })
                  })

                  //    Add New cpu Monitor
                  $('.btn-submit-cpu-monitor').click(function (e) {

                    e.preventDefault()
                    var name = $('input[name=cpu_name]').val()
                    var server_id = $('input[name=server_id]').val()
                    var warning_threshold = $('input[name=warning_threshold]').val()
                    var critical_threshold = $('input[name=critical_threshold]').val()
                    var emails = $('input[name=cpu_emails]').val()
                    // var visibility = $('input[name=visibility]').val()

                    var visibility = $('input[name=visibility]').is(':checked') ? 1 : 0

                    $.ajax({
                      type: 'GET',
                      url: '/ajaxRequest_CpuMonitor/server_id',
                      data: {
                        server_id: server_id,
                        name: name,
                        cpu_warning_threshold: warning_threshold,
                        cpu_critical_threshold: critical_threshold,
                        emails: emails,
                        visibility: visibility,
                      },

                      success: function (data) {
                        alert(data.success)
                        $('#cpu_monitor').modal('hide')
                        $('#cpu').prop('checked', false)

                        window.location.reload()

                      },
                      error: function (data) {
                        alert(data.error)
                        $('#cpu_monitor').modal('hide')
                        $('#cpu').prop('checked', false)

                        // window.location.reload()
                      }
                    })
                  })

                  $('.btn-submit-memory-monitor').click(function (e) {
                    e.preventDefault()
                    var server_id = $('input[name=server_id]').val()
                    var name = $('input[name=memory_name]').val()
                    var warning_threshold = $('input[name=memory_warning_threshold]').val()
                    var critical_threshold = $('input[name=memory_critical_threshold]').val()
                    var emails = $('input[name=memory_emails]').val()
                    var visibility = $('input[name=visibility]').is(':checked') ? 1 : 0

                    $.ajax({
                      type: 'GET',
                      url: '/ajaxRequest_CpuMonitor/server_id',
                      data: {
                        server_id: server_id,
                        name: name,
                        memory_warning_threshold: warning_threshold,
                        memory_critical_threshold: critical_threshold,
                        emails: emails,
                        visibility: visibility,
                      },

                      success: function (data) {
                        alert(data.success)
                        $('#memory_monitor').modal('hide')
                        $('#memory').prop('checked', false)

                        window.location.reload()

                      },
                      error: function (data) {
                        alert(data.error)
                        $('#memory_monitor').modal('hide')
                        $('#memory').prop('checked', false)

                        window.location.reload()
                      }
                    })
                  })

                  $('.btn-submit-disk-monitor').click(function (e) {

                    if ($('#disk_value').val() == '') {
                      $('.disk_name_msg').show()
                      return false
                    } else {

                      e.preventDefault()
                      var server_id = $('input[name=server_id]').val()
                      var name = $('input[name=disk_name]').val()
                      var warning_threshold = $('input[name=disk_warning_threshold]').val()
                      var critical_threshold = $('input[name=disk_critical_threshold]').val()
                      var disk_value = $('input[name=disk_value]').val()
                      var emails = $('input[name=disk_emails]').val()
                      var visibility = $('input[name=visibility]').is(':checked') ? 1 : 0

                      $.ajax({
                        type: 'GET',
                        url: '/ajaxRequest_CpuMonitor/server_id',
                        data: {
                          server_id: server_id,
                          name: name,
                          disk_warning_threshold: warning_threshold,
                          disk_critical_threshold: critical_threshold,
                          disk_name: disk_value,
                          emails: emails,
                          visibility: visibility,
                        },

                        success: function (data) {
                          alert(data.success)
                          $('#disk_monitor').modal('hide')
                          $('#disk').prop('checked', false)

                          window.location.reload()

                        },
                        error: function (data) {
                          alert(data.error)
                          $('#disk_monitor').modal('hide')
                          $('#disk').prop('checked', false)

                          window.location.reload()
                        }
                      })
                    }
                  })

                  //    delete cpu Service attribute using ajax request
                  $('.service_cpu_delete').click(function (e) {
                    if (confirm('Do you want to Delete?')) {

                      e.preventDefault()
                      var id = $(this).data('id')
                      debugger

                      $.ajax({
                        type: 'GET',
                        url: '/ajaxServiceAttributeCpuDelete/' + id,
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

                  //    delete memory Service attribute using ajax request
                  $('.service_memory_delete').click(function (e) {
                    if (confirm('Do you want to Delete?')) {

                      e.preventDefault()
                      var id = $(this).data('id')

                      $.ajax({
                        type: 'GET',
                        url: '/ajaxServiceAttributeCpuDelete/' + id,
                        data: {
                          id: id,
                        },
                        success: function (data) {
                          // alert(data.success);
                          window.location.reload()
                        },
                        error: function (data) {
                          // alert(data.error);
                          window.location.reload()
                        }
                      })

                    } else {
                      return false
                    }
                  })

                  //    delete disk Service attribute using ajax request
                  $('.service_disk_delete').click(function (e) {
                    if (confirm('Do you want to Delete?')) {

                      e.preventDefault()
                      var id = $(this).data('id')

                      $.ajax({
                        type: 'GET',
                        url: '/ajaxServiceAttributeCpuDelete/' + id,
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
@extends('main')

@section('content')
    <div class="content__topPanel">
        <div class="content__topPanel-left">
            <h1 class="content__topPanel-title">Custom Script List</h1>
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
                    <div class="centredFlex">
                        <div class="form-group">
                            {{Form::label('hostname','Hostname:')}}
                            {{ Form::text('hostname', $server->hostname, ['class'=>'form-control','readonly']) }}
                        </div>
                        <div class="form-group">
                            {{Form::label('hostname','Hostname:')}}
                            {{ Form::text('hostname', $server->ipaddress, ['class'=>'form-control','readonly']) }}
                        </div>
                    </div>

                    @if(count($server->customs) >0)
                        <div class="centredFlex">
                            <div class="form-group">
                                {{Form::label('path','File Location')}}
                                @foreach($server->customs as $customs_path)
                                    {{ Form::text('path', $customs_path->path, ['class'=>'form-control','readonly']) }}
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="centredFlex">
                            <div class="form-group">
                                File not found
                            </div>
                        </div>
                    @endif

                    @if(count($server->customs) >0)

                        <table class="tablePanel tblServer table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Result</th>
                                <th>Created Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($count = 1)

                            @foreach($customs as  $custom_fields)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>
                                        @if(isset($custom_fields->custom_field))
                                            <textarea disabled name="message" rows="4" cols="120"
                                                      style="resize: vertical;">
                                            @foreach((json_decode($custom_fields->custom_field)) as $field_Value)
                                                    {{($field_Value->field_value)}}
                                                @endforeach
                                                </textarea>
                                        @else
                                            <input disabled name="message" value="No Record Found!">
                                        @endif
                                    </td>
                                    <td>{{($custom_fields->created_at)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>



@endsection







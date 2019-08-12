@extends('main')

@section('content')
    <div class="content__topPanel">
        <div class="content__topPanel-left">
            <h2 class="content__topPanel-title">Dashboard</h2>
        </div>
    </div>
    <div class="content__body container-fluid control-container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <!-- Accordion html structure -->
                @php($count = 1)

                @foreach($servers as $server)
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <!-- Each accordion item -->
                        <div class="dashboard_graph x_panel panel panel-default">
                            <div class="panel-heading row x_title x_flat_title" role="tab">
                                <h3 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapse_{{$server->hostname}}" aria-expanded="true"
                                       aria-controls="collapseOne">
                                        {{$count++}} . {{ucfirst($server->hostname)}}
                                    </a>
                                    -
                                    <small>{{$server->customer->name}}</small>
                                    -
                                    <small>{{$server->ipaddress}}</small>
                                </h3>
                            </div>
                            <div id="collapse_{{$server->hostname}}"
                                 class="grid--equal-height x_content panel-collapse collapse in"
                                 role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class="row flexPanel flexPanel--equalHeiight">
                                        @foreach($server->attributes as $attributes)
                                            @if($attributes->name == 'CPU' )
                                                <cpu-component
                                                        :loadaverage="'{{ $server->latestValue['loadaverage'] }}'"
                                                        :attribute="'{{$attributes->pivot}}'">
                                                </cpu-component>
                                            @elseif ($attributes->name == 'Memory' )
                                                <memory-component
                                                        :free-memory="'{{ $server->latestValue['memtotal']}}'"
                                                        :used-memory="'{{$server->latestValue['memfree']}}'"
                                                        :attribute="'{{$attributes->pivot}}'"
                                                >
                                                </memory-component>
                                            @endif
                                        @endforeach
                                        <div class="col-md-3">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2 data-v-19640bc4="">Storage</h2>
                                                </div>
                                                <div class="x_content expandedDom">
                                                    <div class="graph_grid">
                                                        <div class="graph_grid__body">
                                                            @foreach($server->attributes as $attribute)
                                                                {{--@elseif ($attribute->name == 'Disk' )--}}
                                                                @if(collect($server->latestValue['diskused'])->count() > 0)
                                                                    @php($diskTotal = $attribute->pivot->disk_name . '_disktotal')
                                                                    @php($diskUsed = $attribute->pivot->disk_name . '_diskused')

                                                                    @if(property_exists($server->latestValue['diskused'], $diskUsed))
                                                                        <div class="graph_grid__top">
                                                                            <div class="graph_grid__top__left diskHolder">
                                                                                <div class="diskPanel">
                                                                                    <div class="diskInfo">
                                                                                        <div>
                                                                                            <strong>Disk</strong>: {{ $attribute->pivot->disk_location }}
                                                                                        </div>
                                                                                        <div>
                                                                                            <strong>Total
                                                                                                Disk</strong>: {{ $server->latestValue['disktotal']->$diskTotal }}
                                                                                            Gb
                                                                                        </div>
                                                                                    </div>

                                                                                    @if(($server->latestValue['disktotal']->$diskTotal != "") && ($server->latestValue['diskused']->$diskUsed != ""))
                                                                                        @php($cal = (($server->latestValue['diskused']->$diskUsed) / ($server->latestValue['disktotal']->$diskTotal)) * 100)
                                                                                    @else
                                                                                        @php($cal = '0')
                                                                                    @endif

                                                                                    @if((($server->latestValue['disktotal']->$diskTotal != "")))
                                                                                        @php($cal = (($server->latestValue['diskused']->$diskUsed)/($server->latestValue['disktotal']->$diskTotal)) *100)

                                                                                        <div class="progress">
                                                                                            <div class="progress-bar"
                                                                                                 role="progressbar"
                                                                                                 aria-valuenow="{{$cal}}"
                                                                                                 aria-valuemin="0"
                                                                                                 aria-valuemax="100"
                                                                                                 style="width: {{$cal}}%;"
                                                                                            >
                                                                                                {{ $server->latestValue['diskused']->$diskUsed }}
                                                                                                Gb
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        @php($cal = (($server->latestValue['diskused']->$diskUsed)/($server->latestValue['disktotal']->$diskTotal)) *100)
                                                                                        <div class="progress">
                                                                                            <div class="progress-bar"
                                                                                                 role="progressbar"
                                                                                                 aria-valuenow="{{$cal}}"
                                                                                                 aria-valuemin="0"
                                                                                                 aria-valuemax="100"
                                                                                                 style="width: {{$cal}}%;"
                                                                                            >{{ $server->latestValue['diskused']->$diskUsed }}
                                                                                                Gb
                                                                                            </div>
                                                                                            <small>
                                                                                                There
                                                                                                is
                                                                                                somthing
                                                                                                problem
                                                                                                in
                                                                                                disk
                                                                                            </small>
                                                                                        </div>

                                                                                    @endif
                                                                                    <div class="progressBar__info">
                                                                                        <div class="progressBar__info__left">
                                                                                            <span class="symbolAlerts symbolAlerts--warning"></span>
                                                                                            <span>
Warning Threshold : {{$attribute->pivot->warning_threshold}}
%
</span>
                                                                                        </div>
                                                                                        <div class="progressBar__info__right">
                                                                                            <span class="symbolAlerts symbolAlerts--danger"></span>
                                                                                            <span>
Critical Threshold : {{$attribute->pivot->critical_threshold}}
%
</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                            @if(collect($server->latestValue['diskused'])->count() > 2)
                                                                <a href="javascript:void(0)"
                                                                   id="disk-{{$server->id}}"
                                                                   class="expanderDom">View
                                                                    more</a>

                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--@endif--}}
                                        </div>
                                        {{--@endif--}}
                                        {{--@endforeach--}}
                                        @if($server->latestValue['additional_attributes'])
                                            <div class="col-md-3">
                                                <div class="x_panel">
                                                    <div class="x_content expandedDom">
                                                        <div class="x_title">
                                                            <h2>Services</h2>
                                                        </div>

                                                        <div class="graph_grid">
                                                            <div class="graph_grid__body">
                                                                @foreach($server->latestValue['additional_attributes'] as $additional_attributes)
                                                                    <div class="graph_grid__top">
                                                                        <div class="graph_grid__top__left">
                                                                            {{$additional_attributes->name}}
                                                                        </div>
                                                                        <div class="graph_grid__top__right">
<span
        class="label label-default label--{{($additional_attributes->status)?'active':'danger'}}">
{{($additional_attributes->status)?'Running':'Stopped'}}
</span>
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                                @if($server->latestValue['custom_field'] && $server->latestValue['custom_field']!='[]')
                                                                    <div class="x_title">
                                                                        <h2>Custom Scripts</h2>
                                                                    </div>

                                                                    @foreach(json_decode($server->latestValue['custom_field']) as $key=> $custom_fields)
                                                                        <div class="graph_grid__top">
                                                                            <div class="customResult"> {{($custom_fields->field_value)}}</div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                                @if(collect(($server->latestValue['additional_attributes']))->count() > 5 || collect(json_decode($server->latestValue['custom_field']))->count() >0)
                                                                    <a href="javascript:void(0)"
                                                                       id="service-{{$server->id}}"
                                                                       class="expanderDom">View
                                                                        more</a>
                                                                @endif
                                                                <div>
                                                                    <a href="{{route('customs.show',['server' => $server->hostname])}}">View
                                                                        Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="dashboard_graph--foot">
                                <a class="btn btn--primary"
                                   href="{{url("values/show/{$server->hostname}?period=last_hour")}}">View
                                    on
                                    charts</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

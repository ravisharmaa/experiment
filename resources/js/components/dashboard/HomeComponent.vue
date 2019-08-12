<template>
    <div>
        <div class="content__topPanel">
            <div class="content__topPanel-left">
                <h2 class="content__topPanel-title">Dashboard</h2>
            </div>
        </div>
        <div class="content__body container-fluid control-container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <!-- Accordion html structure -->
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" v-for="server in servers">
                        <!-- Each accordion item -->
                        <div class="dashboard_graph x_panel panel panel-default">
                            <div class="panel-heading row x_title x_flat_title" role="tab">
                                <h3 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion"
                                       :href="'#collapse_'+server.hostname" aria-expanded="true"
                                       aria-controls="collapseOne">
                                       {{server.hostname}}
                                    </a>
                                     -
                                    <small>{{server.customers[0].name}}</small>
                                </h3>
                            </div>
                            <div :id="'collapse_'+ server.hostname"
                                 class="grid--equal-height x_content panel-collapse collapse"
                                 role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                   <!-- <div class="row flexPanel flexPanel&#45;&#45;equalHeiight">
                                        @foreach($server->getAttributeByName('Cpu') as $attribute)
                                        <cpu-component :loadaverage="'{{ $server->latestValue['loadaverage'] }}'"
                                                       :attribute="'{{$attribute->pivot}}'"></cpu-component>
                                        @endforeach

                                        <div class="col-md-3">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2 data-v-19640bc4="">Storage</h2>
                                                </div>
                                                <div class="x_content">
                                                    <div class="graph_grid">
                                                        <div class="graph_grid__body">
                                                            @if(collect($server->latestValue['diskused'])->count() > 0)
                                                            @foreach($server->getAttributeByName('Disk') as $attribute)
                                                            @php($diskTotal = $attribute->pivot->disk_name . '_disktotal')
                                                            @php($diskUsed = $attribute->pivot->disk_name . '_diskused')

                                                            @if(property_exists($server->latestValue['diskused'], $diskUsed))
                                                            <div class="diskPanel">
                                                                <div class="diskInfo">
                                                                    <div>
                                                                        <strong>Disk</strong>: {{ $attribute->pivot->disk_location }}
                                                                    </div>
                                                                    <div><strong>Total
                                                                        Disk</strong>: {{ $server->latestValue['disktotal']->$diskTotal }}
                                                                        Gb
                                                                    </div>
                                                                </div>
                                                                @php($cal = (($server->latestValue['diskused']->$diskUsed)/($server->latestValue['disktotal']->$diskTotal)) *100)

                                                                <div class="progress">
                                                                    <div class="progress-bar"
                                                                         role="progressbar"
                                                                         aria-valuenow="{{$cal}}"
                                                                         aria-valuemin="0"
                                                                         aria-valuemax="100"
                                                                         style="width: {{$cal}}%;">
                                                                        {{ $server->latestValue['diskused']->$diskUsed }}
                                                                        Gb
                                                                    </div>
                                                                </div>

                                                                <div class="progressBar__info">
                                                                    <div class="progressBar__info__left">
                                                                        <span class="symbolAlerts symbolAlerts&#45;&#45;warning"></span>
                                                                        <span>
Warning Threshold : {{$attribute->pivot->warning_threshold}}%
</span>
                                                                    </div>
                                                                    <div class="progressBar__info__right">
                                                                        <span class="symbolAlerts symbolAlerts&#45;&#45;danger"></span>
                                                                        <span>
Critical Threshold : {{$attribute->pivot->critical_threshold}}%
</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @endif
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        @foreach($server->getAttributeByName('Memory') as $attribute)
                                        <memory-component
                                                :free-memory="'{{ $server->latestValue['memtotal']}}'"
                                                :used-memory="'{{$server->latestValue['memfree']}}'"
                                                :attribute="'{{$attribute->pivot}}'"
                                        &gt;
                                        </memory-component>
                                        @endforeach

                                        <div class="col-md-3">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2>Services</h2>
                                                </div>
                                                @if($server->latestValue)
                                                @foreach($server->latestValue['additional_attributes'] as $additional_attributes)
                                                <div class="x_content">
                                                    <div class="graph_grid">
                                                        <div class="graph_grid__top">
                                                            <div class="graph_grid__top__left">
                                                                {{$additional_attributes->name}}
                                                            </div>
                                                            <div class="graph_grid__top__right">
<span
        class="label label-default label&#45;&#45;{{($additional_attributes->status)?'active':'danger'}}">
{{($additional_attributes->status)?'Running':'Stopped'}}
</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @endif
                                                <a class="btn btn&#45;&#45;primary btn-lg btn-block"
                                                   href="{{route('values.show', $server->hostname)}}"
                                                   style="margin-top:30px;">View on charts</a>
                                            </div>

                                        </div>

                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--@endforeach-->
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "HomeComponent",
        props:['servers'],
        data () {
            return {

            }
        },
        mounted() {
            console.log(this.servers)
        }
    }
</script>

<style scoped>

</style>
@extends('main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <test-component :cpu-load="{{$cpuTimeStamps}}"></test-component>
        </div>
        <div class="col-md-12">
            <memory-test :total-memory="{{$totalMemory}}" :free-memory="{{$freeMemory}}" :used-memory="{{$usedMemory}}"></memory-test>
        </div>
        <div class="col-md-12">
            <trend-chart :additional_attributes="{{$service}}"></trend-chart>
        </div>
    </div>


@endsection

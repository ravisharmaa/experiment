@extends('main')

@section('content')
    <root-component
        :entity = '{{ $data }}'
        :additional_info='{{ $service }}'
        >
    </root-component>
@endsection

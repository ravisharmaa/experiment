<table class="tablePanel tblServerMonitor table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>Warning threshold</th>
        <th>Critical threshold</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{$attribute->pivot->warning_threshold}}</td>
        <td>{{$attribute->pivot->critical_threshold}}</td>
        <td>
            <a data-toggle="tooltip" title="Edit" data-state_name="state_name"
               data-state_id_memory="state_id"
               onclick="{{strtolower($attribute->name)}}_showState('{{$attribute->pivot->id}}',
                       '{{$attribute->pivot->warning_threshold}}',
                       '{{$attribute->pivot->critical_threshold}}',
                       '{{$attribute->pivot->email}}')">
                <i class="fa fa-edit"></i></a>
            <a href="{{url('server-attribute/destroy', $attribute->pivot->id)}}"
               data-id="{{ $attribute->pivot->id }}"
               data-toggle="tooltip" class="service_cpu_delete btn--plainText text--danger fa fa-trash"
               title="Delete"></a>
        </td>
    </tr>
    </tbody>

</table>
{{--</div>--}}

<tr>
    <td>{{$attribute->pivot->disk_location}}</td>
    <td>{{$attribute->pivot->warning_threshold}}</td>
    <td>{{$attribute->pivot->critical_threshold}}</td>

    <td>
        <a data-toggle="tooltip" title="Edit" data-state_name="state_name"
           data-state_id_disk="state_id"
           onclick="{{strtolower($attribute->name)}}_showState('{{$attribute->pivot->id}}',
                   '{{$attribute->pivot->warning_threshold}}',
                   '{{$attribute->pivot->critical_threshold}}',
                   '{{$attribute->pivot->disk_location}}',
                   '{{$attribute->pivot->email}}')">
            <i class="fa fa-edit"></i></a>
        <a href="{{url('server-attribute/destroy', $attribute->pivot->id)}}"
           data-id="{{ $attribute->pivot->id }}"
           data-toggle="tooltip" class="service_cpu_delete btn--plainText text--danger fa fa-trash" title="Delete"></a>
    </td>
</tr>
                

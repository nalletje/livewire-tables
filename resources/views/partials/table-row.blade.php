@foreach($columns as $column)
    <td>
        {!! $column->getTableValue($row) !!}
    </td>
@endforeach

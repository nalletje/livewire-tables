<select class="form-select" wire:change="setFilterValue({{ $filterKey }}, $event.target.value)">
    <option value="">Filter: {!! $filter->label() !!}</option>
    @foreach($filter->options() as $val => $label)
        <option value="{{ $val }}" @checked($filter->isSelected($val))>{{ $label }}</option>
    @endforeach
</select>

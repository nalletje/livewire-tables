<select wire:model="action" class="d-inline-block w-auto form-select">
    <option value="">{{ trans('nalletje_livewiretables::lt.fields.action') }}</option>
    @foreach($actions as $key => $action)
        <option value="{{ $key }}">{{ $action->label() }}</option>
    @endforeach
</select>

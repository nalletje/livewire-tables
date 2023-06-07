<th style="width:32px">
    <input type="checkbox"
           class="form-check"
           wire:click="addCollected({{ $data->currentPage() }}, $event.target.value)"
           value="{!! json_encode($data->pluck($data->first()->getKeyName())) !!}"
           @if(in_array($data->currentPage(), $selected_pages)) checked @endif
    />
</th>

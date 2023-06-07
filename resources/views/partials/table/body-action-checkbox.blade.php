<td>
    <input type="checkbox"
           class="form-check"
           wire:change="toggleCollected({{ $data->currentPage() }}, $event.target.value)"
           value="{{ $row->getKey() }}"
           @if (in_array($row->getKey(), $selected_rows)) checked @endif
    />
</td>

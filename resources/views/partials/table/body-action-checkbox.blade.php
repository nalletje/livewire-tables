<td>
    <input type="checkbox"
           class="form-check"
           id="selected_{{ $row->getKey() }}"
           wire:model.live="selected.{{ $row->getKey() }}"
           value="1"
    />
</td>

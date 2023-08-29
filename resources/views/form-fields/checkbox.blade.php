<div class="mb-3">
    <input class="form-check-input {{ $classes }} @error($name) is-invalid @enderror"
           type="checkbox"
           id="lt-{{ $name }}"
           wire:model="form.{{ $name }}"
           name="{{ $name }}"
           value="1"
           @if(old($name, 0) === 1) checked @endif>
    <label class="form-check-label" for="lt-{{ $name }}">
        {{ $label }}
    </label>
    @if ($help)
        <div class="small italic text-muted">* {!! $help !!}</div>
    @endif
</div>

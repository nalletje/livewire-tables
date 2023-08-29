<div class="mb-3">
    <label for="lt-{{ $name }}" class="form-label">{{ $label }}</label>
    <textarea
           class="form-control {{ $classes }} @error($name) is-invalid @enderror"
           id="lt-{{ $name }}"
           name="{{ $name }}"
           wire:model="form.{{ $name }}"
           placeholder="{{ $placeholder }}"
           rows="{{ $rows }}"
    >{{ old($name) }}</textarea>
    @if ($help)
        <div class="small italic text-muted">* {!! $help !!}</div>
    @endif
</div>

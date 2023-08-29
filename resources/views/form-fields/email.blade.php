<div class="mb-3">
    <label for="lt-{{ $name }}" class="form-label">{{ $label }}</label>
    <input type="email"
           class="form-control {{ $classes }} @error($name) is-invalid @enderror"
           id="lt-{{ $name }}"
           wire:model="form.{{ $name }}"
           name="{{ $name }}"
           placeholder="{{ $placeholder ?? '' }}"
           value="{{ old($name) }}"
    />
    @if ($help)
        <div class="small italic text-muted">* {!! $help !!}</div>
    @endif
</div>

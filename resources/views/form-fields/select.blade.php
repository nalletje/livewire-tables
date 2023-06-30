<div class="mb-3">
    <label for="lt-{{ $name }}" class="form-label">{!! $label  !!}</label>
    <select class="form-select {{ $classes }} @error($name) is-invalid @enderror"
           id="lt-{{ $name }}"
           name="{{ $name }}"
           placeholder="{{ $placeholder ?? '' }}"
           value="{{ old($name) }}"
    >
        <option value="">{{ $placeholder ?? trans('nalletje_livewiretables::lt.words.select_a_option') }}</option>
        @foreach($options as $val => $optionLabel)
            <option value="{{ $val }}">{{ $optionLabel }}</option>
        @endforeach
    </select>

    </select>
    @if ($help)
        <div class="small italic text-muted">* {!! $help !!}</div>
    @endif
</div>

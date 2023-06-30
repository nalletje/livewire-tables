<div class="mb-3">
    <label class="form-label">{{ $label }}</label>

    @foreach($options as $val => $radioLabel)
        <div class="form-check">
            <input class="form-check-input  {{ $classes }} @error($name) is-invalid @enderror" type="radio"
                   name="{{ $name }}"
                   id="lt-{{ $name }}-{{$val}}"
                   value="{{ $val }}"
                   @if(old($name, 0) === $val) checked @endif
            >
            <label class="form-check-label" for="lt-{{ $name }}-{{$val}}">
                {{ $radioLabel }}
            </label>
        </div>
    @endforeach
    @if ($help)
        <div class="small italic text-muted">* {!! $help !!}</div>
    @endif
</div>


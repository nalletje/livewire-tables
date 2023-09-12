<div class="d-flex flex-wrap justify-content-center gap-2 float-end">
    @foreach($buttons as $button)
        @if (! isset($button['permission']) || \Illuminate\Support\Facades\Auth::user()->can($button['permission']))
        <a href="{{ route($button['route'], $routeParam) }}"
           class="btn btn-xs btn-outline-primary"
           @if(isset($button['target'])) target="{{ $button['target'] }}" @endif
        >
            @if(isset($button['icon'])) <i class="{{ $button['icon'] }}"></i> @endif {{ $button['label'] ?? '' }}
        </a>
        @endif
    @endforeach
</div>

<a href="{{ $button->getUrl() }}" class="btn btn-{{ $button->getBootstrapColor() }} hstack gap-2 mb-3">
    @if($button->hasIcon())
        <i class="{{ $button->icon() }} fs-6"></i>
        <span class="vr"></span>
    @endif
    {{ $button->label() }}
</a>

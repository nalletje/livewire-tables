@if($button->can())
<a href="{{ $button->getUrl() }}" class="btn btn-{{ $button->getBootstrapColor() }} hstack gap-2 mb-3">
    @if($button->hasIcon())
        <i class="{{ $button->getIcon() }} fs-6"></i>
        <span class="vr"></span>
    @endif
    {{ $button->getLabel() }}
</a>
@endif

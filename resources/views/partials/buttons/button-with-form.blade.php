<a href="#" class="btn btn-{{ $button->getBootstrapColor() }} hstack gap-2 mb-3" wire:click="openButtonModal({{ $key }})">
    @if($button->hasIcon())
        <i class="{{ $button->icon() }} fs-6"></i>
        <span class="vr"></span>
    @endif
    {{ $button->label() }}
</a>

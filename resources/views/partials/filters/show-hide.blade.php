<button wire:click="toggleShowFilters" class="btn btn-primary">
    @if ($show_filters)
        <i class="fa-solid fa-eye-slash"></i> {{ trans('nalletje_livewiretables::lt.filters_hide') }}
    @else
        <i class="fa-solid fa-eye"></i> {{ trans('nalletje_livewiretables::lt.filters_show') }}
    @endif
</button>

<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" id="nlt-settings-btn" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-cogs"></i> &nbsp;
    </button>
    <div class="dropdown-menu" aria-labelledby="nlt-settings-btn" style="min-width:330px">
        <h6 class="dropdown-header">{{ trans('nalletje_livewiretables::lt.words.settings') }}</h6>

        <div class="form-group">
            <select class="form-select" wire:model.live="perPage">
                @foreach($per_page_options as $option)
                    <option value="{{ $option }}">{{ $option }} {{ trans('nalletje_livewiretables::lt.words.rows') }}</option>
                @endforeach
            </select>
        </div>

        @if ($with_filters)
            <h6 class="dropdown-header">{{ trans('nalletje_livewiretables::lt.words.filters') }}</h6>

            @foreach($filters as $filterKey => $filter)
                @include('nalletje_livewiretables::partials.filters.select', compact('filter', 'filterKey'))
            @endforeach
        @endif
    </div>
</div>

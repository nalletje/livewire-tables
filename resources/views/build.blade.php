<div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    @if ($message)
                        <div class="alert alert-info">
                            {!! $message !!}
                        </div>
                    @endif

                    @if ($with_filters && $show_filters)
                        <div class="d-md-flex align-items-baseline gap-1">
                        @foreach($filters as $filterKey => $filter)
                            @include('nalletje_livewiretables::partials.filter', compact('filter', 'filterKey'))
                        @endforeach
                        </div>
                    @endif

                    <div class="d-md-flex align-items-baseline mt-3">
                        @if ($with_buttons && count($buttons))
                            @foreach($buttons as $button)
                                @include('nalletje_livewiretables::partials.button', compact('button'))
                            @endforeach
                        @endif

                        <div class="d-flex align-items-center gap-1 text-nowrap ms-auto mb-3">
                            @if ($with_search)
                                <input wire:model="search" type="search" class="d-inline-block w-auto form-control" placeholder="{{ trans('nalletje_livewiretables::lt.fields.search') }}">
                            @endif

                            @if ($with_actions)
                                <select wire:model="action" class="d-inline-block w-auto form-select">
                                    <option value="">{{ trans('nalletje_livewiretables::lt.fields.action') }}</option>
                                    @foreach($actions as $key => $action)
                                        <option value="{{ $key }}">{{ $action->label() }}</option>
                                    @endforeach
                                </select>
                            @endif

                            @if ($with_filters)
                                <button wire:click="toggleShowFilters" class="btn btn-primary">
                                    @if ($show_filters)
                                        <i class="fa-solid fa-eye-slash"></i> {{ trans('nalletje_livewiretables::lt.filters_hide') }}
                                    @else
                                        <i class="fa-solid fa-eye"></i> {{ trans('nalletje_livewiretables::lt.filters_show') }}
                                    @endif
                                </button>
                            @endif
                        </div>
                    </div>

                    @if ($data->isEmpty())
                        <h1 class="page-title mb-0 mt-2">{{ trans('nalletje_livewiretables::lt.words.no_results_found') }}</h1>
                    @else

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    @if ($with_actions)
                                        <th style="width:32px">
                                            <input type="checkbox"
                                                   class="form-check"
                                                   wire:click="addCollected({{ $data->currentPage() }}, $event.target.value)"
                                                   value="{!! json_encode($data->pluck($data->first()->getKeyName())) !!}"
                                                   @if(in_array($data->currentPage(), $selected_pages)) checked @endif
                                            />
                                        </th>
                                    @endif
                                    @foreach($columns as $i => $column)
                                        <th
                                            @if($column->isSortable())
                                                class="pointer"
                                                wire:click="setColumnSort('{{ $column->getField() }}')"
                                            @endif
                                        >
                                            {{ $column->getLabel() }}
                                            @if ($column->isSortable())
                                                @if ($column->getField() === $sort_field && $sort_dir === "ASC")
                                                    <i class="fa-solid fa-sort-up mt-1"></i>
                                                @elseif($column->getField() === $sort_field && $sort_dir === "DESC")
                                                    <i class="fa-solid fa-sort-down mt-1"></i>
                                                @else
                                                    <i class="fa-solid fa-sort mt-1"></i>
                                                @endif
                                            @endif
                                        </th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $row)
                                    <tr>
                                        @if ($with_actions)
                                            <td>
                                                <input type="checkbox" class="form-check" wire:model="collected" value="{{ $row->getKey() }}" />
                                            </td>
                                        @endif

                                        @include("nalletje_livewiretables::partials.table-row", compact('columns'))
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                @if ($with_actions && $selected_rows > 0)
                                    <span><b>{{ $selected_rows }}</b> {{ trans('nalletje_livewiretables::lt.rows_selected') }}</span>
                                @endif
                            </div>
                            <div class="col-4">
                                {{ $data->links() }}
                            </div>
                            <div class="col-3">

                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

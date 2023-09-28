<div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    @includeWhen($message, 'nalletje_livewiretables::partials.messages.'.$message_type)

                    @if ($with_filters && $show_filters)
                        <div class="d-md-flex align-items-baseline gap-1">
                        @foreach($filters as $filterKey => $filter)
                            @include('nalletje_livewiretables::partials.filters.select', compact('filter', 'filterKey'))
                        @endforeach
                        </div>
                    @endif

                    <div class="d-md-flex align-items-baseline mt-3">
                        @include('nalletje_livewiretables::partials.buttons')

                        <div class="d-flex align-items-center gap-1 text-nowrap ms-auto mb-3">
                            @includeWhen($with_search, 'nalletje_livewiretables::partials.search')
                            @includeWhen($with_actions && count($selected_rows), 'nalletje_livewiretables::partials.actions')
                            @includeWhen($with_filters, 'nalletje_livewiretables::partials.filters.show-hide')
                        </div>
                    </div>

                    <div>
                        @includeWhen($loader, 'nalletje_livewiretables::partials.loader')

                        <div wire:loading.class="nlt-table-loader">
                            @if ($data->isEmpty())
                                <h1 class="page-title mb-0 mt-2">{{ trans('nalletje_livewiretables::lt.words.no_results_found') }}</h1>
                            @else

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            @includeWhen($with_actions, 'nalletje_livewiretables::partials.table.head-action-checkbox')
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
                                                @includeWhen($with_actions, 'nalletje_livewiretables::partials.table.body-action-checkbox')
                                                @include("nalletje_livewiretables::partials.table-row", compact('columns'))
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        @if ($with_actions && count($selected_rows) > 0)
                                            <span><b>{{ count($selected_rows) }}</b> {{ trans('nalletje_livewiretables::lt.rows_selected') }}</span>
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
    </div>

    @includeWhen($with_actions && $action_with_form, "nalletje_livewiretables::partials.actions.form-modal")
    @includeWhen($with_buttons && $button_with_form, "nalletje_livewiretables::partials.buttons.form-modal")

    <style>
        .nlt-table-loader {
            opacity: 0.5;
        }
        .nlt-loader-container {
            position: absolute;
            width: 100%;
            top: 50%;
            opacity: 1;
        }
        .nlt-loader-title {
            position: absolute;
            top: 50%;
            left: 42%;
            z-index: 2;
            padding: 32px;
            background-color: white;
            border: 1px solid #F0EEEE;
        }
    </style>
</div>

<div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    @includeWhen($message, 'nalletje_livewiretables::partials.messages.'.$message_type)

                    <div class="d-md-flex align-items-baseline mt-3">
                        @include('nalletje_livewiretables::partials.buttons')

                        <div class="d-flex align-items-center gap-1 text-nowrap ms-auto mb-3">
                            @includeWhen($with_search, 'nalletje_livewiretables::partials.search')
                            @includeWhen($with_actions && count($selected), 'nalletje_livewiretables::partials.actions')
                            @include('nalletje_livewiretables::partials.settings')
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
                                                        class="nlt-pointer"
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
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <p class="nlt-total-rows">
                                            @if ($with_actions && count($selected) > 0)
                                                {!! trans('nalletje_livewiretables::lt.total-selected-results', [
                                                    'selected' => count($selected),
                                                    'from' => $data->firstItem(),
                                                    'to' => $data->lastItem(),
                                                    'total' => $data->total()
                                                ]) !!}
                                            @else
                                                {!! trans('nalletje_livewiretables::lt.total-results', [
                                                    'from' => $data->firstItem(),
                                                    'to' => $data->lastItem(),
                                                    'total' => $data->total()
                                                ]) !!}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-6 nlt-pagination">
                                        {{ $data->links() }}
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
        .nlt-pointer {
            cursor: pointer;
        }
        .nlt-pagination {
            float:right;
        }
        .nlt-total-rows {
            margin-top:11px;
            font-size: 0.9em;
            font-style: italic;
        }
    </style>
</div>

<?php

namespace Nalletje\LivewireTables\_examples;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Nalletje\LivewireTables\Builders\Button;
use Nalletje\LivewireTables\Builders\Column;
use Nalletje\LivewireTables\LivewireTableComponent;
use Nalletje\LivewireTables\Traits\WithActions;
use Nalletje\LivewireTables\Traits\WithButtons;
use Nalletje\LivewireTables\Traits\WithFilters;
use Nalletje\LivewireTables\Traits\WithSearch;

class ExampleTable extends LivewireTableComponent
{
    // add if you want row actions
    use WithActions;
    // add if you want custom buttons (create for example)
    use WithButtons;
    // add if you want to use filters
    use WithFilters;
    // Add if you want search
    use WithSearch;
    // add if you want pagination
    use WithPagination;

    // A Queryable model
    protected string $model = User::class;

    public function actions(): array
    {
        return [
            new ExampleAction(),
        ];
    }

    public function filters(): array
    {
        return [
            new ExampleFilter(),
        ];
    }

    public function buttons(): array
    {
        return [
            Button::make(
                    route("your-route"),
                    trans('your-trans-or-label')
                )
                ->icon('optionable i class')
                ->permission('optional spatie permission'),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make('relation.field', "Label"),
            Column::make('field', trans('Label')),

            Column::make('id', "")
                ->sortable(false)
                ->searchable(false)
                ->buttons([[
                    'icon' => 'fas fa-edit',
                    'route' => 'route-url',
                    'permission' => 'optional spatie permission'
                ]]),
        ];
    }

    public function withQuery(Builder $query): Builder
    {
        return $query->with('relation');
    }
}

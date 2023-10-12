<?php
namespace Nalletje\LivewireTables\Traits;

use Livewire\Attributes\Url;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait WithSearch
{
    #[Url]
    public ?string $search = null;

    public function updatingSearch(): void
    {
        $this->resetLivewireTablePage();
    }

    public function appendSearch(Builder $query): Builder
    {
        $query->when(strlen($this->search) >= 1, function ($query) {
            $query->where(function ($query) {
                foreach($this->columns() as $column) {
                    if ($column->isSearchable()) {
                        if (Str::contains($column->field, '.')) {
                            $this->appendOrWhereHas($query, $column->field);
                            continue;
                        }

                        $query->orWhere($column->field, "LIKE", "%$this->search%");
                    }
                }
            });
        });

        return $query;
    }

    protected function appendOrWhereHas(Builder $query, string $field): void
    {
        $relation = Str::before($field, '.');
        $field = Str::after($field, '.');

        $query->orWhereHas($relation, function ($query) use ($field) {
            if (Str::contains($field, '.')) {
                $this->appendOrWhereHas($query, $field);
            } else {
                $query->where($field, "LIKE", "%$this->search%");
            }
        });
    }
}

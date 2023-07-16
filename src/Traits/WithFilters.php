<?php
namespace Nalletje\LivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;

trait WithFilters
{
    protected array $queryStringWithFilters = [
        'todo_why_cant_i_only_put_show_filters', // TODO: Figure out
        'show_filters',
    ];

    public array $filter_values = [];

    public bool $show_filters = false;

    public function appendFilters(Builder $query): Builder
    {
        foreach($this->filter_values as $key => $val) {
            if (is_null($val) === false) {
                $this->filters()[$key]->appendToQuery($query, $val);
            }
        }

        return $query;
    }

    public function getFilters(): array
    {
        $filters = array_filter($this->filters(), fn($f) => $f->auth());

        foreach($this->filter_values as $key => $val) {
            $filters[$key]->setValue($val);
        }

        return $filters;
    }

    public function setFilterValue(int $key, mixed $val): void
    {
        $this->resetLivewireTablePage();
        $this->filter_values[$key] = $val === "" ? null : $val;
    }

    public function toggleShowFilters(): void
    {
        $this->show_filters = !$this->show_filters;
    }
}

<?php
namespace Nalletje\LivewireTables\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait WithData
{
    public $paginationOnEachSide = 1; // Maked the pagination smaller/bigger (more pages)

    public function baseQuery(): Builder
    {
        if (is_null($this->model)) {
            throw new \ErrorException("No model given in configuration!");
        }

        $query = $this->model::query();

        if (method_exists($this, 'withQuery')) {
            $query = $this->withQuery($query);
        }

        if ($this->hasFilters()) {
            $query = $this->appendFilters($query);
        }

        if ($this->hasSearch()) {
            $query = $this->appendSearch($query);
        }

        if ($this->hasSort()) {
            $query = $this->appendSort($query);
        }

        return $query;
    }

    public function getData(): Collection|LengthAwarePaginator|array
    {
        $query = $this->baseQuery();

        return $this->hasPagination()
            ? $query->paginate($this->perPage)->onEachSide($this->paginationOnEachSide)
            : $query->get();
    }

    protected function performJoin(builder $query, $table, $foreign, $other, $type = 'left'): Builder
    {
        $joins = [];

        foreach ($query->getQuery()->joins ?? [] as $join) {
            $joins[] = $join->table;
        }

        if (! in_array($table, $joins, true)) {
            $query->join($table, $foreign, '=', $other, $type);
        }

        return $query;
    }
}

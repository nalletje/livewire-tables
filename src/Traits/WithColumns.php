<?php
namespace Nalletje\LivewireTables\Traits;

use Illuminate\Support\Collection;

trait WithColumns
{
    protected Collection $columns;

    public function bootWithColumns(): void
    {
        $this->columns = collect();
    }

    public function setColumns(): Collection
    {
        if (! method_exists($this, 'columns')) {
            throw new \ErrorException("Function `columns` not set");
        }

        $this->columns = collect($this->columns());

        return $this->columns;
    }

    public function getColumns(): Collection
    {
        return $this->columns->isEmpty()
            ? $this->setColumns()
            : $this->columns;
    }
}

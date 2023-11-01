<?php
namespace Nalletje\LivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;
use Livewire\Attributes\Url;

trait WithSort
{
    #[Url]
    public ?string $sort_field = null;

    #[Url]
    public ?string $sort_dir = null;

    public function setColumnSort(string $field): void
    {
        $this->sort_dir = $this->getNextSortDirection($field);
        $this->sort_field = $field;

        $this->resetLivewireTablePage();
    }

    public function appendSort(Builder $query): Builder
    {
        if ($this->sort_field && $this->sort_dir) {
            $sort_field = $this->sort_field;

            if (Str::contains($sort_field, '.')) {
                list($query, $sort_field) = $this->joinRelation($query);
            }

            $query->orderBy($sort_field, $this->sort_dir);
        }

        return $query;
    }

    protected function getNextSortDirection(string $field): ?string
    {
        if ($field !== $this->sort_field) {
            return "ASC";
        }

        return match ($this->sort_dir) {
            "ASC" => "DESC",
            "DESC" => null,
            null => "ASC",
        };
    }

    // TODO: Refactor
    protected function joinRelation(Builder $query): array
    {
        $table = false;
        $foreign = false;
        $other = false;
        $lastQuery = clone $query;

        $sortField = Str::afterLast($this->sort_field, '.');
        $relationParts = explode('.', $this->sort_field);
        array_pop($relationParts);
        $sortTable = '';

        foreach ($relationParts as $relationPart) {
            $model = $lastQuery->getRelation($relationPart);

            switch (true) {
                case $model instanceof MorphOne:
                case $model instanceof HasOne:
                    $table = $model->getRelated()->getTable();
                    $foreign = $model->getQualifiedForeignKeyName();
                    $other = $model->getQualifiedParentKeyName();

                    break;

                case $model instanceof BelongsTo:
                    $table = $model->getRelated()->getTable();
                    $foreign = $model->getQualifiedForeignKeyName();
                    $other = $model->getQualifiedOwnerKeyName();

                    break;
            }

            if ($table) {
                $this->performJoin($query, $table, $foreign, $other);

                if (count($query->getQuery()->getColumns()) === 0) {
                    $modelTable = $this->getModelTable();
                    $modelPrimarykey = $this->getModelKey();

                    $query->addSelect('*');
                    $query->addSelect("$modelTable.$modelPrimarykey AS $modelPrimarykey");
                }

                $sortTable = $table.'.';
            }
        }

        return [$query, $sortTable.$sortField];
    }
}

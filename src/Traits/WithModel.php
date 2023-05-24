<?php
namespace Nalletje\LivewireTables\Traits;

trait WithModel
{
    protected string $model;

    protected ?string $modelTable = null;
    protected ?string $modelKey = null;

    public function getModelKey(): string
    {
        if (is_null($this->modelKey)) {
            $this->modelKey = (new $this->model)->getKeyName();
        }

        return $this->modelKey;
    }

    public function getModelTable(): string
    {
        if (is_null($this->modelTable)) {
            $this->modelTable = (new $this->model)->getTable();
        }

        return $this->modelTable;
    }
}

<?php
namespace Nalletje\LivewireTables\Builders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Column
{
    public array $buttons = [];
    public bool $sortable = true;
    public bool $searchable = true;
    public ?string $sortField = null;

    public function __construct(public string $field, public ?string $label = null) {}

    public static function make(string $field, ?string $label = null): Column
    {
        return new static($field, $label);
    }

    public function getButtons(mixed $routeParam = null): string
    {
        return view('nalletje_livewiretables::partials.row-buttons', [
            'buttons' => $this->buttons,
            'routeParam' => $routeParam
        ])->render();
    }

    public function getLabel(): string
    {
        return $this->label ?? $this->field;
    }

    public function getField(): string
    {
        return $this->field;
    }

    public function getTableValue(Model $model): mixed
    {
        $field = $this->field;

        if (Str::contains($field, '.')) {
            foreach(explode('.', $field) as $field) {
                $model = $model->$field;
            }

            $val = $model;
        } else {
            $val = $model->$field;
        }

        if ($this->hasButtons()) {
            return $this->getButtons($val);
        }

        return $val;
    }

    public function hasButtons(): bool
    {
        return ! empty($this->buttons);
    }

    public function label(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function sortable(bool $val = true): self
    {
        $this->sortable = $val;

        return $this;
    }

    public function sortField(string $field): self
    {
        $this->sortField = $field;
        $this->sortable();

        return $this;
    }

    public function searchable(bool $val = true): self
    {
        $this->searchable = $val;

        return $this;
    }

    public function buttons(array $buttons): self
    {
        $this->buttons = $buttons;

        return $this;
    }

    public function isSortable(): bool
    {
        return $this->sortable;
    }

    public function isSearchable(): bool
    {
        return $this->searchable;
    }
}

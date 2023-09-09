<?php
namespace Nalletje\LivewireTables\Builders;

use ErrorException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Column
{
    public array $buttons = [];
    public bool $sortable = true;
    public bool $searchable = true;
    public ?string $sortField = null;
    public mixed $transformer = null;
    public ?array $routeParams = null;
    public ?string $replaceRouteParamkey = null;

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

    private function getRouteParams(mixed $val): array
    {
        $routeParams = $this->routeParams;
        $routeParams[$this->replaceRouteParamkey] = $val;

        return $routeParams;
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

        if ($this->hasTransformer()) {
            return $this->getTransformer($val);
        }

        if ($this->hasButtons()) {
            if ($this->hasRouteParams()) {
                return $this->getButtons(
                    $this->getRouteParams($val)
                );
            }

            return $this->getButtons($val);
        }

        return $val;
    }

    public function getTransformer(mixed $val): mixed
    {
        if (is_callable($this->transformer)) {
            $fnc = $this->transformer;
            return $fnc($val);
        }

        return Str::replace("{val}", $val, $this->transformer);
    }

    public function hasButtons(): bool
    {
        return ! empty($this->buttons);
    }

    public function hasTransformer(): bool
    {
        return ! is_null($this->transformer);
    }

    public function hasRouteParams(): bool
    {
        return ! is_null($this->routeParams);
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

    /**
     * @throws ErrorException
     */
    public function transform(callable|string $transformTo): self
    {
        if (is_string($transformTo) && Str::contains($transformTo, "{val}") === false) {
            throw new ErrorException("{val} is not set in transform function for column: $this->label");
        }

        $this->transformer = $transformTo;

        return $this;
    }

    public function routeparams(array $routeParams, string $replaceKey): self
    {
        if (is_array($routeParams) === false) {
            throw new ErrorException("routeparams should be an array");
        }
        if (array_key_exists($replaceKey, $routeParams) === false) {
            throw new ErrorException("replaceKey is not found in routeparam array");
        }

        $this->routeParams = $routeParams;
        $this->replaceRouteParamkey = $replaceKey;

        return $this;
    }
}

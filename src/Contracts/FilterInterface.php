<?php
namespace Nalletje\LivewireTables\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

interface FilterInterface
{
    public function auth(): bool;
    public function appendToQuery(Builder $query, mixed $value): void;
    public function label(): string;
    public function options(): Collection;
    public function isSelected(mixed $option): bool;
    public function setValue(mixed $value): void;
}

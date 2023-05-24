<?php
namespace Nalletje\LivewireTables\_examples;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Nalletje\LivewireTables\Builders\Filter;
use Nalletje\LivewireTables\Contracts\FilterInterface;

class ExampleFilter extends Filter implements FilterInterface
{
    function auth(): bool
    {
        // auth()->user()->can('permission_name') for example if using spatie permissions
        return true;
    }

    public function appendToQuery(Builder $query, mixed $value): void
    {
        $query->where('your_field', '=', $value);
    }

    public function label(): string
    {
        return "label";
    }

    public function options(): Collection
    {
        return User::query()
            ->select(['id', 'name'])
            ->get()
            ->pluck('name', 'id');
    }
}

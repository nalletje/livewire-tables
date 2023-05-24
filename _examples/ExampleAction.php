<?php
namespace Nalletje\LivewireTables\_examples;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Nalletje\LivewireTables\Contracts\ActionInterface;

class ExampleAction implements ActionInterface
{
    function auth(): bool
    {
        // auth()->user()->can('permission_name') for example if using spatie permissions
        return true;
    }

    function label(): string
    {
        return "Action label";
    }

    function handle(Collection $collection): string
    {
        $collection->each(function (Model $model) {
            // Do Something with the model(s)
        });

        return "Return message";
    }
}

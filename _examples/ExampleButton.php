<?php

namespace Nalletje\LivewireTables\_examples;


use Nalletje\LivewireTables\Builders\Button;
use Nalletje\LivewireTables\Contracts\ButtonInterface;

class ExampleButton extends Button implements ButtonInterface
{
    public function auth(): bool
    {
        return current_user()->can('example-permission');
    }

    public function label(): string
    {
        return trans('common.buttons.create');
    }

    /* Options:
        'primary',
        'secondary',
        'info',
        'warning',
        'danger',
    */
    public function bootstrapColor(): string
    {
        return "primary";
    }

    // font-awesome icons or a icon pack you use...
    public function icon(): ?string
    {
        return 'fa-solid fa-plus';
    }

    public function url(): ?string
    {
        return route("your-route");
    }
}

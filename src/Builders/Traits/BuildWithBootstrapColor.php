<?php
namespace Nalletje\LivewireTables\Builders\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Nalletje\LivewireTables\Contracts\ActionWithFormInterface;

trait BuildWithBootstrapColor
{
    protected array $allowedBootstrapColors = [
        'primary',
        'secondary',
        'info',
        'warning',
        'danger',
    ];

    public function getBootstrapColor(): string
    {
        $color = $this->bootstrapColor();

        if (in_array($color, $this->allowedBootstrapColors, true)) {
            return $color;
        }

        return "primary";
    }
}
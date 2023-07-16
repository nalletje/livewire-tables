<?php
namespace Nalletje\LivewireTables\Builders;

use Nalletje\LivewireTables\Builders\Traits\BuildWithBootstrapColor;
use Nalletje\LivewireTables\Builders\Traits\BuildWithForm;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class ButtonWithForm
{
    use BuildWithBootstrapColor, BuildWithForm;

    public function hasForm(): bool
    {
        return true;
    }

    public function hasIcon(): bool
    {
        return is_null($this->icon()) === false;
    }
}

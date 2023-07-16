<?php
namespace Nalletje\LivewireTables\Builders;

use Illuminate\Database\Eloquent\Model;
use Nalletje\LivewireTables\Builders\Traits\BuildWithBootstrapColor;
use Nalletje\LivewireTables\Traits\WithButtons;
use Spatie\Permission\Traits\HasRoles;

class Button
{
    use BuildWithBootstrapColor;

    public function getUrl(): string
    {
        return $this->url();
    }

    public function hasIcon(): bool
    {
        return is_null($this->icon()) === false;
    }

    public function hasForm(): bool
    {
        return false;
    }
}

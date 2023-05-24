<?php
namespace Nalletje\LivewireTables\Builders;

use Illuminate\Database\Eloquent\Model;
use Nalletje\LivewireTables\Traits\WithButtons;
use Spatie\Permission\Traits\HasRoles;

class Button
{
    public ?string $icon = null;
    public string $bootstrapColor = 'info';
    public ?string $permission = null;

    protected array $allowedBootstrapColors = [
        'primary',
        'secondary',
        'info',
        'warning',
        'danger',
    ];

    public function __construct(
        public string $url,
        public string $label,
    ) {}

    public static function make(string $url, string $label): Button
    {
        return new static($url, $label);
    }

    public function can(): bool
    {
        if ($this->permission === null) {
            return true;
        }

        $user = auth()->user();

        if (! in_array(HasRoles::class, class_uses(get_class($user)))) {
            return false;
        }

        return $user->can($this->permission);
    }

    public function getBootstrapColor(): string
    {
        return $this->bootstrapColor;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function hasIcon(): bool
    {
        return strlen($this->icon > 1);
    }

    public function icon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function bootstrapColor(string $bootstrapColor): self
    {
        if (in_array($bootstrapColor, $this->allowedBootstrapColors, true)) {
            $this->bootstrapColor = $bootstrapColor;
        }

        return $this;
    }

    public function permission(string $permission): self
    {
        $this->permission = $permission;

        return $this;
    }
}

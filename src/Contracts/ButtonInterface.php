<?php
namespace Nalletje\LivewireTables\Contracts;

use Illuminate\Support\Collection;
use Nalletje\LivewireTables\Objects\Message;

interface ButtonInterface
{
    public function auth(): bool;
    public function label(): string;
    public function bootstrapColor(): string;
    public function icon(): ?string;
    public function url(): ?string;
}

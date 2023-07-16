<?php
namespace Nalletje\LivewireTables\Contracts;

use Illuminate\Support\Collection;
use Nalletje\LivewireTables\Objects\Message;

interface ButtonWithFormInterface
{
    public function auth(): bool;
    public function label(): string;
    public function bootstrapColor(): string;
    public function icon(): ?string;
    public function handle(array $form): Message;
    public function fields(): array;
}

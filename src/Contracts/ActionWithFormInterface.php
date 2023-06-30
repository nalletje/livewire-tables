<?php
namespace Nalletje\LivewireTables\Contracts;

use Illuminate\Support\Collection;
use Nalletje\LivewireTables\Objects\Message;

interface ActionWithFormInterface
{
    public function auth(): bool;
    public function label(): string;
    public function handle(Collection $collection, array $form): Message;
    public function fields(): array;
}

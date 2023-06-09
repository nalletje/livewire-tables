<?php
namespace Nalletje\LivewireTables\Contracts;

use Illuminate\Support\Collection;
use Nalletje\LivewireTables\Objects\Message;

interface ActionInterface
{
    public function auth(): bool;
    public function label(): string;
    public function handle(Collection $collection): Message;
}

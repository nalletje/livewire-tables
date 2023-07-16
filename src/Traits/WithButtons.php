<?php
namespace Nalletje\LivewireTables\Traits;

trait WithButtons
{
    public function getButtons(): array
    {
        return array_filter($this->buttons(), fn($b) => $b->auth());
    }
}

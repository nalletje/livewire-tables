<?php
namespace Nalletje\LivewireTables\Builders;

class Filter
{
    public mixed $value = null;

    public function isSelected(mixed $option): bool
    {
        return $this->value === $option;
    }

    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }
}

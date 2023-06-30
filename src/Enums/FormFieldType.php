<?php

namespace Nalletje\LivewireTables\Enums;

enum FormFieldType: string
{
    case checkbox = "checkbox";
    case email = "email";
    case number = "number";
    case select = "select";
    case radio = "radio";
    case text = "text";
    case textarea = "textarea";

    public function needsOptions(): bool
    {
        return in_array($this->value, [self::select, self::radio], true);
    }

    public function view(): string
    {
        return "nalletje_livewiretables::form-fields.$this->value";
    }
}

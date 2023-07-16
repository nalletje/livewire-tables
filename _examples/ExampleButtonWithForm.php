<?php

namespace Nalletje\LivewireTables\_examples;

use Nalletje\LivewireTables\Builders\ButtonWithForm;
use Nalletje\LivewireTables\Builders\FormField;
use Nalletje\LivewireTables\Contracts\ButtonWithFormInterface;
use Nalletje\LivewireTables\Enums\FormFieldType;
use Nalletje\LivewireTables\Objects\Message;

class ExampleButtonWithForm extends ButtonWithForm implements ButtonWithFormInterface
{
    public function auth(): bool
    {
        return true;
    }

    public function label(): string
    {
        return "Create Example";
    }

    public function bootstrapColor(): string
    {
        return "primary";
    }

    public function icon(): ?string
    {
        return 'fa-solid fa-plus';
    }

    public function handle(array $form): Message
    {
        $data = $form['data'];
//        dd($form);

        return Message::make('Created without errors', 'success');
    }

    public function fields(): array
    {
        return [
            FormField::make("Label Email", "dummyfield", FormFieldType::email)
                ->rules([
                    "required",
                    "email",
                ])
                ->help("Dummy help text!"),
            FormField::make("Label Subject", "dummyfield", FormFieldType::text)
                ->rules([
                    "required",
                    "min:3",
                ])
                ->help("Dummy help text!"),
            FormField::make("Textareaaa", "dummytextarea", FormFieldType::textarea)
                ->rules([
                    "required",
                    "min:3",
                ]),
            FormField::make("Label Number", "dummynr", FormFieldType::number)
                ->rules([
                    "numeric",
                ])
                ->help("Just a number!"),
            FormField::make("Label Checkbox", "dummycheck", FormFieldType::checkbox),
            FormField::make("Label Radio", "dummyradio", FormFieldType::radio)
                ->rules([
                    "required",
                ])
                ->options([
                    1 => "male",
                    2 => "female",
                    3 => "other",
                ]),
            FormField::make("Label Select", "dummysel", FormFieldType::select)
                ->rules([
                    "required",
                ])
                ->options([
                    1 => "male",
                    2 => "female",
                    3 => "other",
                ]),
        ];
    }
}

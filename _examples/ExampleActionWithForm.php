<?php
namespace Nalletje\LivewireTables\_examples;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Nalletje\LivewireTables\Builders\ActionWithForm;
use Nalletje\LivewireTables\Builders\FormField;
use Nalletje\LivewireTables\Contracts\ActionWithFormInterface;
use Nalletje\LivewireTables\Enums\FormFieldType;
use Nalletje\LivewireTables\Objects\Message;

class ExampleActionWithForm extends ActionWithForm implements ActionWithFormInterface
{
    function auth(): bool
    {
        return true;
    }

    function label(): string
    {
        return "Dummy Form Action";
    }

    function handle(Collection $collection, array $form): Message
    {
        $fails = false;

        $collection->each(function (Model $model) {
            // DO YOUR STUFF
        });

        if ($fails) {
            return Message::make('Something went wrong', 'danger');
        }

        return Message::make('Action is executed without errors', 'success');
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

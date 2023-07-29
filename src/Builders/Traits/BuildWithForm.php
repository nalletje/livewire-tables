<?php
namespace Nalletje\LivewireTables\Builders\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Nalletje\LivewireTables\Contracts\ActionWithFormInterface;

trait BuildWithForm
{
    public function fieldNames(): array
    {
        return array_map(fn ($field) => $field->name, $this->fields());
    }

    public function rules(): array
    {
        return array_filter(
            array_combine($this->fieldNames(), array_values(array_map(fn ($field) => $field->rules, $this->fields())))
        );
    }

    public function validate(array $formData): array
    {
        $validator = Validator::make($formData, $this->rules());

        if ($validator->fails()) {
            return [
                'errors' => true,
                'errors_html' => $this->errorsToHtml($validator->errors()->messages()),
            ];
        }

        return [
            'errors' => false,
            'data' => $formData,
        ];
    }

    // TODO: Refactor
    protected function errorsToHtml(array $errors): string
    {
        $messages = '';

        foreach($errors as $error_messages) {
            foreach($error_messages as $error_message) {
                $messages .= "<li>$error_message</li>";
            }
        }

        return "<ul>$messages</ul>";
    }
}

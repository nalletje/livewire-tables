<?php
namespace Nalletje\LivewireTables\Builders;

use Nalletje\LivewireTables\Enums\FormFieldType;

class FormField
{
    public ?string $classes = null;
    public ?string $help = null;
    public ?string $placeholder = null;
    public ?array $rules = null;
    public ?array $options = null;
    public int $rows = 4;
    public string $steps = "0.01";

    public function __construct(public string $label, public string $name, public FormFieldType $type) {}

    public static function make(string $label, string $name, FormFieldType $type): FormField
    {
        return new static($label, $name, $type);
    }

    public function build(): string
    {
        if ($this->validateBuildOptions()) {
            throw new \ErrorException("FormField `$this->label` does not contain options!");
        }

        return view($this->type->view(), [
            'classes' => $this->classes,
            'label' => $this->label,
            'name' => $this->name,
            'placeholder' => $this->placeholder,
            'options' => $this->options,
            'help' => $this->help,
            'rows' => $this->rows,
            'steps' => $this->steps,
        ])->render();
    }

    public function class(string $text): self
    {
        $this->classes = $text;

        return $this;
    }

    public function help(string $text): self
    {
        $this->help = $text;

        return $this;
    }

    public function placeholder(string $text): self
    {
        $this->placeholder = $text;

        return $this;
    }

    public function rows(int $rows): self
    {
        $this->rows = $rows;

        return $this;
    }

    // Laravel validation rules :: https://laravel.com/docs/10.x/validation#available-validation-rules
    public function rules(array $rules): self
    {
        $this->rules = $rules;

        return $this;
    }

    public function steps(string $steps): self
    {
        $this->steps = $steps;

        return $this;
    }

    // KEY = ID / Value
    // value = Label
    // Example: [1 => "Male", 2 => "Female", 3 => "Other"]
    public function options(array $options): self
    {
        $this->options = $options;

        return $this;
    }

    protected function validateBuildOptions(): bool
    {
        return $this->type->needsOptions() && is_null($this->options);
    }
}

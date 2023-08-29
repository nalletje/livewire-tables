<?php
namespace Nalletje\LivewireTables\Traits;

trait WithButtons
{
    public ?string $buttonWithForm = null;

    public function getButtons(): array
    {
        return array_filter($this->buttons(), fn($b) => $b->auth());
    }

    public function openButtonModal(int $key): void
    {
        $button = $this->buttons()[$key];

        if ($button->auth() && $button->hasForm()) {
            $this->buttonWithForm = $key;
        }
    }

    public function closeButtonModal(): void
    {
        $this->buttonWithForm = null;
    }

    public function executeButton(): void
    {
        $this->clearMessages();

        $button = $this->buttons()[$this->buttonWithForm];
        $validatedData = $button->validate($this->form);

        if ($validatedData['errors']) {
            $this->setErrorMessage(trans('nalletje_livewiretables::lt.forms.validation_error', [
                'errors' => $validatedData['errors_html']
            ]));
            return;
        }

        $messageObject = $button->handle($validatedData);

        $this->message = $messageObject->message();
        $this->message_type = $messageObject->type();

        $this->closeButtonModal();
    }
}

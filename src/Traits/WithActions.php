<?php
namespace Nalletje\LivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Nalletje\LivewireTables\Contracts\ActionWithFormInterface;

trait WithActions
{
    public ?string $action = '';
    public ?string $actionWithForm = null;
    public bool $selectAll = false;
    public array $selected = [];

    public function getActions(): array
    {
        return array_filter($this->actions(), fn($a) => $a->auth());
    }

    public function updatedAction(): void
    {
        if (isset($this->actions()[$this->action])) {
            $action = $this->actions()[$this->action];

            if ($action instanceof ActionWithFormInterface) {
                $this->actionWithForm = $this->action;
                return;
            }

            $messageObject = $action->handle(
                $this->getDataCollection()
            );

            $this->message = $messageObject->message();
            $this->message_type = $messageObject->type();
        }

        $this->action = '';
        $this->selected = [];
        $this->selectAll = false;
        $this->resetLivewireTablePage();
    }

    public function updatedSelected(): void
    {
        $this->selected = array_filter($this->selected, fn($val) => $val);
    }

    public function updatedSelectAll(): void
    {
        $this->selected = $this->selectAll
                ? $this->getPluckedDataCollection()
                : [];
    }

    public function closeActionModal(): void
    {
        $this->action = '';
        $this->actionWithForm = null;
    }

    public function executeAction(): void
    {
        $this->clearMessages();

        $data = $this->getDataCollection();
        $action = $this->actions()[$this->actionWithForm];

        $validatedData = $action->validate($this->form);

        if ($validatedData['errors']) {
            $this->setErrorMessage(trans('nalletje_livewiretables::lt.forms.validation_error', [
                'errors' => $validatedData['errors_html']
            ]));
            return;
        }

        $messageObject = $action->handle($data, $validatedData);

        $this->message = $messageObject->message();
        $this->message_type = $messageObject->type();

        $this->closeActionModal();
        $this->selected = [];
        $this->selectAll = false;
    }

    protected function getDataCollection(): Collection
    {
        $table = $this->getModelTable();
        $field = $this->getModelKey();

        return $this->baseQuery()
            ->when($this->selectAll === false, function($query) {
                $query->whereIn("$table.$field", $this->selected);
            })
            ->get();
    }

    // TODO : refactor - kind of dupe
    protected function getPluckedDataCollection(): array
    {
        $table = $this->getModelTable();
        $field = $this->getModelKey();

        $selected = $this->baseQuery()
            ->when($this->selectAll === false, function($query) {
                $query->whereIn("$table.$field", $this->selected);
            })
            ->pluck("$table.$field")
            ->toArray();

        $selected = array_flip($selected);
        $selected = array_fill_keys(array_keys($selected), true);

        return $selected;
    }
}

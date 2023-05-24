<?php
namespace Nalletje\LivewireTables\Traits;

use Illuminate\Support\Collection;

trait WithActions
{
    public ?string $action = '';
    public array $collected = [];

    public function updatedAction(): void
    {
        if (isset($this->actions()[$this->action])) {
            $collection = $this->getDataCollection();
            $this->message = $this->actions()[$this->action]->handle($collection);
        }

        $this->action = '';
        $this->collected = [];
        $this->resetLivewireTablePage();
    }

    protected function getDataCollection(): Collection
    {
        $table = $this->getModelTable();
        $field = $this->getModelKey();

        return $this->baseQuery()
            ->whereIn("$table.$field", $this->collected)
            ->get();

    }
}

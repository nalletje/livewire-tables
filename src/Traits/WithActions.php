<?php
namespace Nalletje\LivewireTables\Traits;

use Illuminate\Support\Collection;

trait WithActions
{
    public ?string $action = '';
    public array $collected = [];
    public array $collected_pages = [];

    public function addCollected(int $page, string $keys): void
    {
        $keys = json_decode($keys, true);
        $keys = array_map(fn ($v) => (string)$v, $keys);

        if (in_array($page, $this->collected_pages)) {
            $this->collected_pages = array_filter($this->collected_pages, fn ($val) => $val != $page);
            $this->collected = array_filter($this->collected, fn ($val) => !in_array($val, $keys));
            return;
        }

        $this->collected_pages[] = $page;
        $this->collected = array_unique(
            array_merge($keys, $this->collected)
        );
    }

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

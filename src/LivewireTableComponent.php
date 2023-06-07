<?php
namespace Nalletje\LivewireTables;

use Illuminate\Contracts\Foundation\Application as FoundationApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;
use Nalletje\LivewireTables\Traits\WithActions;
use Nalletje\LivewireTables\Traits\WithButtons;
use Nalletje\LivewireTables\Traits\WithColumns;
use Nalletje\LivewireTables\Traits\WithData;
use Nalletje\LivewireTables\Traits\WithFilters;
use Nalletje\LivewireTables\Traits\WithModel;
use Nalletje\LivewireTables\Traits\WithSearch;
use Nalletje\LivewireTables\Traits\WithSort;

class LivewireTableComponent extends Component
{
    use WithColumns, WithData, WithModel, WithSort;

    public bool $loader = true;

    public ?string $message = null;

    public int $page_limit = 20;

    protected string $paginationTheme = 'bootstrap';

    public function render(): View|Application|Factory|FoundationApplication
    {
        return view('nalletje_livewiretables::build', [
            'columns' => $this->getColumns(),
            'actions' => $this->hasActions() ? $this->actions() : [],
            'buttons' => $this->hasButtons() ? $this->buttons() : [],
            'filters' => $this->hasFilters() ? $this->getFilters() : [],
            'data' => $this->getData(),
            'loader' => $this->loader,
            'message' => $this->message,
            'show_filters' => $this->hasFilters() ? $this->show_filters : false,
            'sort_field' => $this->sort_field,
            'sort_dir' => $this->sort_dir,
            'selected_rows' => $this->hasActions() ? $this->collected : [],
            'selected_pages' => $this->hasActions() ? $this->collected_pages : [],
            'with_actions' => $this->hasActions(),
            'with_buttons' => $this->hasButtons(),
            'with_filters' => $this->hasFilters(),
            'with_search' => $this->hasSearch(),
        ]);
    }

    public function hasActions(): bool
    {
        return in_array(WithActions::class, class_uses($this));
    }

    public function hasButtons(): bool
    {
        return in_array(WithButtons::class, class_uses($this));
    }

    public function hasFilters(): bool
    {
        return in_array(WithFilters::class, class_uses($this));
    }

    public function hasSearch(): bool
    {
        return in_array(WithSearch::class, class_uses($this));
    }

    public function hasSort(): bool
    {
        return in_array(WithSearch::class, class_uses($this));
    }

    public function hasPagination(): bool
    {
        return in_array(WithPagination::class, class_uses($this));
    }

    public function resetLivewireTablePage(): void
    {
        if ($this->hasActions()) {
            $this->collected = [];
        }

        $this->resetPage();
    }
}

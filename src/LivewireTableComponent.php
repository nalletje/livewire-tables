<?php
namespace Nalletje\LivewireTables;

use Illuminate\Contracts\Foundation\Application as FoundationApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Nalletje\LivewireTables\Traits\WithActions;
use Nalletje\LivewireTables\Traits\WithButtons;
use Nalletje\LivewireTables\Traits\WithColumns;
use Nalletje\LivewireTables\Traits\WithData;
use Nalletje\LivewireTables\Traits\WithFilters;
use Nalletje\LivewireTables\Traits\WithFormData;
use Nalletje\LivewireTables\Traits\WithMessages;
use Nalletje\LivewireTables\Traits\WithModel;
use Nalletje\LivewireTables\Traits\WithPerPage;
use Nalletje\LivewireTables\Traits\WithSearch;
use Nalletje\LivewireTables\Traits\WithSort;

class LivewireTableComponent extends Component
{
    use WithColumns, WithData, WithFormData, WithModel, WithPerPage, WithSort, WithMessages;

    public bool $loader = true;

    protected string $paginationTheme = 'bootstrap';

    public function render(): View|Application|Factory|FoundationApplication
    {
        return view('nalletje_livewiretables::build', [
            'columns' => $this->getColumns(),
            'actions' => $this->hasActions() ? $this->getActions() : [],
            'action_with_form' => $this->hasActions() && !is_null($this->actionWithForm)
                ? $this->getActions()[$this->actionWithForm]
                : null,
            'buttons' => $this->hasButtons() ? $this->getButtons() : [],
            'button_with_form' => $this->hasButtons() && !is_null($this->buttonWithForm)
                ? $this->getButtons()[$this->buttonWithForm]
                : null,
            'filters' => $this->hasFilters() ? $this->getFilters() : [],
            'data' => $this->getData(),
            'loader' => $this->loader,
            'per_page_options' => $this->perPageOptions,
            'message' => $this->message,
            'message_type' => $this->message_type,
            'sort_field' => $this->sort_field,
            'sort_dir' => $this->sort_dir,
            'with_actions' => $this->hasActions(),
            'with_buttons' => $this->hasButtons(),
            'with_filters' => $this->hasFilters(),
            'with_search' => $this->hasSearch(),
        ]);
    }

    public function hasActions(): bool
    {
        return in_array(WithActions::class, class_uses($this)) && !empty($this->getActions());
    }

    public function hasButtons(): bool
    {
        return in_array(WithButtons::class, class_uses($this)) && !empty($this->getButtons());
    }

    public function hasFilters(): bool
    {
        return in_array(WithFilters::class, class_uses($this)) && !empty($this->getFilters());
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
            $this->selected = [];
            $this->selectAll = false;
        }

        $this->resetPage();
    }
}

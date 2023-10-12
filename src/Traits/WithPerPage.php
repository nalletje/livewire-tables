<?php
namespace Nalletje\LivewireTables\Traits;

use Livewire\Attributes\Url;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait WithPerPage
{
    #[Url]
    public int $perPage = 15;

    public array $perPageOptions = [
        10,
        15,
        25,
        50,
        100
    ];
}

<?php
namespace Nalletje\LivewireTables\Traits;

use Illuminate\Support\Collection;

trait WithMessages
{
    public ?string $message = null;

    // https://getbootstrap.com/docs/5.2/components/alerts/
    public string $message_type = "info"; // bootstrap alert classes success, danger, ...
}

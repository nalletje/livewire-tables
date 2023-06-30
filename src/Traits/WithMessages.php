<?php
namespace Nalletje\LivewireTables\Traits;

use Illuminate\Support\Collection;

trait WithMessages
{
    public ?string $message = null;

    // https://getbootstrap.com/docs/5.2/components/alerts/
    public string $message_type = "info"; // bootstrap alert classes success, danger, ...

    public function clearMessages(): void
    {
        $this->message = null;
    }

    public function setSuccessMessage($message): void
    {
        $this->message_type = 'success';
        $this->message = $message;
    }

    public function setErrorMessage($message): void
    {
        $this->message_type = 'danger';
        $this->message = $message;
    }
}

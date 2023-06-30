<?php
namespace Nalletje\LivewireTables\Objects;

class Message
{
    public function __construct(
        public string $message,
        // https://getbootstrap.com/docs/5.2/components/alerts/ - bootstrap alert classes success, danger, ...
        public string $message_type = "success"
    ) {}

    public static function make(string $message, string $type = 'success'): self
    {
        return (new self($message, $type));
    }

    public function message(): string
    {
        return $this->message;
    }

    public function type(): string
    {
        return $this->message_type;
    }
}

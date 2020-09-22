<?php
declare(strict_types=1);

class SMS
{
    protected $message;
    protected $sender;
    protected $recipient;


    /**
     * @param string $message
     */
    function setMessage(string $message) : void
    {
        $this->message = $message;
    }

    /**
     * @return string|null
     */
    function getMessage() : ?string
    {
        return $this->message;
    }

    /**
     * @param string $sender
     */
    function setSender(string $sender) : void
    {
        $this->sender = $sender;
    }

    /**
     * @return string|null
     */
    function getSender() : ?string
    {
        return $this->sender;
    }

    /**
     * @param string $recipient
     */
    function setRecipient(string $recipient) : void
    {
        $this->recipient = $recipient;
    }

    /**
     * @return string|null
     */
    function getRecipient() : ?string
    {
        return $this->recipient;
    }
}

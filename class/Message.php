<?php
class Message 
{
    const LIMIT_USERNAME = 3;
    const LIMIT_MESSAGE = 10;
    private $username;
    private $message;
    private $date;

    public function __construct(string $username, string $message, ?DateTime $date= null)
    {
        $this->username = $username;
        $this->message = $message;
        $this->date = $date ?:new DateTime();
    }

    public function isValid (): bool
    {
        return empty($this->getErrors());
    }

    public function getErrors(): array 
    {
        $errors = [];
        if (strlen($this->username) < self::LIMIT_USERNAME) {
            $errors['username'] = 'Votre pseudo est trop court';
        }
        if (strlen($this->message) < self::LIMIT_MESSAGE) {
            $errors['message'] = 'Votre message est trop court';
        }
        return $errors;
    }

    public function toJSON(): string 
    {
        return json_encode(
            [
            'username' => $this->username,
            'message' => $this->message,
            'date' => $this->date->getTimestamp()
            ]);
    }

}




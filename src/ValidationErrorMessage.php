<?php

namespace AsDh;

class ValidationErrorMessage
{
    private $response;

    public function __construct(array $response)
    {
        $this->response = $response;
    }

    public function get(): string
    {
        $message = str_replace(
            'this field',
            "the {$this->errorKey()} field",
            $this->errorMessage()
        );

        return ucfirst($message);
    }

    private function errorMessage(): string
    {
        $message = $this->response[$this->errorKey()][0];

        return strtolower($message);
    }

    private function errorKey(): string
    {
        return array_keys($this->response)[0];
    }
}

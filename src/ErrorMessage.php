<?php

namespace AsDh;

class ErrorMessage
{
    private $response;

    private $statusCode;

    public function __construct(?array $response, int $statusCode)
    {
        $this->response = $response;
        $this->statusCode = $statusCode;
    }

    public function get(): string
    {
        if($this->response === null) {
            return "No response from Khalti.";
        }

        switch ($this->statusCode) {
            case 401:
            case 405:
                return $this->response['detail'];
            case 400:
                if ($this->response['error_key'] === 'already_verified') {
                    return $this->response['detail'];
                }

                if ($this->response['error_key'] === 'validation_error') {
                    return (new ValidationErrorMessage($this->response))->get();
                }

                return "Unknown Error";
            default:
                return '';
        }
    }
}

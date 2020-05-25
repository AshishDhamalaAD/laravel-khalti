<?php

namespace AsDh;

class Khalti
{
    /** @var KhaltiHttp */
    private $response;

    private $token;

    private $amount;

    public function withToken(string $token)
    {
        $this->token = $token;

        return $this;
    }

    public function withAmount(int $amount)
    {
        $this->amount = $amount;

        return $this;
    }

    public function verify(): void
    {
        $this->response = (new KhaltiHttp())
            ->send([
                'token' => $this->token,
                'amount' => $this->amount,
            ]);
    }

    public function statusCode(): int
    {
        return $this->response->statusCode();
    }

    public function response(): ?array
    {
        return $this->response->json();
    }

    public function isVerified(): bool
    {
        return $this->statusCode() === 200;
    }

    public function hasError(): bool
    {
        return $this->statusCode() !== 200;
    }

    public function errorMessage(): string
    {
        return (new ErrorMessage($this->response(), $this->statusCode()))->get();
    }
}

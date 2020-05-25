<?php

namespace AsDh;

class KhaltiHttp
{
    private $response;

    private $statusCode;

    public function send(array $params)
    {
        $args = http_build_query($params);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, config('khalti.verification_url'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $headers = ['Authorization: Key ' . config('khalti.secret_key')];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $this->statusCode = $statusCode;
        $this->response = $response;

        return $this;
    }

    public function json(): ?array
    {
        return json_decode($this->response, true);
    }

    public function statusCode(): int
    {
        return $this->statusCode;
    }
}

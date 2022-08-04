<?php

namespace App\Services;

use App\Contracts\WebcheckoutContract;
use App\Requests\AuthRequestRequest;
use App\Requests\CreateSessionRequest;
use App\Requests\GetInformationRequest;
use App\Requests\InformationRequest;
use App\Requests\ProcessRequest;
use App\Requests\TransactionRequest;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class WebcheckoutService implements WebcheckoutContract
{
    public Client $client;
    public function __construct()
    {
        $this->client = new Client();
//        $this->client = app(ClientInterface::class);
    }

    public function getInformation(?int $session_id)
    {
        $getInformation = new GetInformationRequest();
        $data = $getInformation->auth();
        $url = $getInformation::url($session_id);
        return $this->request($data, $url);
    }

    public function createSession(array $data)
    {
        $createSessionRequest = new CreateSessionRequest($data);

        $data = $createSessionRequest->toArray();
        $url = $createSessionRequest::url(null);
        return $this->request($data, $url);
    }

    public function information(array $data)
    {
        $informationRequest = new InformationRequest($data);
        $data = $informationRequest->toArray();
        $url = $informationRequest::url(null);
        return $this->request($data, $url);
    }

    public function process(array $data)
    {
        $ProcessRequest = new ProcessRequest($data);
        $data = $ProcessRequest->toArray();
        $url = $ProcessRequest::url(null);
        return $this->request($data, $url);
    }

    public function transaction(array $data)
    {
        $TransactionRequest = new TransactionRequest($data);
        $data = $TransactionRequest->toArray();
        $url = $TransactionRequest::url(null);
        return $this->request($data, $url);
    }

    private function request(array $data, string $url)
    {
        $response = $this->client->request('post', $url, [
            'json' => $data,
            'verify' => false,
        ]);
        $content = $response->getBody()->getContents();
        return json_decode($content, true);
    }
}

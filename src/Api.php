<?php

declare(strict_types=1);

namespace Kuvardin\Firebase;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Api
 *
 * @package Kuvardin\Firebase
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Api
{
    public const HOST = 'https://fcm.googleapis.com';

    /**
     * @var Client GuzzleHttp client instance
     */
    protected Client $client;

    /**
     * @var string Firebase project ID
     */
    protected string $project_id;

    /**
     * @var string Firebase server secret key
     */
    protected string $server_key;

    /**
     * @var ResponseInterface|null Last response
     */
    public ?ResponseInterface $last_response = null;

    /**
     * Api constructor.
     *
     * @param Client $client
     * @param string $project_id
     * @param string $server_key
     */
    public function __construct(Client $client, string $project_id, string $server_key)
    {
        $this->client = $client;
        $this->project_id = $project_id;
        $this->server_key = $server_key;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return string
     */
    public function getProjectId(): string
    {
        return $this->project_id;
    }

    /**
     * @return string
     */
    public function getServerKey(): string
    {
        return $this->server_key;
    }

    /**
     * Send a message to specified target (a registration token, topic or condition).
     *
     * @param Models\Message $message Message to send.
     * @param bool $validate_only Flag for testing the request without actually delivering the message.
     * @return Models\MessageOutput
     * @throws Exceptions\ApiError
     * @throws GuzzleException
     */
    public function send(Models\Message $message, bool $validate_only = false): Models\MessageOutput
    {
        $response = $this->request('messages:send', [
            'validate_only' => $validate_only,
            'message' => $message,
        ]);
        return Models\MessageOutput::createFromResponse($response);
    }


    /**
     * @param string $method
     * @param array $data
     * @return array
     * @throws Exceptions\ApiError
     * @throws GuzzleException
     */
    public function request(string $method, array $data): array
    {
        $uri = self::HOST . "/v1/projects/{$this->project_id}/$method";
        $this->last_response = $this->client->post($uri, [
            RequestOptions::HEADERS => [
                'Content-Type' => 'application/json',
                'Authorization' => "key={$this->server_key}",
            ],
            RequestOptions::JSON => $data,
            RequestOptions::CONNECT_TIMEOUT => 7,
            RequestOptions::TIMEOUT => 20,
            RequestOptions::HTTP_ERRORS => false,
        ]);

        $content = $this->last_response->getBody()->getContents();
        $decoded = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        if (isset($decoded['error'])) {
            throw new Exceptions\ApiError(
                $decoded['error']['code'],
                $decoded['error']['status'],
                $decoded['error']['message']
            );
        }

        return $decoded;
    }
}

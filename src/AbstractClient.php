<?php

declare(strict_types=1);

namespace Balu\OneDriveSdk;

use Balu\OneDriveSdk\Exception\UnexpectedStatusCodeException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractClient
{
    public const ONE_GRAPH_URL = 'https://graph.microsoft.com/v1.0';

    protected ?Client $client = null;

    public function __construct(
        protected readonly string $clientId,
        protected readonly string $clientSecret,
        protected readonly string $tenantId
    ) {
        $this->client = new Client();
    }

    /**
     * @param string $url
     * @param array $options
     * @param string|null $token
     * @param array $expectedStatusCodes
     * @return array
     * @throws GuzzleException
     * @throws UnexpectedStatusCodeException
     */
    public function post(string $url, array $options, string $token = null, array $expectedStatusCodes = [200]): array
    {
        if ($token !== null) {
            $options = array_merge_recursive($options, $this->getAuthorizationHeader($token));
        }

        $response = $this->client->post($url, $options);
        return $this->parseResponse($response, $expectedStatusCodes);
    }

    /**
     * @param string $url
     * @param array $options
     * @param string|null $token
     * @param array $expectedStatusCodes
     * @return array
     * @throws GuzzleException
     * @throws UnexpectedStatusCodeException
     */
    public function patch(string $url, array $options, string $token = null, array $expectedStatusCodes = [200]): array
    {
        if ($token !== null) {
            $options = array_merge_recursive($options, $this->getAuthorizationHeader($token));
        }

        $response = $this->client->patch($url, $options);
        return $this->parseResponse($response, $expectedStatusCodes);
    }

    /**
     * @param string $url
     * @param array $options
     * @param string|null $token
     * @param array $expectedStatusCodes
     * @return array
     * @throws UnexpectedStatusCodeException
     * @throws GuzzleException
     */
    public function put(string $url, array $options, string $token = null, array $expectedStatusCodes = [200]): array
    {
        if ($token !== null) {
            $options = array_merge_recursive($options, $this->getAuthorizationHeader($token));
        }

        $response = $this->client->put($url, $options);
        return $this->parseResponse($response, $expectedStatusCodes);
    }

    /**
     * @param string $url
     * @param array $options
     * @param string|null $token
     * @param array $expectedStatusCodes
     * @return array
     * @throws GuzzleException
     * @throws UnexpectedStatusCodeException
     */
    public function get(string $url, array $options, string $token = null, array $expectedStatusCodes = [200]): array
    {
        if ($token !== null) {
            $options = array_merge_recursive($options, $this->getAuthorizationHeader($token));
        }

        $response = $this->client->get($url, $options);
        return $this->parseResponse($response, $expectedStatusCodes);
    }

    /**
     * @param ResponseInterface $response
     * @param array $expectedStatusCodes
     * @return array
     * @throws UnexpectedStatusCodeException
     */
    protected function parseResponse(ResponseInterface $response, array $expectedStatusCodes): array
    {
        if (!in_array($response->getStatusCode(), $expectedStatusCodes)) {
            throw new UnexpectedStatusCodeException(
                sprintf(
                    'Unexpected status code. Expected one of %s but %s given',
                    implode(',', $expectedStatusCodes),
                    $response->getStatusCode()
                ),
                1700499946
            );
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getAuthorizationHeader(string $token): array
    {
        return [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Host' => 'graph.microsoft.com',
            ],
        ];
    }
}

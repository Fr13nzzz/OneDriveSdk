<?php

declare(strict_types=1);

namespace Balu\OneDriveSdk;

use Balu\OneDriveSdk\Exception\UnexpectedStatusCodeException;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractClient
{
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
     * @param int $expectedStatusCode
     * @return array
     * @throws UnexpectedStatusCodeException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(string $url, array $options, int $expectedStatusCode = 200): array
    {
        $response = $this->client->post($url, $options);
        return $this->parseResponse($response, $expectedStatusCode);
    }

    /**
     * @param ResponseInterface $response
     * @param int $expectedStatusCode
     * @return array
     * @throws UnexpectedStatusCodeException
     */
    protected function parseResponse(ResponseInterface $response, int $expectedStatusCode): array
    {
        if ($response->getStatusCode() !== $expectedStatusCode) {
            throw new UnexpectedStatusCodeException(
                sprintf(
                    'Unexpected status code. Expected %s but %s given',
                    $expectedStatusCode,
                    $response->getStatusCode()
                ),
                1700499946
            );
        }

        return json_decode($response->getBody()->getContents(), true);
    }
}

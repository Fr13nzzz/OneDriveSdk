<?php

declare(strict_types=1);

namespace Balu\OneDriveSdk;

use Balu\OneDriveSdk\Exception\UnexpectedStatusCodeException;
use Balu\OneDriveSdk\Model\Enum\EndPoints\ResourceEndpointInterface;
use GuzzleHttp\Exception\GuzzleException;

abstract class ResourceClient extends AbstractClient
{
    private string $token;

    public function __construct(string $token, string $clientId, string $clientSecret, string $tenantId)
    {
        $this->token = $token;
        parent::__construct($clientId, $clientSecret, $tenantId);
    }

    /**
     * @param ResourceEndpointInterface $resourcePath
     * @param array $pathPlaceholderValues
     * @param array $options
     * @param array $queryParameters
     * @return array
     * @throws GuzzleException
     * @throws UnexpectedStatusCodeException
     */
    public function getByResourcePath(
        ResourceEndpointInterface $resourcePath,
        array $pathPlaceholderValues,
        array $options = [],
        array $queryParameters = []
    ): array {
        $requestUrl = $this->replaceUrlPlaceHolders($resourcePath->value, $pathPlaceholderValues);
        $requestUrl = $this->addQueryParameters($requestUrl, $queryParameters);
        return $this->get($requestUrl, $options, $this->token);
    }

    /**
     * @param ResourceEndpointInterface $resourcePath
     * @param array $pathPlaceholderValues
     * @param array $options
     * @param array $queryParameters
     * @param int $expectedStatusCode
     * @return array
     * @throws GuzzleException
     * @throws UnexpectedStatusCodeException
     */
    public function postByResourcePath(
        ResourceEndpointInterface $resourcePath,
        array $pathPlaceholderValues,
        array $options = [],
        array $queryParameters = [],
        int $expectedStatusCode = 200
    ): array {
        $requestUrl = $this->replaceUrlPlaceHolders($resourcePath->value, $pathPlaceholderValues);
        $requestUrl = $this->addQueryParameters($requestUrl, $queryParameters);
        return $this->post($requestUrl, $options, $this->token, $expectedStatusCode);
    }

    /**
     * @param ResourceEndpointInterface $resourcePath
     * @param array $pathPlaceholderValues
     * @param array $options
     * @param array $queryParameters
     * @param int $expectedStatusCode
     * @return array
     * @throws GuzzleException
     * @throws UnexpectedStatusCodeException
     */
    public function patchByResourcePath(
        ResourceEndpointInterface $resourcePath,
        array $pathPlaceholderValues,
        array $options = [],
        array $queryParameters = [],
        int $expectedStatusCode = 200
    ): array {
        $requestUrl = $this->replaceUrlPlaceHolders($resourcePath->value, $pathPlaceholderValues);
        $requestUrl = $this->addQueryParameters($requestUrl, $queryParameters);
        return $this->patch($requestUrl, $options, $this->token, $expectedStatusCode);
    }

    /**
     * @param string $resourcePath
     * @param array $pathPlaceholderValues
     * @return string
     */
    protected function replaceUrlPlaceHolders(string $resourcePath, array $pathPlaceholderValues): string
    {
        $requestUrl = self::ONE_GRAPH_URL . $resourcePath;
        foreach ($pathPlaceholderValues as $placeHolderName => $placeholderValue) {
            $requestUrl = str_replace("{{$placeHolderName}}", $placeholderValue, $requestUrl);
        }

        return $requestUrl;
    }

    /**
     * @param string $resourcePath
     * @param array $queryParameters
     * @return string
     */
    protected function addQueryParameters(string $resourcePath, array $queryParameters): string
    {
        $query = http_build_query($queryParameters, '', '&', PHP_QUERY_RFC3986);
        return $resourcePath . '?' . $query;
    }
}

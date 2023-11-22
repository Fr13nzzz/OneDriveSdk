<?php

declare(strict_types=1);

namespace Balu\OneDriveSdk;

use Balu\OneDriveSdk\Model\Enum\EndPoints\ResourceEndpointInterface;

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

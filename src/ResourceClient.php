<?php

declare(strict_types=1);

namespace Balu\OneDriveSdk;

use Balu\OneDriveSdk\Model\Enum\EndPoints\ResourceEndpointInterface;

class ResourceClient extends AbstractClient
{
    /**
     * @param ResourceEndpointInterface $resourcePath
     * @param array $pathPlaceholderValues
     * @param array $options
     * @param string $token
     * @return array
     */
    public function getByResourcePath(
        ResourceEndpointInterface $resourcePath,
        array $pathPlaceholderValues,
        array $options,
        string $token
    ): array {
        $requestUrl = $this->buildRequestUrl($resourcePath->value, $pathPlaceholderValues);
        return $this->get($requestUrl, $options, $token);
    }

    protected function buildRequestUrl(string $resourcePath, array $pathPlaceholderValues): string
    {
        $requestUrl = self::ONE_GRAPH_URL . $resourcePath;
        foreach ($pathPlaceholderValues as $placeHolderName => $placeholderValue) {
            $requestUrl = str_replace("{{$placeHolderName}}", $placeholderValue, $requestUrl);
        }

        return $requestUrl;
    }
}

<?php

declare(strict_types=1);

namespace Balu\OneDriveSdk;

use Balu\OneDriveSdk\Exception\UnexpectedJsonException;
use Balu\OneDriveSdk\Exception\UnexpectedStatusCodeException;
use Balu\OneDriveSdk\Factory\AccessTokenFactory;
use Balu\OneDriveSdk\Model\AccessToken;
use Balu\OneDriveSdk\Model\Enum\EndPoints\Authentication;
use Balu\OneDriveSdk\Model\Enum\OneDriveScope;
use GuzzleHttp\Exception\GuzzleException;

class AuthClient extends AbstractClient
{
    public const RAW_BASE_URL = 'https://login.microsoftonline.com/%s/oauth2/v2.0';

    public function __construct(string $clientId, string $clientSecret, string $tenantId = 'common')
    {
        parent::__construct($clientId, $clientSecret, $tenantId);
    }

    /**
     * @param OneDriveScope[] $scopes
     * @param string $redirectUri
     * @param array $additionalQueryParams
     * @return string
     */
    public function getLoginUrl(array $scopes, string $redirectUri, array $additionalQueryParams = []): string
    {
        $requestUrl = $this->getBaseUrl() . Authentication::AUTHORIZE->value;
        $queryParams = [
            'client_id' => $this->clientId,
            'response_type' => 'code',
            'redirect_uri'  => $redirectUri,
            'scope' => implode(' ', $scopes),
            'response_mode' => 'query',
        ];
        $mergedQueryParams = array_merge_recursive($queryParams, $additionalQueryParams);
        $query = http_build_query($mergedQueryParams, '', '&', PHP_QUERY_RFC3986);

        return $requestUrl . '?' . $query;
    }

    /**
     * @param string $redirectUri
     * @param string $code
     * @return AccessToken
     * @throws UnexpectedJsonException
     * @throws UnexpectedStatusCodeException
     * @throws GuzzleException
     */
    public function fetchAccessToken(string $redirectUri, string $code): AccessToken
    {
        $requestUrl = $this->getBaseUrl() . Authentication::TOKEN->value;
        $options = [
            'form_params' => [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'redirect_uri' => $redirectUri,
                'code' => $code,
                'grant_type' => 'authorization_code',
            ],
        ];

        $accessTokenFactory = new AccessTokenFactory();
        return $accessTokenFactory->fromJsonObject($this->post($requestUrl, $options));
    }

    public function refreshToken(string $redirectUri, string $refreshToken): AccessToken
    {
        $requestUrl = $this->getBaseUrl() . Authentication::TOKEN->value;
        $options = [
            'form_params' => [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'redirect_uri' => $redirectUri,
                'refresh_token' => $refreshToken,
                'grant_type' => 'refresh_token',
            ],
        ];

        $accessTokenFactory = new AccessTokenFactory();
        return $accessTokenFactory->fromJsonObject($this->post($requestUrl, $options));
    }

    /**
     * @return string
     */
    protected function getBaseUrl(): string
    {
        return sprintf(self::RAW_BASE_URL, $this->tenantId);
    }
}

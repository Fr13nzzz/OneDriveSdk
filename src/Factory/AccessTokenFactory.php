<?php

declare(strict_types=1);

namespace Balu\OneDriveSdk\Factory;

use Balu\OneDriveSdk\Model\AccessToken;

final class AccessTokenFactory
{
    public function fromJsonObject(array $jsonObject): AccessToken
    {
        return new AccessToken(
            $jsonObject['token_type'] ?? '',
            $jsonObject['expires_in'] ?? 0,
            $jsonObject['scope'] ?? '',
            $jsonObject['access_token'] ?? '',
            $jsonObject['refresh_token'] ?? '',
        );
    }
}

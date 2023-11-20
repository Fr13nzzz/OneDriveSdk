<?php

declare(strict_types=1);

namespace Balu\OneDriveSdk\Factory;

use Balu\OneDriveSdk\Exception\UnexpectedJsonException;
use Balu\OneDriveSdk\Model\AccessToken;

final class AccessTokenFactory
{
    public function fromJsonObject(array $jsonObject): AccessToken
    {
        return new AccessToken(
            $jsonObject['token_type'] ?? throw new UnexpectedJsonException('Missing key', 1700500686),
            $jsonObject['expires_in'] ?? throw new UnexpectedJsonException('Missing key', 1700500700),
            $jsonObject['scope'] ?? throw new UnexpectedJsonException('Missing key', 1700500705),
            $jsonObject['access_token'] ?? throw new UnexpectedJsonException('Missing key', 1700500709),
            $jsonObject['refresh_token'] ?? '',
        );
    }
}

<?php

declare(strict_types=1);

namespace Balu\OneDriveSdk\Model;

class AccessToken
{
    public function __construct(
        private readonly string $tokenType,
        private readonly int $expiresIn,
        private readonly string $scope,
        private readonly string $accessToken,
        private readonly string $refreshToken
    ) {
    }

    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    public function getScope(): string
    {
        return $this->scope;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }
}

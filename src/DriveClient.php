<?php

declare(strict_types=1);

namespace Balu\OneDriveSdk;

use Balu\OneDriveSdk\Model\Enum\EndPoints\Drive;

class DriveClient extends ResourceClient
{
    public function getCurrent(array $options = [], array $queryParameters = []): array
    {
        return $this->getByResourcePath(Drive::ME_DRIVE, [], $options, $queryParameters);
    }

    public function list(array $options = [], array $queryParameters = []): array
    {
        return $this->getByResourcePath(Drive::ME_DRIVES, [], $options, $queryParameters);
    }

    public function getById(string $id, array $options = [], array $queryParameters = []): array
    {
        return $this->getByResourcePath(Drive::DRIVE_BY_ID, ['drive-id' => $id], $options, $queryParameters);
    }

    public function getBySpecialId(string $id, array $options = [], array $queryParameters = []): array
    {
        return $this->getByResourcePath(
            Drive::DRIVE_BY_SPECIAL_ID,
            ['special-id' => $id],
            $options,
            $queryParameters
        );
    }

    public function getByUserId(string $id, array $options = [], array $queryParameters = []): array
    {
        return $this->getByResourcePath(
            Drive::DRIVE_BY_USER_ID,
            ['user-id' => $id],
            $options,
            $queryParameters
        );
    }
}

<?php

declare(strict_types=1);

namespace Balu\OneDriveSdk\Model\Enum\EndPoints;

enum Drive: string implements ResourceEndpointInterface
{
    case ME_DRIVE = '/me/drive';
    case ME_DRIVES = '/me/drives';
    case DRIVE_BY_ID = '/drives/{drive-id}';
    case DRIVE_BY_SPECIAL_ID = '/me/drive/special/{special-id}';
    case DRIVE_BY_USER_ID = '/users/{user-id}/drive';
}

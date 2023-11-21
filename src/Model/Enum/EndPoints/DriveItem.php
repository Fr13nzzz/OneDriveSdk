<?php

declare(strict_types=1);

namespace Balu\OneDriveSdk\Model\Enum\EndPoints;

enum DriveItem: string implements ResourceEndpointInterface
{
    case BY_ITEM_ID = '/drive/items/{item-id}/content';
    case BY_DRIVE_AND_ITEM_ID = '/drives/{drive-id}/items/{item-id}/content';
}
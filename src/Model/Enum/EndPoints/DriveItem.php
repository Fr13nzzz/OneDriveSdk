<?php

declare(strict_types=1);

namespace Balu\OneDriveSdk\Model\Enum\EndPoints;

enum DriveItem: string implements ResourceEndpointInterface
{
    case ITEM = '/drives/{drive-id}/items/{item-id}';
    case ITEM_COPY = '/drives/{drive-id}/items/{item-id}/copy';
    case CHILDREN = '/drives/{drive-id}/items/{item-id}/children';
    case LIST_VERSIONS = '/drives/{drive-id}/items/{item-id}/versions';
    case BY_ITEM_ID = '/drive/items/{item-id}/content';
    case BY_DRIVE_AND_ITEM_ID = '/drives/{drive-id}/items/{item-id}/content';
}
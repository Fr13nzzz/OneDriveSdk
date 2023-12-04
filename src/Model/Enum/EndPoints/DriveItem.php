<?php

declare(strict_types=1);

namespace Balu\OneDriveSdk\Model\Enum\EndPoints;

enum DriveItem: string implements ResourceEndpointInterface
{
    case ITEM = '/drives/{drive-id}/items/{item-id}';
    case ITEM_COPY = '/drives/{drive-id}/items/{item-id}/copy';
    case CHILDREN = '/drives/{drive-id}/items/{item-id}/children';
    case LIST_VERSIONS = '/drives/{drive-id}/items/{item-id}/versions';
    case NEW_ITEM_CONTENT = '/drives/{drive-id}/items/{parent-id}:/{filename}:/content';
    case ITEM_CONTENT = '/drives/{drive-id}/items/{item-id}/content';
}
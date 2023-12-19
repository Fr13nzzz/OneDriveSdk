<?php

declare(strict_types=1);

namespace Balu\OneDriveSdk\Model\Enum\EndPoints;

enum AppFolder: string implements ResourceEndpointInterface
{
    case ROOT = '/drive/special/approot';
    case ROOT_CHILDREN = '/drive/special/approot/children';
    case ITEM = '/drive/special/approot:/{filename}';
    case CONTENT = '/drive/special/approot:/{filename}:/content';
}

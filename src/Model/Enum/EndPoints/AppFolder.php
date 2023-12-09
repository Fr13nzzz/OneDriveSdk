<?php

declare(strict_types=1);

namespace Balu\OneDriveSdk\Model\Enum\EndPoints;

enum AppFolder implements ResourceEndpointInterface: string
{
    case ROOT = '/drive/special/approot';
    case ROOT_CHILDREN = '/drive/special/approot/children';
    case ITEM = '/drive/special/approot:/{fileName}';
    case CONTENT = '/drive/special/approot:/{fileName}:/content';
}

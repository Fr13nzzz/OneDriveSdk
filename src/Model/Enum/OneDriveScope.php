<?php

declare(strict_types=1);

namespace Balu\OneDriveSdk\Model\Enum;

enum OneDriveScope: string
{
    case READ_FILES = 'Files.Read';
    case READ_FILES_ALL = 'Files.Read.All';
    case READ_WRITE_FILES = 'Files.ReadWrite';
    case READ_WRITE_FILES_ALL = 'Files.ReadWrite.All';
    case READ_WRITE_FILES_APP_FOLDER = 'Files.ReadWrite.AppFolder';
    case READ_FILES_SELECTED = 'Files.Read.Selected';
    case READ_WRITE_FILES_SELECTED = 'Files.ReadWrite.Selected';
    case OFFLINE_ACCESS = 'offline_access';
}

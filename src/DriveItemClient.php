<?php

declare(strict_types=1);

namespace Balu\OneDriveSdk;

use Balu\OneDriveSdk\Model\Enum\EndPoints\DriveItem;

class DriveItemClient extends ResourceClient
{
    public function getItem(string $driveId, string $itemId, array $options = [], array $queryParameters = []): array
    {
        return $this->getByResourcePath(
            DriveItem::ITEM,
            ['drive-id' => $driveId, 'item-id' => $itemId],
            $options,
            $queryParameters
        );
    }

    public function listChildren(string $driveId, string $itemId, array $options = [], array $queryParameters = []): array
    {
        return $this->getByResourcePath(
            DriveItem::CHILDREN,
            ['drive-id' => $driveId, 'item-id' => $itemId],
            $options,
            $queryParameters
        );
    }

    public function listVersions(string $driveId, string $itemId, array $options = [], array $queryParameters = []): array
    {
        return $this->getByResourcePath(
            DriveItem::LIST_VERSIONS,
            ['drive-id' => $driveId, 'item-id' => $itemId],
            $options,
            $queryParameters
        );
    }

    public function create(string $driveId, string $parentId, array $jsonPayload, array $options = [], array $queryParameters = []): array
    {
        $options = array_merge_recursive(['headers' => ['Content-Type' => 'application/json']], $options);
        $options = array_merge_recursive(['body' => json_encode($jsonPayload)], $options);

        return $this->postByResourcePath(
            DriveItem::CHILDREN,
            ['drive-id' => $driveId, 'item-id' => $parentId],
            $options,
            $queryParameters,
            201
        );
    }

    public function update(string $driveId, string $parentId, array $jsonPayload, array $options = [], array $queryParameters = []): array
    {
        $options = array_merge_recursive(['headers' => ['Content-Type' => 'application/json']], $options);
        $options = array_merge_recursive(['body' => json_encode($jsonPayload)], $options);

        return $this->patchByResourcePath(
            DriveItem::ITEM,
            ['drive-id' => $driveId, 'item-id' => $parentId],
            $options,
            $queryParameters
        );
    }

    public function copy(string $driveId, string $parentId, array $jsonPayload, array $options = [], array $queryParameters = []): array
    {
        $options = array_merge_recursive(['headers' => ['Content-Type' => 'application/json']], $options);
        $options = array_merge_recursive(['body' => json_encode($jsonPayload)], $options);

        return $this->postByResourcePath(
            DriveItem::ITEM_COPY,
            ['drive-id' => $driveId, 'item-id' => $parentId],
            $options,
            $queryParameters,
            202
        );
    }

    public function uploadFile(
        string $driveId,
        string $parentId,
        string $fileName,
        string $content,
        array $options = [],
        array $queryParameters = []
    ): array {
        $options = array_merge_recursive(['contents' => $content], $options);

        return $this->putByResourcePath(
            DriveItem::NEW_ITEM_CONTENT,
            ['drive-id' => $driveId, 'parent-id' => $parentId, 'filename' => $fileName],
            $options,
            $queryParameters,
            201
        );
    }

    public function uploadToExistingFile(
        string $driveId,
        string $parentId,
        string $content,
        array $options = [],
        array $queryParameters = []
    ): array {
        $options = array_merge_recursive(['contents' => $content], $options);

        return $this->putByResourcePath(
            DriveItem::ITEM_CONTENT,
            ['drive-id' => $driveId, 'parent-id' => $parentId],
            $options,
            $queryParameters,
            201
        );
    }
}

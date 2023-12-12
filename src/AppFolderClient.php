<?php

declare(strict_types=1);

namespace Balu\OneDriveSdk;

use Balu\OneDriveSdk\Model\Enum\EndPoints\AppFolder;

class AppFolderClient extends ResourceClient
{
    public function getItem(string $fileName, array $options = [], array $queryParameters = []): array
    {
        return $this->getByResourcePath(
            AppFolder::ITEM,
            ['fileName' => $fileName],
            $options,
            $queryParameters
        );
    }

    public function create(string $fileName, array $jsonPayload, array $options = [], array $queryParameters = []): array
    {
        $options = array_merge_recursive(['headers' => ['Content-Type' => 'application/json']], $options);
        $options = array_merge_recursive(['body' => json_encode($jsonPayload)], $options);

        return $this->postByResourcePath(
            AppFolder::ITEM,
            ['fileName' => $fileName],
            $options,
            $queryParameters,
            [201]
        );
    }

    public function createAppRootFolder(array $jsonPayload, array $options = [], array $queryParameters = []): array
    {
        $options = array_merge_recursive(['headers' => ['Content-Type' => 'application/json']], $options);
        $options = array_merge_recursive(['body' => json_encode($jsonPayload)], $options);

        return $this->postByResourcePath(
            AppFolder::ROOT_CHILDREN,
            $options,
            $queryParameters,
            [201]
        );
    }

    public function uploadFile(
        string $fileName,
        string $content,
        array $options = [],
        array $queryParameters = []
    ): array {
        $options = array_merge_recursive(['body' => $content], $options);

        return $this->putByResourcePath(
            AppFolder::CONTENT,
            ['filename' => $fileName],
            $options,
            $queryParameters,
            [200, 201]
        );
    }
}

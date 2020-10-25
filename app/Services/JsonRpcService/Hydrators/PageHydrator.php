<?php


namespace App\Services\JsonRpcService\Hydrators;


use App\Services\JsonRpcService\DTO\PageDTO;

class PageHydrator
{
    /**
     * @param PageDTO $pageDTO
     * @return array
     */
    public function extract(PageDTO $pageDTO): array
    {
        return [
            'uid' => $pageDTO->getPageUID(),
            'name' => $pageDTO->getName(),
            'author' => $pageDTO->getAuthor(),
            'created' => $pageDTO->getCreateAt()->format('Y-m-d H:i:s'),
        ];
    }
}

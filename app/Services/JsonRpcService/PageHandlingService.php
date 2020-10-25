<?php


namespace App\Services\JsonRpcService;

use App\Exceptions\JsonRpcException;
use App\Services\JsonRpcService\DTO\PageDTO;
use App\Services\JsonRpcService\DTO\PageUID;

class PageHandlingService extends JsonRpcService
{
    /**
     * @param string $pageUID
     * @return PageDTO
     * @throws JsonRpcException
     * @throws \Exception
     */
    public function getPageByUID(string $pageUID): PageDTO
    {
        $rpcResponse = $this->getClient()->callMethod('getPageByUID', ['page_uid' => $pageUID]);
        $this->checkResponse($rpcResponse);

        $result = $rpcResponse->getResult();
        $id = $result['id'] ?? null;
        $name = $result['name'] ?? '';
        $author = $result['author'] ?? '';
        $pageID = $result['page_uid'] ?? null;
        $createAt = new \DateTimeImmutable($result['created_at']);
        $updateAt = new \DateTimeImmutable($result['updated_at']);
        return new PageDTO($id, $name, $author, $pageID, $createAt, $updateAt);
    }

    /**
     * @param string $name
     * @param string $author
     * @return PageUID
     * @throws JsonRpcException
     */
    public function addPage(string $name, string $author): PageUID
    {
        $rpcResponse = $this->getClient()->callMethod('addPage', [
            'name' => $name,
            'author' => $author,
        ]);

        $this->checkResponse($rpcResponse);

        $result = $rpcResponse->getResult();
        return new PageUID($result['page_uid']);
    }
}

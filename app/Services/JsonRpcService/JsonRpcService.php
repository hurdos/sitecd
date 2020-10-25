<?php


namespace App\Services\JsonRpcService;

use App\Exceptions\JsonRpcException;

class JsonRpcService
{
    /**
     * @var JsonRpcClientInterface
     */
    protected $client;

    /**
     * JsonRpcService constructor.
     * @param JsonRpcClientInterface $client
     */
    public function __construct(JsonRpcClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return JsonRpcClientInterface
     */
    protected function getClient(): JsonRpcClientInterface
    {
        return $this->client;
    }

    /**
     * @param JsonRpcResponse $rpcResponse
     * @throws JsonRpcException
     */
    protected function checkResponse(JsonRpcResponse $rpcResponse): void
    {
        if ($rpcResponse->isError()) {
            $error = $rpcResponse->getError();
            throw new JsonRpcException($error->getMessage(), $error->getCode());
        }

        if (!$rpcResponse->getResult()) {
            throw new JsonRpcException('No result');
        }
    }
}

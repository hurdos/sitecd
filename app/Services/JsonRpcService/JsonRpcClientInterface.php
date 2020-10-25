<?php


namespace App\Services\JsonRpcService;

interface JsonRpcClientInterface
{
    public const PROTOCOL_VERSION_2 = '2.0';

    public function callMethod (string $methodName, array $params = []): JsonRpcResponse;
}

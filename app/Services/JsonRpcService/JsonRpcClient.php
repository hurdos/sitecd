<?php


namespace App\Services\JsonRpcService;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

class JsonRpcClient implements JsonRpcClientInterface
{
    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var string
     */
    protected $url;

    /**
     * JsonRpcClient constructor.
     * @param HttpClient $httpClient
     * @param string $url
     */
    public function __construct(HttpClient $httpClient, string $url)
    {
        $this->httpClient = $httpClient;
        $this->url = $url;
    }

    /**
     * @param string $methodName
     * @param array $params
     * @return JsonRpcResponse
     * @throws \Psr\Http\Client\ClientExceptionInterface
     * @throws \Exception
     */
    public function callMethod(string $methodName, array $params = []): JsonRpcResponse
    {
        $id = $this->generateId();
        $body = json_encode([
            'jsonrpc' => JsonRpcClientInterface::PROTOCOL_VERSION_2,
            'method' => $methodName,
            'params' => $params,
            'id' => $id,
        ], JSON_THROW_ON_ERROR);
        $request = new Request('POST', $this->url, [], $body);

        $response = $this->httpClient->sendRequest($request);
        // @TODO Is there need error if requestID !== responseID?
        return $this->parseResponse($response);
    }

    /**
     * @param ResponseInterface $response
     * @return JsonRpcResponse
     */
    protected function parseResponse(ResponseInterface $response): JsonRpcResponse
    {
        $content = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        // @TODO Is there need error if requestJsonrpc !== responseJsonrpc?
        $jsonrpc = $content['jsonrpc'] ?? null;
        $result = $content['result'] ?? null;
        $id = $content['id'] ?? null;
        $error = null;
        if (isset($content['error'])) {
            $message = $content['error']['message'] ?? null;
            $code = $content['error']['code'] ?? null;
            $error = new JsonRpcError($message, $code);
        }

        return new JsonRpcResponse($jsonrpc, $result, $error, $id);
    }

    /**
     * @return string
     * @throws \Exception
     */
    protected function generateId(): string
    {
        return (new\DateTime('now'))->format('YmdHisu');
    }
}

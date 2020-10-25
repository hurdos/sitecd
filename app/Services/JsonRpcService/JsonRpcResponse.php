<?php


namespace App\Services\JsonRpcService;


class JsonRpcResponse
{
    /**
     * @var string
     */
    protected $jsonrpc;

    /**
     * @var array|null
     */
    protected $result;

    /**
     * @var string|null
     */
    protected $id;

    /**
     * @var JsonRpcError|null
     */
    protected $error;

    /**
     * JsonRpcResponse constructor.
     *
     * @param string $jsonrpc
     * @param array|null $result
     * @param JsonRpcError|null $error
     * @param string|null $id
     */
    public function __construct(string $jsonrpc, array $result = null, JsonRpcError $error = null, string $id = null)
    {
        $this->jsonrpc = $jsonrpc;
        $this->result = $result;
        $this->error = $error;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getJsonrpc(): string
    {
        return $this->jsonrpc;
    }

    /**
     * @return array|null
     */
    public function getResult():? array
    {
        return $this->result;
    }

    /**
     * @return string|null
     */
    public function getId():? string
    {
        return $this->id;
    }

    /**
     * @return JsonRpcError|null
     */
    public function getError():? JsonRpcError
    {
        return $this->error;
    }

    /**
     * @return bool
     */
    public function isError(): bool
    {
        return isset($this->error);
    }
}

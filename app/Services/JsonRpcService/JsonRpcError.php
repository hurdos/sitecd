<?php


namespace App\Services\JsonRpcService;


class JsonRpcError
{
    /**
     * @var int
     */
    protected $code;

    /**
     * @var string
     */
    protected $message;

    /**
     * JsonRpcError constructor.
     *
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message, int $code)
    {
        $this->message = $message;
        $this->code = $code;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}

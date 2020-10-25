<?php


namespace App\Services\JsonRpcService\DTO;

class PageUID
{
    /**
     * @var string
     */
    protected $uid;

    /**
     * PageUID constructor.
     * @param string $uid
     */
    public function __construct(string $uid)
    {
        $this->uid = $uid;
    }

    /**
     * @return string
     */
    public function getUid(): string
    {
        return $this->uid;
    }
}

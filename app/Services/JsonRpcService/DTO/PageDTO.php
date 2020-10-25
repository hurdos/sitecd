<?php


namespace App\Services\JsonRpcService\DTO;

class PageDTO
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $author;

    /**
     * @var string
     */
    protected $pageUID;

    /**
     * @var \DateTimeImmutable
     */
    protected $createAt;

    /**
     * @var \DateTimeImmutable
     */
    protected $updateAt;

    /**
     * PageDTO constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $author
     * @param string $pageUID
     * @param \DateTimeImmutable $createAt
     * @param \DateTimeImmutable $updateAt
     */
    public function __construct(int $id, string $name, string $author, string $pageUID, \DateTimeImmutable $createAt, \DateTimeImmutable $updateAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->author = $author;
        $this->pageUID = $pageUID;
        $this->createAt = $createAt;
        $this->updateAt = $updateAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getPageUID(): string
    {
        return $this->pageUID;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreateAt(): \DateTimeImmutable
    {
        return $this->createAt;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getUpdateAt(): \DateTimeImmutable
    {
        return $this->updateAt;
    }
}

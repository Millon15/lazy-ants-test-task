<?php
declare(strict_types=1);

namespace src\Entity;

class BaseRequest
{
    /** @var string */
    protected string $productName;

    /**
     * BaseRequest constructor.
     *
     * @param string $productName
     */
    public function __construct(string $productName)
    {
        $this->productName = ucfirst($productName);
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }
}

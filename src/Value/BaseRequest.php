<?php
declare(strict_types=1);

namespace src\Value;

class BaseRequest
{
    /**
     * @var string
     */
    protected string $productName;

    /**
     * @var array
     */
    protected array $additionalIngredients;

    /**
     * BaseRequest constructor.
     *
     * @param string $productName
     * @param array  $additionalIngredients
     */
    public function __construct(string $productName, array $additionalIngredients = [])
    {
        $this->productName = $productName;
        $this->additionalIngredients = $additionalIngredients;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @return array
     */
    public function getAdditionalIngredients(): array
    {
        return $this->additionalIngredients;
    }
}

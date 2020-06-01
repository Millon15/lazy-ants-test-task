<?php
declare(strict_types=1);

namespace src\Entity;

abstract class BaseProduct
{
    public const NAME_PANCAKE = 'pancake';
    public const NAME_AMERICANO = 'americano';

    /**
     * @var array
     */
    protected array $ingredients = [];

    /**
     * @return string
     */
    abstract public function getName(): string;

    /**
     * @return array
     */
    abstract public function getReceiptIngredients(): array;

    /**
     * @return bool
     * @noinspection PhpUnused
     * @noinspection MultipleReturnStatementsInspection
     */
    public function isCompleted(): bool
    {
        if (\count($this->getReceiptIngredients()) !== \count($this->ingredients)) {
            return false;
        }

        foreach ($this->getReceiptIngredients() as $ingredientName => $className) {
            if (! isset($this->getIngredients()[$ingredientName])
                || $className !== \get_class($this->getIngredients()[$ingredientName])
            ) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return array
     */
    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    /**
     * @param array $ingredients
     *
     * @return BaseProduct
     */
    public function setIngredients(array $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }
}

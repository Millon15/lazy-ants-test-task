<?php
declare(strict_types=1);

namespace src\Entity;

use src\Value\BaseRequest;
use src\Exception\ManufactureException;

abstract class BaseProduct
{
    public const NAME_PANCAKE = 'pancake';
    public const NAME_AMERICANO = 'americano';

    protected array $ingredients = [];

    protected array $receiptIngredients = [];

    protected array $possibleAdditionalIngredients = [];

    /**
     * BaseProduct constructor.
     *
     * @param null|BaseRequest $request
     *
     * @throws ManufactureException
     */
    public function __construct(?BaseRequest $request = null)
    {
        if (! $request
            || ! $this->possibleAdditionalIngredients
            || ! $request->getAdditionalIngredients()
        ) {
            return;
        }

        $possibleAdditionalIngredientsNames = \array_keys($this->possibleAdditionalIngredients);
        foreach ($request->getAdditionalIngredients() as $additionalIngredient) {
            if (\in_array($additionalIngredient, $possibleAdditionalIngredientsNames, true)) {
                $this->receiptIngredients[$additionalIngredient]
                    = $this->possibleAdditionalIngredients[$additionalIngredient];
            } else {
                throw new ManufactureException(
                    "cannot cook {$request->getProductName()} with \"$additionalIngredient\" as additional ingredient",
                    -3
                );
            }
        }
    }

    abstract public function getName(): string;

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

    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    public function setIngredients(array $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }
}

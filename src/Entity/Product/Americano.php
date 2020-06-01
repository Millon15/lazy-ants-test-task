<?php
declare(strict_types=1);

namespace src\Entity\Product;

use src\Value\BaseRequest;
use src\Entity\BaseIngredient;
use src\Entity\BaseProduct;
use src\Entity\Ingredient\Sugar;
use src\Entity\Ingredient\Water;
use src\Entity\Ingredient\Coffee;

class Americano extends BaseProduct
{
    public function __construct(?BaseRequest $request = null)
    {
        $this->receiptIngredients = [
            BaseIngredient::NAME_COFFEE => Coffee::class,
            BaseIngredient::NAME_WATER => Water::class,
        ];
        $this->possibleAdditionalIngredients = [
            BaseIngredient::NAME_SUGAR => Sugar::class,
        ];

        parent::__construct($request);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::NAME_AMERICANO;
    }

    /**
     * @return array
     */
    public function getReceiptIngredients(): array
    {
        return $this->receiptIngredients;
    }
}

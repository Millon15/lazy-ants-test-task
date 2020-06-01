<?php
declare(strict_types=1);

namespace src\Entity\Product;

use src\Entity\BaseIngredient;
use src\Entity\BaseProduct;
use src\Entity\Ingredient\Sugar;
use src\Entity\Ingredient\Water;
use src\Entity\Ingredient\Coffee;

class Americano extends BaseProduct
{
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
        return [
            BaseIngredient::NAME_COFFEE => Coffee::class,
            BaseIngredient::NAME_WATER => Water::class,
            BaseIngredient::NAME_SUGAR => Sugar::class,
        ];
    }
}

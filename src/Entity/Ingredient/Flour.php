<?php
declare(strict_types=1);

namespace src\Entity\Ingredient;

use src\Entity\BaseIngredient;

class Flour extends BaseIngredient
{
    public function getName(): string
    {
        return self::NAME_FLOUR;
    }
}

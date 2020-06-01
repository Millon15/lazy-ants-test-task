<?php
declare(strict_types=1);

namespace src\Entity;

abstract class BaseIngredient
{
    public const NAME_EGG = 'egg';
    public const NAME_MILK = 'milk';
    public const NAME_WATER = 'water';
    public const NAME_FLOUR = 'floor';
    public const NAME_SUGAR = 'sugar';
    public const NAME_COFFEE = 'coffee';

    /**
     * @return string
     */
    abstract public function getName(): string;
}

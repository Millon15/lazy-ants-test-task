<?php
declare(strict_types=1);

namespace src\Command;

use src\Entity\BaseProduct;

class PancakeCommand extends BaseCommand
{
    public function __construct()
    {
        $this->acceptAdditionalIngredients = false;

        parent::__construct(BaseProduct::NAME_PANCAKE);
    }
}

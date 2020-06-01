<?php
declare(strict_types=1);

namespace src\Command;

use src\Entity\BaseProduct;
use Symfony\Component\Console\Input\InputArgument;

class AmericanoCommand extends BaseCommand
{
    public function __construct()
    {
        $this->acceptAdditionalIngredients = true;

        parent::__construct(BaseProduct::NAME_AMERICANO);
    }
}

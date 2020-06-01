<?php
declare(strict_types=1);

namespace src\Manufacture;

use src\Value\BaseRequest;

interface ManufactureInterface
{
    public function produce(BaseRequest $request);
}

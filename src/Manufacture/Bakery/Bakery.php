<?php
declare(strict_types=1);

namespace src\Manufacture\Bakery;

use src\Entity\BaseRequest;
use src\Exception\ManufactureException;
use src\Manufacture\ManufactureInterface;

class Bakery implements ManufactureInterface
{
    /**
     * @param BaseRequest $request
     *
     * @throws ManufactureException
     */
    public function produce(BaseRequest $request): void
    {
        try {
            $productName = "\\src\\Entity\\Product\\{$request->getProductName()}";
            $product = new $productName();
        } catch (\Throwable $e) {
            throw new ManufactureException('bad product name provided', $e->getCode(), $e);
        }

        // try {
        //     $productIngridientsReflection = new \ReflectionProperty($product, 'ingredients');
        //     $productIngridientsReflection->setValue($product, $product->getReceiptIngredients());
        // } catch (\ReflectionException $e) {
        //     throw new ManufactureException('cannot mix-up ingredients for the product', $e->getCode(), $e);
        // }

        try {
            $product->setIngredients(
                \array_map(fn($cls) => new $cls(), $product->getReceiptIngredients())
            );
        } catch (\Throwable $e) {
            throw new ManufactureException('bad product receipt, cannot mix-up some ingredients for the product', $e->getCode(), $e);
        }

        if (! $product->isCompleted()) {
            throw new ManufactureException('bad product receipt', 123);
        }
    }
}

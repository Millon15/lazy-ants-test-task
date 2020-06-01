<?php
declare(strict_types=1);

namespace src\Command;

use src\Value\BaseRequest;
use src\Manufacture\Bakery\Bakery;
use src\Exception\ManufactureException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class BaseCommand extends Command
{
    protected bool $acceptAdditionalIngredients = false;

    protected string $errorMessageStart;

    public function __construct(string $name)
    {
        $this->errorMessageStart = "$name was not completed because of";

        parent::__construct($name);
    }

    /**
     * @noinspection PhpMissingParentCallCommonInspection
     */
    protected function configure(): void
    {
        $this->setDescription("Order some {$this->getName()}");

        if ($this->acceptAdditionalIngredients) {
            $this->addArgument(
                'with',
                InputArgument::OPTIONAL,
                '"with" keyword'
            )->addArgument(
                'additional_ingredients',
                InputArgument::IS_ARRAY,
                "additional ingredients to {$this->getName()}"
            );
        }
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     * @noinspection PhpMissingParentCallCommonInspection
     * @noinspection BadExceptionsProcessingInspection
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->validate($input);
        } catch (ManufactureException $e) {
            $output->writeln($e->getMessage());

            return -1;
        }

        try {
            $additionalIngredients = $input->getArgument('additional_ingredients');
        } catch (InvalidArgumentException $e) {
            $additionalIngredients = [];
        }

        $request = new BaseRequest($this->getName(), $additionalIngredients);

        try {
            (new Bakery())->produce($request);
            if ($additionalIngredients) {
                $output->writeln(
                    "{$this->getName()} with "
                    . implode(', ', $additionalIngredients)
                    . ' completed'
                );
            } else {
                $output->writeln("{$this->getName()} completed");
            }
        } catch (ManufactureException $e) {
            $output->writeln("{$this->errorMessageStart} {$e->getMessage()}");
        } catch (\Throwable $e) {
            $output->writeln("{$this->errorMessageStart} undefined error in manufacture process");
        } finally {
            if (isset($e)) {
                return empty($e->getCode())
                    ? 1
                    : (int)$e->getCode();
            }
        }

        return 0;
    }

    /**
     * @param InputInterface $input
     *
     * @throws ManufactureException
     */
    protected function validate(InputInterface $input): void
    {
        try {
            $firstArgument = $input->getArgument('with');
            $additionalIngredients = $input->getArgument('additional_ingredients');
        } catch (InvalidArgumentException $e) {
            return;
        }

        if (! $this->acceptAdditionalIngredients || ! $firstArgument) {
            return;
        }

        if ('with' !== $firstArgument) {
            throw new ManufactureException(
                "{$this->errorMessageStart} incorrect additional ingredients provided"
                . PHP_EOL
                . 'Hint: if you want to order a product which may contain some additional ingredients'
                . ' you have to provide it after "with" keyword'
                . PHP_EOL
                . 'i. e. "./order americano with sugar", where americano is the product'
                . ', sugar is one of possible additional ingredients',
                -1
            );
        }

        if (! $additionalIngredients) {
            throw new ManufactureException(
                "{$this->errorMessageStart} bad number of additional ingredients provided"
                . ', expected at least 1 got 0',
                -2
            );
        }
    }
}

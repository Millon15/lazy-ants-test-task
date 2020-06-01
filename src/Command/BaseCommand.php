<?php
declare(strict_types=1);

namespace src\Command;

use src\Entity\BaseRequest;
use src\Manufacture\Bakery\Bakery;
use src\Exception\ManufactureException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BaseCommand extends Command
{
    public function __construct(string $name)
    {
        parent::__construct($name);
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
        $request = new BaseRequest($this->getName());

        try {
            (new Bakery())->produce($request);

            $output->writeln("{$request->getProductName()} completed");
        } catch (ManufactureException $e) {
            $output->writeln("{$request->getProductName()} was not completed because of {$e->getMessage()}");
        } catch (\Throwable $e) {
            $output->writeln("{$request->getProductName()} was not completed because of undefined error in manufacture process");
        } finally {
            if (isset($e)) {
                return empty($e->getCode())
                    ? 1
                    : (int)$e->getCode();
            }
        }

        return 0;
    }
}

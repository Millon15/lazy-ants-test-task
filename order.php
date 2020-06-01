#!/usr/bin/env php
<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use src\Entity\BaseProduct;
use src\Command\BaseCommand;
use Symfony\Component\Console\Application;

$app = new Application('Backery app', '1.0.0');
$app->add(new BaseCommand(BaseProduct::NAME_PANCAKE));
$app->run();

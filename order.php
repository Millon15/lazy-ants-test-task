#!/usr/bin/env php
<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use src\Command\AmericanoCommand;
use src\Command\PancakeCommand;

$app = new Application('Backery app', '1.0.0');
$app->add(new PancakeCommand());
$app->add(new AmericanoCommand());
$app->run();

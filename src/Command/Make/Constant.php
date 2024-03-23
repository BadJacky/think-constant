<?php

namespace EverForge\ThinkConstant\Command\Make;

use think\console\Command;
use think\console\command\Make;

class Constant extends Make
{
    protected $type = "Constant";

    protected function configure()
    {
        parent::configure();
        $this->setName('make:constant')
            ->setDescription('Create a new constant class');
    }

    protected function getStub(): string
    {
        return dirname(__DIR__,2) . DIRECTORY_SEPARATOR  . 'stubs' . DIRECTORY_SEPARATOR . 'constant.stub';
    }

    protected function getNamespace(string $app): string
    {
        return parent::getNamespace($app) . '\\constant';
    }
}
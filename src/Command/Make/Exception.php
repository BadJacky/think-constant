<?php

namespace EverForge\ThinkConstant\Command\Make;

use think\console\Command;
use think\console\command\Make;

class Exception extends Make
{
    protected $type = "Exception";

    protected function configure()
    {
        parent::configure();
        $this->setName('make:exception')
            ->setDescription('Create a new exception class');
    }

    protected function getStub(): string
    {
        return dirname(__DIR__,2) . DIRECTORY_SEPARATOR  . 'stubs' . DIRECTORY_SEPARATOR . 'exception.stub';
    }

    protected function getNamespace(string $app): string
    {
        return parent::getNamespace($app) . '\\exception\\constantExceptions';
    }
}
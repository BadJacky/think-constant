<?php

namespace EverForge\ThinkConstant\Tests\Example;

use EverForge\ThinkConstant\Constant;
use EverForge\ThinkConstant\Exceptions\ConstantException;
use EverForge\ThinkConstant\Tests\Example\TestConstant;

class TestException extends ConstantException
{
    protected const HANDLED_CONSTANT_FQCN = TestConstant::class;

}
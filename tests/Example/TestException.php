<?php

namespace EverForge\ThinkConstant\Tests\Example;

use EverForge\ThinkConstant\Exceptions\ConstantException;

class TestException extends ConstantException
{
    protected const HANDLED_CONSTANT_FQCN = TestConstant::class;
}

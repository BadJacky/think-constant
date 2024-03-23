<?php

namespace EverForge\ThinkConstant\Tests\Example;

use EverForge\ThinkConstant\Constant;
class TestConstant extends Constant
{

    /**
     * @Message(失败)
     */
    public const SERVER_ERROR = 500;
    public const SERVER_ERROR_FAILED_PARSED = 600;
}
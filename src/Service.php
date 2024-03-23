<?php

namespace EverForge\ThinkConstant;

use EverForge\ThinkConstant\Command\Make\Constant;
use EverForge\ThinkConstant\Command\Make\Exception;

class Service extends \think\Service
{
    public function register()
    {
    }

    public function boot()
    {
        $this->commands([
            Constant::class,
            Exception::class,
        ]);
    }
}

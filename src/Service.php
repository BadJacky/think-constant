<?php

namespace EverForge\ThinkConstant;


use EverForge\ThinkConstant\Command\Make\Constant;
use EverForge\ThinkConstant\Command\Make\Exception;
use think\helper\Arr;
use think\helper\Str;

class Service extends \think\Service
{
    public function register()
    {

    }

    public function boot()
    {
        $this->commands([
            Constant::class,
            Exception::class
        ]);
    }
}

<?php

require \dirname(__DIR__, 1) . '/vendor/topthink/framework/src/helper.php';

\app()->bind('cache', function () {
    return new \EverForge\ThinkConstant\Tests\Support\SimpleCache();
});

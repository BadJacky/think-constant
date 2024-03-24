# EverForge ThinkConstant

EverForge ThinkConstant 是一个 PHP 库，它提供了一种方便的方式来处理常量和异常。

## 安装

使用 Composer 安装：

```bash
composer require everforge/think-constant
```

## 使用
首先，创建一个常量类，继承 `EverForge\ThinkConstant\Constant` 类，然后定义常量：
```bash
php think make:constant MyConstant
```

```php
<?php

namespace App;

use EverForge\ThinkConstant\Constant;

class MyConstant extends Constant
{
    /**
     * @Message("系统错误")
     */
    public const SERVER_ERROR = 500;
}
```
然后，创建一个继承自 `EverForge\ThinkConstant\Exceptions\ConstantException` 的异常类：
```bash
php think make:exception MyException
```

```php
<?php

namespace App\Exceptions;

use EverForge\ThinkConstant\Exceptions\ConstantException;

class MyException extends ConstantException
{
    protected const HANDLED_CONSTANT_FQCN = MyConstant::class;
}

```
现在，你可以抛出 `MyException` 异常，并使用 `MyConstant::SERVER_ERROR` 作为错误代码：
```php
throw new MyException(MyConstant::SERVER_ERROR);
```

`MyException` 类会自动从 `MyConstant` 类中获取错误信息，并将其用作异常消息。

## 捕获异常
你可以使用 `try-catch` 语句捕获异常：
```php
try {
    throw new MyException(MyConstant::SERVER_ERROR);
} catch (MyException $e) {
    echo $e->getMessage(); // 输出 "失败"
}
```
## 在 thinkphp 中使用
```php

// 使用全局错误捕获并处理异常
/**
* @see https://www.kancloud.cn/manual/thinkphp6_0/1037615
 */
 
 if ($e insteadof \EverForge\ThinkConstant\Exceptions\ConstantException::class)
 {
    [$code,$message] = [$e->getCode(),$e->getMessage()];
 }

```

## License
MIT


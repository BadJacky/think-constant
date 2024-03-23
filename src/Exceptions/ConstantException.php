<?php

namespace EverForge\ThinkConstant\Exceptions;

use ReflectionClass;
use ReflectionClassConstant;
use think\Exception;
use Throwable;

abstract class ConstantException extends Exception
{
    protected const HANDLED_CONSTANT_FQCN = null;


    public function __construct(int $code = 0, string $message = '', Throwable $previous = null)
    {
        parent::__construct($message,$code, $previous);
    }


    public static function getHandledConstantFQCN(): string
    {
        return static::HANDLED_CONSTANT_FQCN;
    }

    public function getError(int $code)
    {
        $reflected_class = new ReflectionClass(static::HANDLED_CONSTANT_FQCN);
        $constants = $reflected_class->getConstants();

        foreach ($constants as $constant_name => $constant_value) {
            if ($constant_value === $code) {
                $constant = $reflected_class->getReflectionConstant($constant_name);
                $doc = $constant->getDocComment();
                $parsedAnnotations = self::parseAnnotationsFromDocComment($doc);
                assert($parsedAnnotations !== []);
                $parsedAnnotations['code'] = $constant_value;
                return $parsedAnnotations;
            }
        }
        return [];
    }

    private static function parseAnnotationsFromDocComment($docComment): array
    {
        // 更新正则表达式以匹配数字和字符串
        $pattern = '/@(\w+)\((\d+|[^\)]+)\)/';
        preg_match_all($pattern, $docComment, $matches, PREG_SET_ORDER);
        $parsedAnnotations = [];
        foreach ($matches as $match) {
            // 选择字符串或数字值
            $parsedAnnotations[$match[1]] = $match[2];
        }
        return $parsedAnnotations;
    }
}
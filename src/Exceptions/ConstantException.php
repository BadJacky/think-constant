<?php

namespace EverForge\ThinkConstant\Exceptions;

use ReflectionClass;
use think\Exception;
use think\helper\Str;
use Throwable;

abstract class ConstantException extends Exception
{
    protected const HANDLED_CONSTANT_FQCN = null;

    public function __construct(int $code = 0, string $message = '', Throwable $previous = null)
    {
        $message = $this->getErrorMessage($code);
        parent::__construct($message, $code, $previous);
    }

    public static function getHandledConstantFQCN(): string
    {
        return static::HANDLED_CONSTANT_FQCN;
    }

    protected static function getConstantMap(): array
    {
        $reflected_class = new ReflectionClass(static::getHandledConstantFQCN());
        $constants = $reflected_class->getConstants();

        $constant_map = [];
        foreach ($constants as $constant_name => $constant_value) {
            $constant = $reflected_class->getReflectionConstant($constant_name);
            $doc = $constant->getDocComment();
            $parsed_annotations = self::parseAnnotationsFromDocComment($doc);
            $message = $parsed_annotations['message'] ?? 'Unknown error code';
            $constant_map[$constant_value] = $message;
        }

        return $constant_map;
    }

    public function getErrorMessage(int $code): string
    {
        $constantMap = static::getConstantMap();
        return $constantMap[$code] ?? 'Unknown error code';

    }

    private static function parseAnnotationsFromDocComment($docComment): array
    {
        $pattern = '/@(\w+)\("([^"]*)"\)/';
        preg_match_all($pattern, $docComment, $matches, PREG_SET_ORDER);
        $parsed_annotations = [];
        foreach ($matches as $match) {
            $parsed_annotations[Str::snake($match[1])] = $match[2];
        }

        return $parsed_annotations;
    }
}

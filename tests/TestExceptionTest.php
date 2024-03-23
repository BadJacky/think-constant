<?php

use EverForge\ThinkConstant\Tests\Example\TestConstant;
use EverForge\ThinkConstant\Tests\Example\TestException;

test('exception should with constant', function () {
    $constant = TestException::getHandledConstantFQCN();
    expect($constant)->toBe(TestConstant::class)
        ->and(constant($constant . '::SERVER_ERROR'))->toBe(500);
});

test('annotation reader matched', function () {
    $reflected_class = TestConstant::class;
    $reflected_class = new ReflectionClass($reflected_class);
    expect($reflected_class)
        ->toBeInstanceOf(ReflectionClass::class);
    $exception = new TestException(TestConstant::SERVER_ERROR);
    $error = $exception->getError(500);
    expect($error)->toBeArray()
        ->toEqual(['Message' => '失败', 'code' => 500]);
});

test('handled Exception', function () {
    try {
        throw new TestException(TestConstant::SERVER_ERROR);
    } catch (TestException $e) {
        $error = $e->getError(TestConstant::SERVER_ERROR);
    }
    expect($error)->toBeArray()
        ->toEqual(['Message' => '失败', 'code' => 500]);
});

test('not handled Exception with message', function () {
    try {
        throw new TestException(TestConstant::SERVER_ERROR_FAILED_PARSED);
    } catch (TestException $e) {
        $error = $e->getError($e->getCode());
    }
    expect($error)->toBeArray()
        ->toEqual(['code' => 600]);
});
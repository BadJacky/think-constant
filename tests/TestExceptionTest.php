<?php

use EverForge\ThinkConstant\Tests\Example\TestConstant;
use EverForge\ThinkConstant\Tests\Example\TestException;

test('exception should with constant', function () {
    $constant = TestException::getHandledConstantFQCN();
    expect($constant)->toBe(TestConstant::class)
        ->and(\constant($constant . '::SERVER_ERROR'))->toBe(500);
});

test('annotation reader matched', function () {
    $reflected_class = TestConstant::class;
    $reflected_class = new ReflectionClass($reflected_class);
    expect($reflected_class)
        ->toBeInstanceOf(ReflectionClass::class);
    $exception = new TestException(TestConstant::SERVER_ERROR);

    expect($exception)
        ->toBeInstanceOf(\EverForge\ThinkConstant\Exceptions\ConstantException::class)
        ->and($exception->getErrorMessage(TestConstant::SERVER_ERROR))->toBe('失败');
});

test('handled Exception', function () {
    try {
        throw new TestException(TestConstant::SERVER_ERROR);
    } catch (TestException $e) {
    }
    expect($e)
        ->toBeInstanceOf(\EverForge\ThinkConstant\Exceptions\ConstantException::class)
        ->and($e->getMessage())->toBe('失败');
});

test('not handled Exception with message', function () {
    try {
        throw new TestException(TestConstant::SERVER_ERROR_FAILED_PARSED);
    } catch (TestException $e) {
    }
    expect($e)
        ->toBeInstanceOf(\EverForge\ThinkConstant\Exceptions\ConstantException::class)
        ->and($e->getMessage())->toBe('Unknown error code');
});

test('cache is useful', function () {
    try {
        throw new TestException(TestConstant::SERVER_ERROR_FAILED_PARSED);
    } catch (TestException $e) {
    }
    $cache_data = \app()->get('cache')->get('test_exception');
    expect($cache_data)->toBeArray()
        ->and($cache_data[TestConstant::SERVER_ERROR])->toBe('失败')
        ->and($cache_data[TestConstant::SERVER_ERROR_FAILED_PARSED])->toBe('Unknown error code');
});

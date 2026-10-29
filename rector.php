<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\New_\NewStaticToNewSelfRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPrivateMethodRector;
use Rector\PHPUnit\CodeQuality\Rector\MethodCall\AssertSameTrueFalseToAssertTrueFalseRector;
use Rector\PHPUnit\CodeQuality\Rector\MethodCall\UseSpecificWillMethodRector;
use Rector\PHPUnit\PHPUnit120\Rector\Class_\PropertyCreateMockToCreateStubRector;
use Rector\PHPUnit\Set\PHPUnitSetList;

return RectorConfig::configure()
    ->withPreparedSets(deadCode: true, codeQuality: true)
    ->withIndent()
    ->withImportNames()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withPhpSets(php83: true)
    ->withSets([
        PHPUnitSetList::COMPOSER_BASED,
    ])
    ->withSkip([
        PropertyCreateMockToCreateStubRector::class => [
            __DIR__ . '/tests/Client/Report/ReportClientTest.php'
        ],
        NewStaticToNewSelfRector::class => [
            __DIR__ . '/src/Hydrator/Property/ArrayOfObjectValue.php',
            __DIR__ . '/src/Hydrator/Property/ArrayValue.php',
            __DIR__ . '/src/Hydrator/Property/ObjectValue.php',
        ],
        RemoveUnusedPrivateMethodRector::class => [
            __DIR__ . '/src/Hydrator/Property/ArrayOfObjectValue.php',
            __DIR__ . '/src/Hydrator/Property/ArrayValue.php',
            __DIR__ . '/src/Hydrator/Property/ObjectValue.php',
        ],
    ])
    ->withRules([
        AssertSameTrueFalseToAssertTrueFalseRector::class,
        UseSpecificWillMethodRector::class,
    ]);

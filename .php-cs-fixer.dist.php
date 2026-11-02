<?php

declare(strict_types=1);

use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

return (new PhpCsFixer\Config())
    ->setUnsupportedPhpVersionAllowed(true)
    ->setCacheFile(__DIR__ . '/build/.php-cs-fixer.cache')
    ->setFinder($finder)
    ->setRules([
        '@PSR2' => true,
        'multiline_promoted_properties' => true,
        'no_unused_imports' => true,
        'indentation_type' => true,
        'yoda_style' => ['equal' => false, 'identical' => false, 'less_and_greater' => false],
        'cast_spaces' => ['space' => 'single'],
        'concat_space' => ['spacing' => 'one'],
        'phpdoc_align' => ['align' => 'left'],
        'phpdoc_indent' => true,
        'array_indentation' => true,
        'nullable_type_declaration' => [
            'syntax' => 'union',
        ]
    ])
;

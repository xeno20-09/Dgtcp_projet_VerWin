<?php

$finder = Symfony\Component\Finder\Finder::create()
    ->in(__DIR__)
    ->exclude('vendor')
    ->exclude('storage')
    ->exclude('node_modules')
    ->notPath('bootstrap/cache');
    return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'concat_space' => ['spacing' => 'one'],
        'no_trailing_whitespace' => true,
        // Add more rules as needed
    ])
    ->setFinder($finder);

<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__ . '/Classes')
    ->in(__DIR__ . '/Tests')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'strict_param' => true,
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setFinder($finder)
    ->setRiskyAllowed(true)
;

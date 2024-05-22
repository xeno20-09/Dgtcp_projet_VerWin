<?php
// Create a new CS Fixer Finder instance
$finder = PhpCsFixer\Finder::create()->in(__DIR__);

// Create a configuration instance
$config = Cartalyst\PhpCsFixer\Config::create()->setFinder($finder);

// Return the configuration
return $config;

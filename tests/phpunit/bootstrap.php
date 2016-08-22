<?php # -*- coding: utf-8 -*-
namespace wallstreetonline\stockquotes;

require_once 'vendor/autoload.php';

/**
 * Load the Requisite library. Alternatively you can use composer's
 */
require_once 'src/requisite/src/Requisite/Requisite.php';
\Requisite\Requisite::init();

$autoloader = new \Requisite\SPLAutoLoader;
$autoloader->addRule(
	new \Requisite\Rule\Psr4(
		__DIR__ . '/../src',       // base directory
		'wallstreetonline\stockquotes' // base namespace
	)
);
<?php

use ArcaSolutions\MultiDomainBundle\HttpFoundation\MultiDomainRequest;

/**
 * @var Composer\Autoload\ClassLoader
 */
$loader = require __DIR__.'/../app/autoload.php';
include_once __DIR__.'/../app/bootstrap.php.cache';

// Enable APC for autoloading to improve performance.
// You should change the ApcClassLoader first argument to a unique prefix
// in order to prevent cache key conflicts with other applications
// also using APC.
/*
$apcLoader = new Symfony\Component\ClassLoader\ApcClassLoader(sha1(__FILE__), $loader);
$loader->unregister();
$apcLoader->register(true);
*/

if ($_SERVER['REQUEST_URI'] === "/favicon.ico") {
    exit;
}

require_once __DIR__ . '/../app/AppKernel.php';
//require_once __DIR__.'/../app/AppCache.php';


$kernel = new AppKernel('prod', false);

// @TODO - uncomment the line below.
//$kernel->loadClassCache();

//$kernel = new AppCache($kernel);
$request = MultiDomainRequest::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);

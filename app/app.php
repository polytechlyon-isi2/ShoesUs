<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// Register services
$app['dao.product'] = $app->share(function ($app) {
    $productDAO = new ShoesUs\DAO\ProductDAO($app['db']);
    $productDAO->setCategoryDAO($app['dao.category']);
    return $productDAO;

});
$app['dao.category'] = $app->share(function ($app) {
    return new ShoesUs\DAO\CategoryDAO($app['db']);
});
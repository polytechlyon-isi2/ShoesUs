<?php

// Home page
$app->get('/', function () use ($app) {
    $products = $app['dao.product']->findAll();
    return $app['twig']->render('index.html.twig', array('products' => $products));
})->bind('home');

// Article details with comments
$app->get('/product/{id}', function ($id) use ($app) {
    $product = $app['dao.product']->find($id);
    return $app['twig']->render('product.html.twig', array('product' => $product));
})->bind('product');
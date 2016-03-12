<?php

// Home page
$app->get('/', function () use ($app) {
    $products = $app['dao.product']->findAll();
    return $app['twig']->render('index.html.twig', array('products' => $products));
});
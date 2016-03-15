<?php
use Symfony\Component\HttpFoundation\Request;
// Home page
$app->get('/', function () use ($app) {
    $categories = $app['dao.category']->findAll();
    return $app['twig']->render('index.html.twig', array('categories' => $categories));
})->bind('home');

// Article details with comments
$app->get('/product/{id}', function ($id) use ($app) {
    $product = $app['dao.product']->find($id);
    return $app['twig']->render('product.html.twig', array('product' => $product));
})->bind('product');

// Home page
$app->get('/category/{id}', function ($id) use ($app) {
    $products = $app['dao.product']->findAllByCategory($id);
    $category = $app['dao.category']->find($id);
    return $app['twig']->render('category.html.twig', array('products' => $products,
                                                            'category' => $category));
})->bind('category');
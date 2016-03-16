<?php
use Symfony\Component\HttpFoundation\Request;
use ShoesUs\Domain\Category;
use ShoesUs\Domain\Product;
use ShoesUs\Form\Type\CategoryType;
use ShoesUs\Form\Type\ProductType;
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

// Category page
$app->get('/category/{id}', function ($id) use ($app) {
    $products = $app['dao.product']->findAllByCategory($id);
    $category = $app['dao.category']->find($id);
    return $app['twig']->render('category.html.twig', array('products' => $products,
                                                            'category' => $category));
})->bind('category');

// Login form
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');

// Admin home page
$app->get('/admin', function() use ($app) {
    $products = $app['dao.product']->findAll();
    $categories = $app['dao.category']->findAll();
    $users = $app['dao.user']->findAll();
    return $app['twig']->render('admin.html.twig', array(
        'products' => $products,
        'categories' => $categories,
        'users' => $users));
})->bind('admin');



// Add a new product
$app->match('/admin/product/add', function(Request $request) use ($app) {
    $product = new Product();
    $productForm = $app['form.factory']->create(new ProductType(), $product);
    $productForm->handleRequest($request);
    if ($productForm->isSubmitted() && $productForm->isValid()) {
        $app['dao.product']->save($product);
        $app['session']->getFlashBag()->add('success', 'The product was successfully created.');
    }
    return $app['twig']->render('product_form.html.twig', array(
        'title' => 'New product',
        'productForm' => $productForm->createView()));
})->bind('admin_product_add');

// Edit an existing product
$app->match('/admin/product/{id}/edit', function($id, Request $request) use ($app) {
    $product = $app['dao.product']->find($id);
    $productForm = $app['form.factory']->create(new ProductType(), $product);
    $productForm->handleRequest($request);
    if ($productForm->isSubmitted() && $productForm->isValid()) {
        $app['dao.product']->save($product);
        $app['session']->getFlashBag()->add('success', 'The product was succesfully updated.');
    }
    return $app['twig']->render('product_form.html.twig', array(
        'title' => 'Edit product',
        'productForm' => $productForm->createView()));
})->bind('admin_product_edit');

// Remove an product
$app->get('/admin/product/{id}/delete', function($id, Request $request) use ($app) {
    // Delete the product
    $app['dao.product']->delete($id);
    $app['session']->getFlashBag()->add('success', 'The product was succesfully removed.');
    // Redirect to admin home page
    return $app->redirect($app['url_generator']->generate('admin'));
})->bind('admin_product_delete');
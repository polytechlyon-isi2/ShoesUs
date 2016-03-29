<?php
use Symfony\Component\HttpFoundation\Request;
use ShoesUs\Domain\Category;
use ShoesUs\Domain\Product;
use ShoesUs\Domain\User;
use ShoesUs\Domain\Bag;
use ShoesUs\Form\Type\CategoryType;
use ShoesUs\Form\Type\ProductType;
use ShoesUs\Form\Type\UserType;
// Home page
$app->get('/', function () use ($app) {
    $categories = $app['dao.category']->findAll();
    return $app['twig']->render('index.html.twig', array('categories' => $categories));
})->bind('home');

// product details
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


//Bag page



$app->get('/bag', function () use ($app) {
    $bags = $app['dao.bag']->findAll($app['user']->getId());
    $test = $app['user']->getId();
    return $app['twig']->render('bag.html.twig', array('bags' => $bags,
                                                      'test' => $test));
})->bind('bag');



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



// Add a new category
$app->match('/admin/category/add', function(Request $request) use ($app) {
    $category = new Category();
    $categoryForm = $app['form.factory']->create(new CategoryType(), $category);
    $categoryForm->handleRequest($request);
    if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
        $app['dao.category']->save($category);
        $app['session']->getFlashBag()->add('success', 'The category was successfully created.');
    }
    return $app['twig']->render('category_form.html.twig', array(
        'title' => 'New category',
        'categoryForm' => $categoryForm->createView()));
})->bind('admin_category_add');

// Edit an existing category
$app->match('/admin/category/{id}/edit', function($id, Request $request) use ($app) {
    $category = $app['dao.category']->find($id);
    $categoryForm = $app['form.factory']->create(new CategoryType(), $category);
    $categoryForm->handleRequest($request);
    if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
        $app['dao.category']->save($category);
        $app['session']->getFlashBag()->add('success', 'The category was succesfully updated.');
    }
    return $app['twig']->render('category_form.html.twig', array(
        'title' => 'Edit category',
        'categoryForm' => $categoryForm->createView()));
})->bind('admin_category_edit');

// Remove an category
$app->get('/admin/category/{id}/delete', function($id, Request $request) use ($app) {
    // Delete the category
    $app['dao.category']->delete($id);
    $app['session']->getFlashBag()->add('success', 'The category was succesfully removed.');
    // Redirect to admin home page
    return $app->redirect($app['url_generator']->generate('admin'));
})->bind('admin_category_delete');





// Add a user
$app->match('/admin/user/add', function(Request $request) use ($app) {
    $user = new User();
    $userForm = $app['form.factory']->create(new UserType(), $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        // generate a random salt value
        $salt = substr(md5(time()), 0, 23);
        $user->setSalt($salt);
        $plainPassword = $user->getPassword();
        // find the default encoder
        $encoder = $app['security.encoder.digest'];
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password); 
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', 'The user was successfully created.');
    }
    return $app['twig']->render('user_form.html.twig', array(
        'title' => 'New user',
        'userForm' => $userForm->createView()));
})->bind('admin_user_add');

// Edit an existing user
$app->match('/admin/user/{id}/edit', function($id, Request $request) use ($app) {
    $user = $app['dao.user']->find($id);
    $userForm = $app['form.factory']->create(new UserType(), $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        $plainPassword = $user->getPassword();
        // find the encoder for the user
        $encoder = $app['security.encoder_factory']->getEncoder($user);
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password); 
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', 'The user was succesfully updated.');
    }
    return $app['twig']->render('user_form.html.twig', array(
        'title' => 'Edit user',
        'userForm' => $userForm->createView()));
})->bind('admin_user_edit');

// Remove a user
$app->get('/admin/user/{id}/delete', function($id, Request $request) use ($app) {
    // Delete the user
    $app['dao.user']->delete($id);
    $app['session']->getFlashBag()->add('success', 'The user was succesfully removed.');
    // Redirect to admin home page
    return $app->redirect($app['url_generator']->generate('admin'));
})->bind('admin_user_delete');
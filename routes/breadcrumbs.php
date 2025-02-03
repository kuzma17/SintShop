<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push(__('main.home'), route('home'));
});

Breadcrumbs::for('page', function (BreadcrumbTrail $trail, \App\Models\Page $page){
    $trail->parent('home');
    $trail->push($page->title, route('page', $page->slug));
});

Breadcrumbs::for('catalog', function (BreadcrumbTrail $trail, \App\Models\Category $category){
    if ($category->getParent()) {
        $trail->parent('catalog', $category->getParent());
    } else {
        $trail->parent('home');
    }
    $trail->push($category->title, route('catalog', $category->slug));
});

Breadcrumbs::for('good', function (BreadcrumbTrail $trail, \App\Models\Good $good){
    $trail->parent('catalog', $good->category);
    $trail->push($good->title, route('good', [$good->category->slug, $good->slug]));
});

Breadcrumbs::for('cart', function (BreadcrumbTrail $trail){
    $trail->parent('home');
    $trail->push(__('cart.cart'), route('cart'));
});

Breadcrumbs::for('user.profile', function (BreadcrumbTrail $trail){
    $trail->parent('home');
    $trail->push(__('user.cabinet'), route('user.profile'));
});

Breadcrumbs::for('search', function (BreadcrumbTrail $trail){
    $trail->parent('home');
    $trail->push(__('main.search'), route('search'));
});

Breadcrumbs::for('login', function (BreadcrumbTrail $trail){
    $trail->parent('home');
    $trail->push(__('main.login'), route('login'));
});

Breadcrumbs::for('register', function (BreadcrumbTrail $trail){
    $trail->parent('home');
    $trail->push(__('main.register'), route('register'));
});

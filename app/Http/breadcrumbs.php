<?php

Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Acasa', route('home'));
});


Breadcrumbs::register('blog_index', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Blog', route('blog_index'));
});
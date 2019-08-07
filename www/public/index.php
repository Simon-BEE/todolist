<?php
$basePath = dirname(__dir__) . DIRECTORY_SEPARATOR;

require_once $basePath . 'vendor/autoload.php';

$app = App\App::getInstance();
$app->setStartTime();
$app::load();

$app->getRouter($basePath)
    ->get('/', 'site#index', 'home')

    ->get('/todo', 'task#todo', 'todolist')
    ->post('/todo/add', 'task#addTask', 'task_add')
    ->post('/todo/edit', 'task#editTask', 'task_edit')
    ->post('/todo/check', 'task#checkTask', 'task_check')
    ->post('/todo/delete', 'task#deleteTask', 'task_delete')

    ->match('/post/add', 'post#add', 'post_add')
    ->match('/post/[i:id]-[*:slug]/edit', 'post#add', 'post_edit')
    ->match('/post/[i:id]-[*:slug]/delete', 'post#delete', 'post_delete')
    ->get('/post/[i:id]-[*:slug]', 'post#show', 'post_show')

    ->match('/category/add', 'category#add', 'category_add')
    ->get('/category/[i:id]-[*:slug]', 'category#show', 'category_show')

    ->run();

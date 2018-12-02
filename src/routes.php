<?php

//$app->get('/', 'App\Controllers\HomeController:home')->setName('index');

//Personages
$app->get('/personage/letters', 'App\Controllers\PersonageController:personageLetters');
$app->get('/personage/{id}', 'App\Controllers\PersonageController:getOne');
$app->get('/personage', 'App\Controllers\PersonageController:getAll');


//Wheres
$app->get('/where/letters', 'App\Controllers\WhereController:whereLetters');
$app->get('/where/populate', 'App\Controllers\WhereController:populateLetter');
$app->get('/where/{id}', 'App\Controllers\WhereController:getOne');
$app->get('/letters', 'App\Controllers\WhereControllerController:whereLetters');
$app->get('/where', 'App\Controllers\WhereController:getAll');


//Verses
$app->get('/verse/{id}', 'App\Controllers\VerseController:getOne');
$app->get('/verse', 'App\Controllers\VerseController:getAll');
$app->get('/verse/text/{b}/{c}/{v}', 'App\Controllers\VerseController:getText');


//Owner
$app->get('/owner/{id}', 'App\Controllers\OwnerController:getOne');
$app->get('/owner', 'App\Controllers\OwnerController:getAll');
$app->post('/owner', 'App\Controllers\OwnerController:create');

//Books
$app->get('/book/{id}', 'App\Controllers\BookController:getOne');
$app->get('/book', 'App\Controllers\BookController:getAll');

//Questions
$app->get('/question/{id}', 'App\Controllers\QuestionController:getOne');
$app->get('/question', 'App\Controllers\QuestionController:getAll');
$app->post('/question', 'App\Controllers\QuestionController:create');

//Bible
$app->get('/bible', 'App\Controllers\BibleController:mount');
$app->get('/bible/search/{type}/{id}', 'App\Controllers\BibleController:search');
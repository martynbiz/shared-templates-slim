<?php

// index

$app->get('/', function () use ($controller) {
    $controller->index();
});

// show

$app->get('/:id', function ($id) use ($controller) {
    $controller->show($id);
})->conditions(array('id' => '[1-9]([0-9]*)'));

// create

// form
$app->get('/create', function () use ($controller) {
    $controller->create();
});    

// action
$app->post('/', function () use ($controller) {
    $controller->create();
});

// update

// form
$app->get('/:id/edit', function ($id) use ($controller) {
    $controller->update($id);
})->conditions(array('id' => '[1-9]([0-9]*)')); 

// action
$app->put('/:id', function ($id) use ($controller) {
    $controller->update($id);
});

// delete

// form
$app->get('/:id/delete', function ($id) use ($controller) {
    $controller->delete($id);
})->conditions(array('id' => '[1-9]([0-9]*)')); 

//action
$app->delete('/:id', function ($id) use ($controller) {
    $controller->delete($id);
});
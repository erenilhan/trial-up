<?php

use App\Http\Controllers\ActorController;

test('prompt validation returns correct response', function () {
    $controller = new ActorController();
    $response = $controller->promptValidation();

    expect($response->getContent())->toContain('text_prompt');
});

test('controller has required methods', function () {
    $controller = new ActorController();

    expect(method_exists($controller, 'showForm'))->toBeTrue()
        ->and(method_exists($controller, 'store'))->toBeTrue()
        ->and(method_exists($controller, 'showTable'))->toBeTrue();
});

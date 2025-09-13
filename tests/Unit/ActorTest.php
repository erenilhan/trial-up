<?php

use App\Models\Actor;

test('can create actor model', function () {
    $actor = new Actor([
        'email' => 'test@example.com',
        'description' => 'Test description',
        'first_name' => 'John',
        'last_name' => 'Doe',
        'address' => '123 Test St',
        'age' => 25,
    ]);

    expect($actor->email)->toBe('test@example.com')
        ->and($actor->first_name)->toBe('John')
        ->and($actor->age)->toBe(25);
});

test('actor has fillable fields', function () {
    $actor = new Actor();

    expect($actor->getFillable())->toContain('email')
        ->and($actor->getFillable())->toContain('first_name')
        ->and($actor->getFillable())->toContain('last_name');
});

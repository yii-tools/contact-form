<?php

declare(strict_types=1);

use Yii\ContactForm\ContactAction;
use Yiisoft\Http\Method;
use Yiisoft\Router\Route;

return [
    Route::methods([Method::GET, Method::POST], '/contact')->action([ContactAction::class, 'run'])->name('contact'),
];

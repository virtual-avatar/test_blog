<?php

return [
    '~^articles/(\d+)$~' => [\MyProject\Controllers\ArticlesController::class, 'view'],
    '~^articles/add$~' => [\MyProject\Controllers\ArticlesController::class, 'add'],
    '~^admin/articles/(\d+)/edit$~' => [\MyProject\Controllers\ArticlesController::class, 'edit'],
    '~^users/register$~' => [\MyProject\Controllers\UsersController::class, 'signUp'],
    '~^admin/articles/(\d+)/delete$~' => [\MyProject\Controllers\ArticlesController::class, 'delete'],
    '~^users/(\d+)/activate/(.+)$~' => [\MyProject\Controllers\UsersController::class, 'activate'],
    '~^users/login~' => [\MyProject\Controllers\UsersController::class, 'login'],
    '~^users/logOut~' => [\MyProject\Controllers\UsersController::class, 'logOut'],
    '~^admin/add$~' => [\MyProject\Controllers\AdminController::class, 'add'],
    '~^admin/edit$~' => [\MyProject\Controllers\AdminController::class, 'edit'],
    '~^admin/delete$~' => [\MyProject\Controllers\AdminController::class, 'delete'],
    '~^admin$~' => [\MyProject\Controllers\AdminController::class, 'admin'],
    '~^about-me$~' => [\MyProject\Controllers\MainController::class, 'about_me'],
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main']
];
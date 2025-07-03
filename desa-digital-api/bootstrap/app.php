<?php

use App\Providers\RepositoryServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withProviders([
        RepositoryServiceProvider::class, // 🔥 Tambahkan ini
    ])
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => Spatie\Permission\MiddleWare\RoleMiddleware::class,
            'permission' => Spatie\Permission\MiddleWare\PermissionMiddleware::class,
            'role_or_permission' => Spatie\Permission\MiddleWare\RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

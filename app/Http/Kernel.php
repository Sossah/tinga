protected $middlewareGroups = [
    'web' => [
        // ...
        \App\Http\Middleware\VerifyCsrfToken::class,
        // ...
    ],
];

protected $routeMiddleware = [
    // ... existing middlewares ...
    'two-factor' => \App\Http\Middleware\RequireTwoFactorAuth::class,
];
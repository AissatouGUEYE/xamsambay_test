<?php

namespace App\Http;

use App\Http\Middleware\Localization;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            Localization::class,
        ],

        'api' => [
            // 'throttle:api',
            'throttle:100,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,


        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'as_admin' => \App\Http\Middleware\AdminMiddleware::class,
        'as_op' => \App\Http\Middleware\OpMiddleware::class,
        'as_ind' => \App\Http\Middleware\IndividuelMiddleware::class,
        'as_ong' => \App\Http\Middleware\OngMiddleware::class,
        'as_producteur' => \App\Http\Middleware\ProducteurMiddleware::class,
        'as_assurance' => \App\Http\Middleware\AssuranceMiddleware::class,
        'as_finance' => \App\Http\Middleware\FinanceMiddleware::class,
        'as_se' => \App\Http\Middleware\ServiceEtatiqueMiddleware::class,
        'as_transporteur' => \App\Http\Middleware\ServiceTransposrtMiddleware::class,
        'as_interprofession' => \App\Http\Middleware\InterprofessionMiddleware::class,
        'as_acheteur' => \App\Http\Middleware\AcheteurMiddleware::class,
        'all' => \App\Http\Middleware\AllUserMiddleware::class,
        'vente' => \App\Http\Middleware\VenteMiddleware::class,

    ];
}

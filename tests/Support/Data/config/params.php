<?php

declare(strict_types=1);

use Yii\Service\ParameterService;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Definitions\Reference;
use Yiisoft\ErrorHandler\Middleware\ErrorCatcher;
use Yiisoft\I18n\Locale;
use Yiisoft\Log\Target\File\FileTarget;
use Yiisoft\Router\Middleware\Router;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Session\Flash\Flash;
use Yiisoft\Session\SessionMiddleware;
use Yiisoft\Yii\View\CsrfViewInjection;

return [
    // Internationalization (i18n)
    'locale' => [
        'locale' => 'en',
        'locales' => ['en' => 'en-US', 'ru' => 'ru-RU'],
        'ignoredRequests' => [
            '/debug**',
        ],
    ],

    'middlewares' => [
        ErrorCatcher::class,
        SessionMiddleware::class,
        \Yiisoft\Yii\Middleware\Locale::class,
        Router::class,
    ],

    'yiisoft/aliases' => [
        'aliases' => [
            '@root' => dirname(__DIR__, 4),
            '@assets' => '@tests/Support/Data/public/assets',
            '@assetsUrl' => '/assets',
            '@contact-form-mail' => '@resources/mail',
            '@contact-form-views' => '@resources/views',
            '@layout' => '@tests/Support/Data/resources/layout',
            '@messages' => '@resources/messages',
            '@npm' => '@root/node_modules',
            '@resources' => '@root/resources',
            '@runtime' => '@root/tests/_output/runtime',
            '@tests' => '@root/tests',
            '@vendor' => '@root/vendor',
            '@views' => '@resources/views',
        ],
    ],

    // Log
    'yiisoft/log' => [
        'targets' => [
            FileTarget::class,
        ],
    ],

    // Translator
    'yiisoft/translator' => [
        'locale' => 'en',
        'fallbackLocale' => 'en',
        'defaultCategory' => 'app',
    ],

    // View
    'yiisoft/view' => [
        'basePath' => '@views',
        'parameters' => [
            'assetManager' => Reference::to(AssetManager::class),
            'locale' => Reference::to(Locale::class),
            'parameterService' => Reference::to(ParameterService::class),
            'urlGenerator' => Reference::to(UrlGeneratorInterface::class),
        ],
    ],

    // Yii view
    'yiisoft/yii-view' => [
        'injections' => [
            Reference::to(CsrfViewInjection::class),
        ],
        'layout' => '@layout/main',
        'viewPath' => '@views',
    ],
];

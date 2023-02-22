<?php

declare(strict_types=1);

use Yiisoft\Yii\Runner\Http\HttpApplicationRunner;

if (\getenv('YII_C3')) {
    $c3 = \dirname(__DIR__, 4) . '/c3.php';

    if (\file_exists($c3)) {
        require_once $c3;
    }
}

/**
 * PHP built-in server routing.
 *
 * @psalm-var string $_SERVER['REQUEST_URI']
 */
if (PHP_SAPI === 'cli-server') {
    /**
     * Serve static files as is.
     *
     * @psalm-suppress MixedArgument
     */
    $path = \parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if (\is_file(__DIR__ . $path)) {
        return false;
    }

    /**
     * Explicitly set for URLs with dot.
     */
    $_SERVER['SCRIPT_NAME'] = '/index.php';
}

require_once \dirname(__DIR__, 4) . '/vendor/autoload.php';

/**
 * Run HTTP application runner
 */
$runner = new HttpApplicationRunner(
    rootPath: \dirname(__DIR__, 4),
    debug: true,
    environment: 'test',
    diGroup: 'web',
);
$runner->run();

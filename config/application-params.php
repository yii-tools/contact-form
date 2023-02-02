<?php

declare(strict_types=1);

use Yii\Bootstrap5\Asset\Cdn\Bootstrap5Asset;
use Yii\BootstrapIcons\Asset\Cdn\BootstrapIconsAsset;

return [
    'yii-tools/contact-form' => [
        'assets' => [
            Bootstrap5Asset::class,
            BootstrapIconsAsset::class,
        ],
        'field' => [
            'class()' => ['form-control'],
            'containerClass()' => ['form-group input-group me-3'],
            'errorClass()' => ['d-block invalid-feedback'],
            'inputContainer()' => [true],
            'inputContainerClass()' => ['form-floating flex-grow-1'],
            'inputTemplate()' => ['{input}' . PHP_EOL . '{label}'],
        ],
        'frameworkCss' => 'bootstrap',
    ],
];

<?php

declare(strict_types=1);

use Yii\Forms\Component\ButtonGroup;

return [
    ButtonGroup::class => [
        'buttons()' => [
            [
                [
                    'label' => 'send',
                    'type' => 'submit',
                    'attributes' => ['class' => 'btn btn-lg btn-primary'],
                ],
                [
                    'label' => 'reset',
                    'type' => 'reset',
                    'attributes' => ['class' => 'btn btn-lg btn-danger'],
                ],
            ],
        ],
        'containerClass()' => ['btn-group'],
    ],
];

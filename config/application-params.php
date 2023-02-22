<?php

declare(strict_types=1);

return [
    'yii-tools/contact-form' => [
        'bootstrap' => [
            'widgets' => [
                'buttonsGroup' => [
                    'buttons()' => [
                        [
                            [
                                'attributes' => ['class' => 'btn btn-lg btn-primary me-1'],
                                'type' => 'submit',
                                'value' => 'SEND',
                            ],
                            [
                                'attributes' => ['class' => 'btn btn-lg btn-danger'],
                                'type' => 'reset',
                                'value' => 'RESET',
                            ],
                        ],
                    ],
                    'containerClass()' => ['justify-content-end btn-toolbar'],
                ],
                'field' => [
                    'class()' => ['form-control'],
                    'containerClass()' => ['form-group input-group me-3 col-md-6 mb-4'],
                    'errorClass()' => ['d-block invalid-feedback'],
                    'inputContainer()' => [true],
                    'inputContainerClass()' => ['form-floating flex-grow-1'],
                    'inputTemplate()' => ['{input}' . PHP_EOL . '{label}'],
                ],
            ],
        ],
        'bulma' => [
            'widgets' => [
                'buttonsGroup' => [
                    'buttons()' => [
                        [
                            [
                                'attributes' => ['class' => 'button is-link mr-1'],
                                'type' => 'submit',
                                'value' => 'SEND',
                            ],
                            [
                                'attributes' => ['class' => 'button is-link is-light'],
                                'type' => 'reset',
                                'value' => 'RESET',
                            ],
                        ],
                    ],
                    'containerClass()' => ['control'],
                ],
                'field' => [
                    'class()' => ['input'],
                    'containerClass()' => ['field'],
                    'errorClass()' => ['help is-danger'],
                    'inputContainer()' => [true],
                    'inputContainerClass()' => ['control has-icons-left has-icons-right'],
                    'inputTemplate()' => ['{input}'],
                    'labelClass()' => ['label'],
                    'template()' => ['{label}' . PHP_EOL . '{field}' . PHP_EOL . '{error}'],
                ],
            ],
        ],
        'materialize' => [
            'widgets' => [
                'buttonsGroup' => [
                    'buttons()' => [
                        [
                            [
                                'attributes' => ['class' => 'btn green darken-4 text-white'],
                                'type' => 'submit',
                                'value' => 'SEND',
                            ],
                            [
                                'attributes' => ['class' => 'btn red darken-4 text-white'],
                                'type' => 'reset',
                                'value' => 'RESET',
                            ],
                        ],
                    ],
                ],
                'field' => [
                    'class()' => ['validate'],
                    'containerClass()' => ['row'],
                    'errorClass()' => ['darken-text-2 red-text text-accent-3'],
                    'inputContainer()' => [true],
                    'inputContainerClass()' => ['input-field col s12'],
                ],
            ],
        ],
        'tailwind' => [
            'widgets' => [
                'buttonsGroup' => [
                    'buttons()' => [
                        [
                            [
                                'attributes' => [
                                    'class' => 'px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out',
                                ],
                                'type' => 'submit',
                                'value' => 'SEND',
                            ],
                            [
                                'attributes' => ['class' => 'px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out'],
                                'label' => 'RESET',
                                'type' => 'reset',
                            ],
                        ],
                    ],
                    'containerClass()' => ['text-right'],
                ],
                'field' => [
                    'class()' => ['hadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light mb-3'],
                    'labelClass()' => ['block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300'],
                    'errorClass()' => ['mb-3 text-sm text-red-600'],
                ],
            ],
        ],
        'frameworkCss' => 'bootstrap',
    ],
];

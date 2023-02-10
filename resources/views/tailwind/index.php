<?php

declare(strict_types=1);

use Yii\FilePond\FilePond;
use Yii\Forms\ButtonGroup;
use Yii\Forms\Field;
use Yii\Forms\Form;
use Yii\Forms\Input\Text;
use Yii\MarkDownEditor\MarkDownEditor;
use Yii\Tailwind\Asset\Cdn\TailwindAsset;
use Yiisoft\Http\Method;

/**
 * @var array $assets
 * @var array $theming
 * @var \Yiisoft\View\WebView $this
 */

$this->setTitle('Contact');

$assetManager->register(TailwindAsset::class);
$buttonConfig = $parameterService->get('yii-tools/contact-form.tailwind.widgets.buttonsGroup');
$fieldConfig = $parameterService->get('yii-tools/contact-form.tailwind.widgets.field');
?>

<div class='py-4 lg:py-4 px-4 mx-auto max-w-screen-md'>
    <h1 class= 'mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white'>
        <?= $this->getTitle() ?>
    </h1>

    <?= Form::widget()
        ->action($urlGenerator->generate('contact'))
        ->csrf($csrf)
        ->enctype('multipart/form-data')
        ->method(Method::POST)
        ->begin() ?>

        <?= Field::widget([Text::widget([$form, 'name'])], $fieldConfig) ?>

        <?= Field::widget([Text::widget([$form, 'email'])], $fieldConfig) ?>

        <?= Field::widget([Text::widget([$form, 'subject'])], $fieldConfig) ?>

        <?= Field::widget([MarkDownEditor::widget([$form, 'message'])])
            ->containerClass('mt-3')
            ->notLabel() ?>

        <?= Field::widget(
                [
                    FilePond::widget([$form, 'attachment'])
                        ->acceptedFileTypes(['image/*'])
                        ->allowMultiple(true)
                        ->imagePreviewMarkupShow(false)
                        ->imagePreviewTransparencyIndicator('#FFFFFF')
                        ->maxFiles(3)
                        ->maxFileSize('10MB'),
                ],
            )->notLabel() ?>

        <?= Field::widget([ButtonGroup::widget(config: $buttonConfig)]) ?>

    <?= Form::end() ?>
<div>

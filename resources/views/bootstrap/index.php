<?php

declare(strict_types=1);

use Yii\Bootstrap5\Asset\Cdn\Bootstrap5Asset;
use Yii\BootstrapIcons\Asset\Cdn\BootstrapIconsAsset;
use Yii\FilePond\FilePond;
use Yii\Forms\Component\ButtonGroup;
use Yii\Forms\Component\Field;
use Yii\Forms\Component\Form;
use Yii\Forms\Component\Input\Text;
use Yii\MarkDownEditor\MarkDownEditor;
use Yiisoft\Http\Method;

/**
 * @var array $assets
 * @var array $theming
 * @var \Yiisoft\View\WebView $this
 */

$this->setTitle('Contact');

$assetManager->registerMany([Bootstrap5Asset::class, BootstrapIconsAsset::class]);
$buttonConfig = $parameterService->get('yii-tools/contact-form.bootstrap.widgets.buttonsGroup');
$fieldConfig = $parameterService->get('yii-tools/contact-form.bootstrap.widgets.field');
?>

<div class='container py-2'>
    <h1 class= 'mb-3'>
        <?= $this->getTitle() ?>
    </h1>

    <?= Form::widget()
        ->action($urlGenerator->generate('contact'))
        ->csrf($csrf)
        ->enctype('multipart/form-data')
        ->method(Method::POST)
        ->begin() ?>

        <?= Field::widget([Text::widget([$form, 'name'])], $fieldConfig)
            ->prefix('<span class="input-group-text"><i class="bi bi-person-fill"></i></span>') ?>

        <?= Field::widget([Text::widget([$form, 'email'])], $fieldConfig)
            ->prefix('<span class="input-group-text"><i class="bi bi-envelope-at"></i></span>') ?>

        <?= Field::widget([Text::widget([$form, 'subject'])], $fieldConfig)
            ->prefix('<span class="input-group-text"><i class="bi bi-chat-left-fill"></i></span>') ?>

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

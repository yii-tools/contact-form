<?php

declare(strict_types=1);

use Yii\Forms\Component\ButtonGroup;
use Yii\Forms\Component\Field;
use Yii\Forms\Component\FilePond;
use Yii\Forms\Component\Form;
use Yii\Forms\Component\Input\Text;
use Yii\Forms\Component\MarkDownEditor;
use Yiisoft\Http\Method;

/**
 * @var array $assets
 * @var array $theming
 * @var \Yiisoft\View\WebView $this
 */

$this->setTitle('Contact');

$assetManager->registerMany($parameterService->get('yii-tools/contact-form.assets'));
$fieldConfig = $parameterService->get('yii-tools/contact-form.field');
?>

<div class="container py-4">
    <h1 class="mb-3"><?= $this->getTitle() ?></h1>

    <div class="alert alert-info mb-4 shadow" role="alert">
        If you have inquiries or other questions, please fill out the following form to contact <b>terabytesoftw</b>, Thank you.
    </div>

    <?= Form::widget()
        ->action($urlGenerator->generate('contact'))
        ->class('row')
        ->csrf($csrf)
        ->enctype('multipart/form-data')
        ->method(Method::POST)
        ->begin() ?>

        <?= Field::widget([Text::widget([$form, 'name'])], $fieldConfig)
            ->containerClass('col-md-6 mb-3')
            ->prefix('<span class="input-group-text"><i class="bi bi-person-fill"></i></span>') ?>

        <?= Field::widget([Text::widget([$form, 'email'])], $fieldConfig)
            ->containerClass('col-md-6 mb-3')
            ->prefix('<span class="input-group-text">@</span>') ?>

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

        <?= Field::widget([ButtonGroup::widget()])->containerClass('justify-content-end btn-toolbar') ?>

    <?= Form::end() ?>
<div>

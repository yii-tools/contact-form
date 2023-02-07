<?php

declare(strict_types=1);

use Yii\Bulma\Asset\Cdn\BulmaAsset;
use Yii\FilePond\FilePond;
use Yii\Fontawesome\Asset\Cdn\Css\CdnAllAsset;
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

$assetManager->registerMany([BulmaAsset::class, CdnAllAsset::class]);
$buttonConfig = $parameterService->get('yii-tools/contact-form.bulma.widgets.buttonsGroup');
$fieldConfig = $parameterService->get('yii-tools/contact-form.bulma.widgets.field');
?>

<div class='container'>
    <h1 class='mb-3 title text-center'>
        <?= $this->getTitle() ?>
    </h1>

    <?= Form::widget()
        ->action($urlGenerator->generate('contact'))
        ->csrf($csrf)
        ->enctype('multipart/form-data')
        ->method(Method::POST)
        ->begin() ?>

        <?= Field::widget(
            [
                Text::widget([$form, 'name'])
                    ->suffix('<span class="icon is-small is-left"><i class="fas fa-user"></i></span>'),
            ],
            $fieldConfig,
        ) ?>

        <?= Field::widget(
            [
                Text::widget([$form, 'email'])
                    ->suffix('<span class="icon is-small is-left"><i class="fas fa-envelope"></i>'),
            ],
            $fieldConfig,
        ) ?>

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

        <?= Field::widget([ButtonGroup::widget(config: $buttonConfig)])
            ->containerClass('field is-grouped is-justify-content-end mt-6') ?>

    <?= Form::end() ?>
<div>

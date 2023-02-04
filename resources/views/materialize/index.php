<?php

declare(strict_types=1);

use Yii\Forms\Component\ButtonGroup;
use Yii\Forms\Component\Field;
use Yii\Forms\Component\FilePond;
use Yii\Forms\Component\Form;
use Yii\Forms\Component\Input\Text;
use Yii\Forms\Component\MarkDownEditor;
use Yii\Materialize\Asset\Cdn\MaterializeAsset;
use Yiisoft\Http\Method;

/**
 * @var array $assets
 * @var array $theming
 * @var \Yiisoft\View\WebView $this
 */

$this->setTitle('Contact');

$assetManager->register(MaterializeAsset::class);
$buttonConfig = $parameterService->get('yii-tools/contact-form.materialize.widgets.buttonsGroup');
$fieldConfig = $parameterService->get('yii-tools/contact-form.materialize.widgets.field');
?>

<div class='container'>
    <h2 class= 'mb-3'>
        <?= $this->getTitle() ?>
    </h2>

    <?= Form::widget()
        ->action($urlGenerator->generate('contact'))
        ->class('col s12')
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

        <?= Field::widget([ButtonGroup::widget(config: $buttonConfig)])->containerClass('right-align') ?>

    <?= Form::end() ?>
<div>

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

$assetManager->registerMany($parameterService->get("yii-tools/contact-form.$frameworkCss.assets"));
$fieldConfig = $parameterService->get("yii-tools/contact-form.$frameworkCss.widgets.field");
?>

<div class="<?=$parameterService->get("yii-tools/contact-form.$frameworkCss.header.divClass")?>">
    <h1 class="<?=$parameterService->get("yii-tools/contact-form.$frameworkCss.header.h1Class")?>">
        <?= $this->getTitle() ?>
    </h1>

    <?= Form::widget()
        ->action($urlGenerator->generate('contact'))
        ->csrf($csrf)
        ->enctype('multipart/form-data')
        ->method(Method::POST)
        ->begin() ?>

        <?= Field::widget([Text::widget([$form, 'name'])], $fieldConfig)
            ->prefix($parameterService->get("yii-tools/contact-form.$frameworkCss.prefix.name", '')) ?>

        <?= Field::widget([Text::widget([$form, 'email'])], $fieldConfig)
            ->prefix($parameterService->get("yii-tools/contact-form.$frameworkCss.prefix.email", '')) ?>

        <?= Field::widget([Text::widget([$form, 'subject'])], $fieldConfig)
            ->prefix($parameterService->get("yii-tools/contact-form.$frameworkCss.prefix.subject", '')) ?>

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

        <?= Field::widget(
                [
                    ButtonGroup::widget(
                        config: $parameterService->get("yii-tools/contact-form.$frameworkCss.widgets.buttonsGroup")
                    ),
                ],
            ) ?>

    <?= Form::end() ?>
<div>

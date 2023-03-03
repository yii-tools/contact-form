<?php

declare(strict_types=1);

use Yii\FilePond\FilePond;
use Yii\FormModel\FormModelInterface;
use Yii\Forms\ButtonGroup;
use Yii\Forms\Field;
use Yii\Forms\Form;
use Yii\Forms\Input\Text;
use Yii\MarkDownEditor\MarkDownEditor;
use Yii\Materialize\Asset\Cdn\MaterializeAsset;
use Yii\Service\ParameterService;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Http\Method;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\View\WebView;

/**
 * @var AssetManager $assetManager
 * @var string $csrf
 * @var FormModelInterface $form
 * @var ParameterService $parameterService
 * @var UrlGeneratorInterface $urlGenerator
 * @var TranslatorInterface $translator
 * @var WebView $this
 */
$this->setTitle('Contact');

$assetManager->register(MaterializeAsset::class);

/** @psalm-var array $buttonConfig */
$buttonConfig = $parameterService->get('yii-tools/contact-form.materialize.widgets.buttonsGroup');

/** @psalm-var array $fieldConfig */
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

        <?= Field::widget([MarkDownEditor::widget([$form, 'message'])->assetManager($assetManager)->webView($this)])
            ->containerClass('mt-3')
            ->notLabel() ?>

        <?= Field::widget(
                [
                    FilePond::widget([$form, 'attachment'])
                        ->assetManager($assetManager)
                        ->acceptedFileTypes(['image/*'])
                        ->allowMultiple(true)
                        ->imagePreviewMarkupShow(false)
                        ->imagePreviewTransparencyIndicator('#FFFFFF')
                        ->maxFiles(3)
                        ->maxFileSize('10MB')
                        ->translator($translator)
                        ->webView($this),
                ],
            )->notLabel() ?>

        <?= Field::widget([ButtonGroup::widget(definitions: $buttonConfig)])->containerClass('right-align') ?>

    <?= Form::end() ?>
<div>

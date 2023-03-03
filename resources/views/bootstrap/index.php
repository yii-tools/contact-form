<?php

declare(strict_types=1);

use Yii\Bootstrap5\Asset\Cdn\Bootstrap5Asset;
use Yii\BootstrapIcons\Asset\Cdn\BootstrapIconsAsset;
use Yii\FilePond\FilePond;
use Yii\FormModel\FormModelInterface;
use Yii\Forms\ButtonGroup;
use Yii\Forms\Field;
use Yii\Forms\Form;
use Yii\Forms\Input\Text;
use Yii\MarkDownEditor\MarkDownEditor;
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

$assetManager->registerMany([Bootstrap5Asset::class, BootstrapIconsAsset::class]);

/** @psalm-var array $buttonConfig */
$buttonConfig = $parameterService->get('yii-tools/contact-form.bootstrap.widgets.buttonsGroup');

/** @psalm-var array $fieldConfig */
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

        <?= Field::widget([ButtonGroup::widget(definitions: $buttonConfig)]) ?>

    <?= Form::end() ?>
<div>

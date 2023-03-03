<?php

declare(strict_types=1);

use Yii\FilePond\FilePond;
use Yii\FormModel\FormModelInterface;
use Yii\Forms\ButtonGroup;
use Yii\Forms\Field;
use Yii\Forms\Form;
use Yii\Forms\Input\Text;
use Yii\MarkDownEditor\MarkDownEditor;
use Yii\Service\ParameterService;
use Yii\Tailwind\Asset\Cdn\TailwindAsset;
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

$assetManager->register(TailwindAsset::class);

/** @psalm-var array $buttonConfig */
$buttonConfig = $parameterService->get('yii-tools/contact-form.tailwind.widgets.buttonsGroup');

/** @psalm-var array $fieldConfig */
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

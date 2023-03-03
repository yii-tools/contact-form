<?php

declare(strict_types=1);

namespace Yii\ContactForm;

use JsonException;
use Yii\FilePond\Helper\FilePondHelper;
use Yii\FormModel\AbstractFormModel;
use Yii\Validator\HasValidate;
use Yiisoft\Validator\Rule\Email;
use Yiisoft\Validator\Rule\Length;
use Yiisoft\Validator\Rule\Regex;
use Yiisoft\Validator\Rule\Required;

/**
 * The contact form model is used to collect user input on contact page.
 */
final class ContactForm extends AbstractFormModel
{
    use HasValidate;

    private array $attachment = [];
    #[Required, Email, Length(min: 5, max: 20)]
    private string $email = '';
    private string $message = '';
    #[Required, Length(min: 5, max: 20), Regex(pattern: '/^[a-zA-Z0-9\s]+$/')]
    private string $name = '';
    private string $pathUploadFile = '';
    /** @psalm-var string[] */
    private array $saveFiles = [];
    #[Required, Length(min: 5), Regex(pattern: '/^[a-zA-Z0-9\s]+$/')]
    private string $subject = '';

    public function clear(): void
    {
        $this->attachment = [];
        $this->email = '';
        $this->message = '';
        $this->name = '';
        $this->subject = '';
        $this->saveFiles = [];
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @psalm-return string[]
     */
    public function getSaveFiles(): array
    {
        return $this->saveFiles;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @throws JsonException
     */
    public function load(array $data, string $formName = null): bool
    {
        $result = parent::load($data, $formName);

        if ($result && $this->pathUploadFile !== '') {
            /** @psalm-var string[] */
            $this->saveFiles = FilePondHelper::saveWithReturningFiles($this->attachment, $this->pathUploadFile);
        }

        return $result;
    }

    public function setPathUploadFile(string $pathUploadFile): void
    {
        $this->pathUploadFile = $pathUploadFile;
    }
}

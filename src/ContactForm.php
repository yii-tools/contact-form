<?php

declare(strict_types=1);

namespace Yii\ContactForm;

use Yii\FilePond\Helper\FilePondHelper;
use Yii\FormModel\AbstractFormModel;

/**
 * The contact form model is used to collect user input on contact page.
 */
final class ContactForm extends AbstractFormModel
{
    private array $attachment = [];
    private string $email = '';
    private string $message = '';
    private string $name = '';
    private string $pathUploadFile = '';
    private string $subject = '';
    /** @psalm-var string[] */
    private array $saveFiles = [];

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

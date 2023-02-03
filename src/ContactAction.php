<?php

declare(strict_types=1);

namespace Yii\ContactForm;

use cebe\markdown\GithubMarkdown;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yii\Service\MailerService;
use Yii\Service\ParameterService;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Http\Method;
use Yiisoft\Yii\View\ViewRenderer;

/**
 * This ContactAction class is used to handle contact form submission. It will collect the input, validate and send the
 * email to the specified email address.
 */
final class ContactAction
{
    public function run(
        Aliases $aliases,
        ContactForm $contactForm,
        MailerService $mailerService,
        GithubMarkdown $parser,
        ParameterService $parameterService,
        ServerRequestInterface $serverRequest,
        ViewRenderer $viewRenderer
    ): ResponseInterface {
        /** @psalm-var array<string, mixed> */
        $body = $serverRequest->getParsedBody();
        $method = $serverRequest->getMethod();

        $contactForm->setPathUploadFile($aliases->get('@runtime/uploads/'));

        if ($method === Method::POST && $contactForm->load($body)) {
            $message = '';

            if ($contactForm->getMessage() !== '') {
                $message = $parser->parse($contactForm->getMessage());
            }

            $mailerService
                ->attachments($contactForm->getSaveFiles())
                ->from($contactForm->getEmail())
                ->subject($contactForm->getSubject())
                ->signatureImage($aliases->get('@contact-form-mail/images/yii3-signature.png'))
                ->viewPath($aliases->get('@contact-form-mail'))
                ->send(
                    'admin@example.com',
                    [
                        'message' => $message,
                        'name' => $contactForm->getName(),
                    ],
                );

            $contactForm->clear();
        }

        $frameworkCss = (string) $parameterService->get('yii-tools/contact-form.frameworkCss');

        return $viewRenderer
            ->withViewPath('@contact-form-views' . '/' . $frameworkCss)
            ->render('index', ['form' => $contactForm, 'parameterService' => $parameterService]);
    }
}

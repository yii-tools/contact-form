<?php

declare(strict_types=1);

/**
 * @var string $content Mail contents as view render result.
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Contact mail by YiiFramework</title>
    </head>
    <body>
        <?= $content ?>
        <div class = 'mailer-html-p-content'>
            <img src="<?= $file->name() ?>" alt='YiiFramework' />
        </div>
        <div>
            <?= $signatureTextEmail ?>
        </div>
    </body>
</html>

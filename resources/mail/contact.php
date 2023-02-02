<?php

declare(strict_types=1);

use Yii\Html\Helper\Encode;

/**
 * @var array $params
 */
?>

<?= $params['message'] ?>
<p><?= Encode::content($params['name']) ?></p>

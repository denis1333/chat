<?php
use yii\helpers\Html;
?>
<?php foreach ($response as $item): ?>
    <li>
        <?= Html::encode($item->nick) ?>:
    </li>
<?php endforeach; ?>
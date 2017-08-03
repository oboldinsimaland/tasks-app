<?php
use \yii\helpers\Html;
use \yii\helpers\Url;

$complete = $model->is_complete;
?>

<div class="panel panel-default task <?= $complete ? 'complete' : null ?>">

    <div class="panel-body">
        <p><b><?= $model->getAttributeLabel('begin_at') ?>:</b> <?= Html::encode($model->begin_at) ?> </p>
        <p><b><?= $model->getAttributeLabel('end_at') ?>:</b> <?= Html::encode($model->end_at) ?> </p>
        <p><b><?= $model->getAttributeLabel('description') ?>:</b> <?= Html::encode($model->description) ?> </p>
    </div>

    <div class="panel-footer">
        <a href="<?= Url::to([ '/delete', 'id' => $model->id ]) ?>"><span class="glyphicon glyphicon-remove" ></span></a>

        <?php if (!$complete): ?>
        <a href="<?= Url::to([ '/update', 'id' => $model->id ]) ?>"><span class="glyphicon glyphicon-pencil" ></span></a>
        <?php endif; ?>

        <a href="<?= Url::to([ '/complete', 'id' => $model->id, 'complete' => !$complete ]) ?>"><span class="glyphicon glyphicon-ok"></span></a>
    </div>

</div>

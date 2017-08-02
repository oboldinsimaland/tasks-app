<?php
use \yii\helpers\Html;
use \yii\helpers\Url;
use \yii\widgets\LinkPager;

$this->title = 'Список дел';
?>

<div class="site-index">

    <style>
        .task .panel-body {
            font-size: 14pt;
        }

        .task .panel-footer {
            background-color: #a9a9a9;
            text-align: right;
            font-size: 18pt;
            word-spacing: 15pt;
        }

        .task .glyphicon-remove {
            color: #e00;
        }

        .task .glyphicon-pencil {
            color: #00e;
        }

        .task .glyphicon-ok {
            color: #0a0;
        }

        .task.complete .panel-body {
            background-color: #e1e1e1;
        }

        .task.complete .panel-footer {
            background-color: #c1c1c1;
        }

        .task.complete .glyphicon-ok {
            color: #0f0f0f;
        }

    </style>

    <div class="jumbotron">
        <h1>Список дел.</h1>

        <p class="lead">Нажмите кнопку добавить, чтобы добавить новую задачу.</p>

        <p><a class="btn btn-lg btn-success" href="<?= Url::toRoute('/add') ?>">Добавить</a></p>
    </div>

    <?php foreach ($tasks as $task):?>
        <?php $complete = $task->is_complete ? true : false ?>
        <div class="panel panel-default task <?= $complete ? 'complete' : null ?>">

            <div class="panel-body">
                <p><b><?= $task->getAttributeLabel('begin_at')    ?>:</b> <?= Html::encode($task->begin_at)    ?> </p>
                <p><b><?= $task->getAttributeLabel('end_at')      ?>:</b> <?= Html::encode($task->end_at)      ?> </p>
                <p><b><?= $task->getAttributeLabel('description') ?>:</b> <?= Html::encode($task->description) ?> </p>
            </div>

            <div class="panel-footer">
                <a href="<?= Url::to([ '/delete', 'id' => $task->id ]) ?>"><span class="glyphicon glyphicon-remove" ></span></a>

                <?php if (!$complete): ?>
                <a href="<?= Url::to([ '/update', 'id' => $task->id ]) ?>"><span class="glyphicon glyphicon-pencil" ></span></a>
                <?php endif; ?>

                <a href="<?= Url::to([ '/complete', 'id' => $task->id, 'complete' => !$complete ]) ?>"><span class="glyphicon glyphicon-ok"></span></a>
            </div>

        </div>
    <?php endforeach; ?>

    <?= LinkPager::widget(['pagination' => $pagination ]) ?>

    </div>

</div>

<?php
use \yii\helpers\Html;
use \yii\widgets\ListView;

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
        <h1><?= Html::encode($this->title) ?></h1>

        <p class="lead">Нажмите кнопку "добавить", чтобы добавить новую задачу.</p>

        <p>
            <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

    </div>

    <?php echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_task',
    ]);?>

</div>

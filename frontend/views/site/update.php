<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Изменить задачу';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php
$form = ActiveForm::begin([
    'id' => 'update-form',
    'options' => [
        'class' => ['form-horizontal', 'col-lg-4'],
    ],
]);
?>

    <?= $form
            ->field($model, 'begin_at')
            ->textInput(['value' => $task->begin_at,])
            ->hint('Формат: \'yyyy-MM-dd HH:mm:ss+zz\'');
    ?>
    <?= $form
            ->field($model, 'end_at')
            ->textInput(['value' => $task->end_at,])
            ->hint('Формат: \'yyyy-MM-dd HH:mm:ss+zz\'');
    ?>
    <?= $form
            ->field($model, 'description')
            ->textarea(['rows' => 5, 'value' => $task->description,])
            ->hint('Описание поставленной задачи');
    ?>

    <div class="form-group">
        <i>Все поля обязательны к заполнению</i>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary',]) ?>
    </div>

<?php ActiveForm::end() ?>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Publishing */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Publishings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publishing-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Добавить телефон', ['set-phone', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Добавить адрес', ['set-address', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'label' => 'Телефон',
                'value' => $model->phonesNumberList,
            ],
            [
                'label' => 'Книги',
                'value' => $model->booksList,
            ],
            [
                'label' => 'Адрес',
                'value' => $model->address,
            ],
            //'book_id',
            //'address_id',
            //'phone_id',
        ],
    ]) ?>

</div>

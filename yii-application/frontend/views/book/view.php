<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Book */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Добавить изображение', ['set-image', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Просмотреть все изображения', ['view-images', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Добавить автора', ['set-authors', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Добавить издание', ['set-publishing', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Добавить рубрику', ['set-rubric', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
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
                'label' => 'Авторы',
                'value' => $model->authorsList,
            ],
            [
                'format' => 'html',
                'label' => 'Фото',
                'value' => function($data){
                    if(isset($data->mainImage->src)){
                        return Html::img('/uploads/'.$data->mainImage->src, ['width' => '200px']);
                    }else{
                        return false;
                    }
                }
            ],
            [
                'label' => 'Издание',
                'value' => function($data){
                    if(isset($data->publishing->title)){
                        return $data->publishing->title;
                    }else{
                        return false;
                    }
                }
            ],
            //'rubric_id',
            [
                'attribute' => 'rubric_id',
                'value' => function($data){
                    if(isset($data->rubric->title)){
                        return $data->rubric->title;
                    }else{
                        return false;
                    }
                }
            ],
            'date_publishing',            
        ],
    ]) ?>

</div>

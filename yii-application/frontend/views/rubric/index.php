<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RubricSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rubrics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rubric-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rubric', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            //'parent_id',
            [
                'attribute' => 'parent_id',
                'value' => function($data){
                    return ($data->rubric) ? $data->rubric->title : 'Самостоятельная рубрика';
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
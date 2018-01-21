<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Publishing */

$this->title = 'Update Publishing: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Publishings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="publishing-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

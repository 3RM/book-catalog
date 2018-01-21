<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Publishing */

$this->title = 'Create Publishing';
$this->params['breadcrumbs'][] = ['label' => 'Publishings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publishing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Rubric;
use common\components\MenuWidget;

/* @var $this yii\web\View */
/* @var $model common\models\Rubric */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rubric-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group field-rubric-parent_id has-success">
		<label class="control-label" for="rubric-parent_id">Родительская Рубрика</label>
		<select id="rubric-parent_id" class="form-control" name="Rubric[parent_id]" aria-invalid="false">
			<?= MenuWidget::widget(['tpl' => 'book-rubric-select', 'model' => $model, 'selectedRubric' => $selectedRubric]) ?>
		</select>
	</div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



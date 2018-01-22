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

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'parent_id')->textInput() ?>

    <?php //echo $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(Rubric::find()->all(), 'id' , 'title')) ?>

    <div class="form-group field-rubric-parent_id has-success">
		<label class="control-label" for="rubric-parent_id">Родительская Рубрика</label>
		<select id="rubric-parent_id" class="form-control" name="Rubric[parent_id]" aria-invalid="false">
			<option value="0">Самостоятельная Рубрика</option>
			<?= MenuWidget::widget(['tpl' => 'select', 'model' => $model]) ?>
		</select>
	</div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

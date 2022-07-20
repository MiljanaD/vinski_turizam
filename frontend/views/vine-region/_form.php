<?php

use common\models\VineSort;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $update boolean */
/* @var $model common\models\VineRegion */
/* @var $form yii\widgets\ActiveForm */

if($update)
{
    $vineSorts = ArrayHelper::map(\common\models\RegionSort::find()->where(['region_id' => $model->id])->all(), 'sort_id','sort_id');
    foreach ($vineSorts as $vineSort)
    {
        $model->vineSort[] = $vineSort;
    }
}

$sortArray = ArrayHelper::map(VineSort::find()->all(), 'id', 'name');
?>
<div class="vine-region-form w-75 m-auto">

    <?php $form = ActiveForm::begin(['id' => 'vine-region-form']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vineSort')->checkboxList($sortArray,
        [
            'multiple' => 'multiple',
            'class' => 'd-flex flex-column mb-2'

        ]); ?>


    <?= $form->field($model, 'GPS_coordinates')->textInput(['maxlength' => true]) ?>

    <div class="d-flex justify-content-center">
        <?= Html::submitButton('Save', ['class' => 'mt-4 w-50 btn-submit-vinskit btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
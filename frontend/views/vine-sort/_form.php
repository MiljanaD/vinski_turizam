<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\VineSort */
/* @var $form yii\widgets\ActiveForm */
$vineRegions = ArrayHelper::map(\common\models\VineRegion::find()->asArray()->all(),'id', 'name');
?>

<div class="vine-sort-form w-75 m-auto">
<?php Pjax::begin()?>
    <?php $form = ActiveForm::begin(['id' => 'create_vine_sort']); ?>

    <?= $form->field($model, 'name',['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vine_region')->dropDownList($vineRegions) ?>

    <div class="mt-3"><?= $form->field($model, 'imageFile')->fileInput() ?></div>


    <div class="d-flex justify-content-center">
        <?= Html::submitButton('Save', ['class' => 'mt-4 w-50 btn-submit-vinskit btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php \yii\widgets\Pjax::end() ?>
</div>
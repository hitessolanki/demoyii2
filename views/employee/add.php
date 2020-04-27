<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


$form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
            'id' => 'employee-form',
            'enableAjaxValidation' => true,
            'validationUrl' => ['employee/add'],
        ]);
?>
<div class="row">
    <div class="col-sm-4">
        <?php echo $form->field($modelUser, 'first_name')->textInput()->label('First Name')->label('First Name'); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->field($modelUser, 'last_name')->textInput()->label('Last Name')->label('Last Name'); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <img id="imageView" class="image-default" src="<?php echo Yii::$app->request->baseUrl ?>/uploads/default_avatar.jpg">
    </div>
    <div class="col-sm-4">
        <?php echo $form->field($model, 'emp_code')->textInput()->label('Employee Code'); ?>

    </div>
    
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="well-sm"></div>
        <div class="btn btn-xs btn-primary image_browse">PHOTOGRAPH</div>
        <div id="image_name">
            <?php echo $model->photo_data; ?>
        </div>
        <?php echo $form->field($model, 'photo_data')->fileInput(['multiple' => true, 'accept' => 'image/*', 'style' => 'display:none', 'id' => 'btn_select_image'])->label(FALSE) ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->field($modelUser, 'email_id')->textInput(['class' => 'form-control'])->label('Email Id'); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->field($modelUser, 'is_admin')->checkbox(['class' => 'is-admin']); ?>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-white" id="close" data-dismiss="modal">Cancel</button>
    <?= Html::submitButton('Save', ['class' => "ladda-button ladda-button-select-finalyear btn btn-sm btn-primary"]) ?>
</div>
<?php ActiveForm::end(); ?>
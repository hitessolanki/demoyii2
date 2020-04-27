<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employee Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="modalsm" class="modal fade" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title"><span class="fa fa-user-secret"></span> Add Employee</h3>
            </div>
            <div class="modal-body">
                <div id='modalContent'></div>
            </div>
        </div>
    </div>  
</div>
<div class="employee-master-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
         <?= Html::a('Create Employee', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'emp_code',
            'full_name',
            'joining_date',
            'designation',
            'status',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
<?php
$script = <<< JS
        
    //Set Add Button and Delete Button
    $('[data-toggle="tooltip"]').tooltip();
    //Add Tooltip functionality Status
        $('[data-toggle="tooltip_status"]').tooltip();    
    //Open Modal And Saved
    $(".openModal").click(function(){
        $("#modalsm").modal("show");
        $("#modalsm").find("#modalContent").load($(this).attr("url"));
    });
JS;
$this->registerJs($script);        
?>
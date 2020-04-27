<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EmployeeMaster */

$this->title = 'Update Employee Master: ' . $model->emp_code;
$this->params['breadcrumbs'][] = ['label' => 'Employee Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->emp_code, 'url' => ['view', 'id' => $model->emp_code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="employee-master-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

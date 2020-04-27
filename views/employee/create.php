<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EmployeeMaster */

$this->title = 'Create Employee Master';
$this->params['breadcrumbs'][] = ['label' => 'Employee Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-master-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

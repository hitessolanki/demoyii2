<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-master-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'first_name',
            'last_name',
            'username',
            //'original_password',
            'email_id:email',
            //'auth_key',
            //'status',
            //'file_id',
            //'is_deleted',
            //'created_at',
            //'updated_at',
            //'last_visited_at',
            //'is_admin',
            //'password_reset_token',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

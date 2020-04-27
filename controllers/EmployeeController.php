<?php

namespace app\controllers;

use Yii;
use app\models\EmployeeMaster;
use app\models\EmployeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UserMaster;
use app\components\FileNamewidget;
use yii\helpers\Html;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;
/**
 * EmployeeController implements the CRUD actions for EmployeeMaster model.
 */
class EmployeeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all EmployeeMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EmployeeMaster model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EmployeeMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EmployeeMaster();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->emp_code]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionAdd()
    {
        $modelMaster = new EmployeeMaster();
        $modelUser = new UserMaster();
        if (Yii::$app->request->isAjax && $modelMaster->load(Yii::$app->request->post())) {
            $modelUser->load(Yii::$app->request->post());
            Yii::$app->response->format = Response::FORMAT_JSON;
            $err = ActiveForm::validate($modelMaster);
            $err1 = ActiveForm::validate($modelUser);
            return array_merge($err, $err1);
        }

        //Load modal usermaster and employee master and save the data
        if ($modelUser->load(Yii::$app->request->post()) && $modelMaster->load(Yii::$app->request->post())) {

            // Photo size validation 
            Yii::$app->response->format = Response::FORMAT_JSON;
            $err = ActiveForm::validate($modelMaster);
            if (isset($_FILES)) {
                $fileSize = $_FILES['EmployeeMaster']['size']['photo_data'];
                if ($fileSize > 512000) {
                    return $model->addError('photo_data', "Message error.");
                }
            }

            $email_id = Yii::$app->request->post('UserMaster')['email_id'];
            $is_admin = Yii::$app->request->post('UserMaster')['is_admin'];
            $modelUser->is_admin = $is_admin;
            $created_at = time();
            $updated_at = time();
            //Random name store
            $randUsername = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), -5);
            $pwdLength = 8;
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
            $userPassword = substr(str_shuffle($chars), 0, $pwdLength);
            $modelUser->username = $randUsername;
            $modelUser->created_at = $created_at;
            $modelUser->updated_at = $updated_at;
            $modelUser->auth_key = md5($userPassword);
            $modelUser->original_password = $userPassword;
            $modelUser->password = \Yii::$app->security->generatePasswordHash($userPassword);
            $modelUser->email_id = $email_id;
            //File Saved the data
            $file = $_FILES['EmployeeMaster']['name'];
            //Save data
            $modelUser->photo_data = $file['photo_data'];
            if ($modelUser->validate() && $modelMaster->validate()) {
                $modelUser->save();
                $user = UserMaster::findOne([
                            'status' => UserMaster::STATUS_ACTIVE,
                            'email_id' => $email_id,
                ]);
                if (!$user) {
                    return false;
                }
                if (!UserMaster::isPasswordResetTokenValid($user->password_reset_token)) {
                    $user->generatePasswordResetToken();
                }
                $user->verify_status = 0;
                if (!$user->save()) {
                    return false;
                }

                $modelMaster->user_id = $modelUser->id;
                $modelMaster->photo_data = UploadedFile::getInstance($modelMaster, 'photo_data');

                //Find Image Name
                if ($modelMaster->photo_data !== "" && !empty($modelMaster->photo_data)) {
                    $modelMaster->upload();
                    $image_name = explode('.', $modelMaster->photo_data->name);
                    $modelMaster->photo_data = FileNamewidget::getimage($image_name);
                }

                // Check validation for model master table
                if ($modelMaster->validate()) {
                    $modelMaster->created_at = $created_at;
                    $modelMaster->updated_at = $updated_at;
                    print_r("hello");exit;
                   return $this->redirect(['employee/index', 'model' => $modelMaster]);
                }

                // Implement success flash message 
                Yii::$app->session->setFlash("employee_succes", "Employee created successfully.");
            }
        }

        // Get All Active location
        
        return $this->renderAjax('add', ['model' => $modelMaster, 'modelUser' => $modelUser]);
    
    }

    /**
     * Updates an existing EmployeeMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->emp_code]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EmployeeMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EmployeeMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return EmployeeMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EmployeeMaster::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

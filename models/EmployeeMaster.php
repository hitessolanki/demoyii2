<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee_master".
 *
 * @property string $emp_code
 * @property string $full_name
 * @property string|null $joining_date
 * @property string|null $designation
 * @property int $status 1:Active,0:Inactive
 * @property int $created_at
 * @property int $updated_at
 */
class EmployeeMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['emp_code', 'full_name'], 'required'],
            [['joining_date','photo_data'], 'safe'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['emp_code'], 'string', 'max' => 10],
            [['full_name', 'designation'], 'string', 'max' => 100],
            [['emp_code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'emp_code' => 'Emp Code',
            'full_name' => 'Full Name',
            'joining_date' => 'Joining Date',
            'designation' => 'Designation',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function upload() {
        $file = $_FILES['EmployeeMaster']['name'];
        $name = $file['photo_data'];
        $image_name = explode('.', $name);
        $this->photo_data->saveAs('uploads/employee/' . FileNamewidget::getimage($image_name));
    }
}

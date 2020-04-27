<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_master".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $password
 * @property string $original_password
 * @property string $email_id
 * @property string $auth_key
 * @property int $status 0:inactive 1:Active 2:block 3:admin block
 * @property int|null $file_id
 * @property int $is_deleted 0:Not deleted 1:Deleted
 * @property int $created_at
 * @property int $updated_at
 * @property int $last_visited_at
 * @property int $is_admin 1:admin
 * @property string|null $password_reset_token
 */
class UserMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'username', 'password', 'original_password', 'email_id', 'auth_key'], 'required'],
            [['status', 'file_id', 'is_deleted', 'created_at', 'updated_at', 'last_visited_at', 'is_admin'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 50],
            [['username', 'original_password', 'email_id', 'password_reset_token'], 'string', 'max' => 255],
            [['photo_data'], 'safe'],
            [['password', 'auth_key'], 'string', 'max' => 128],
            [['email_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'username' => 'Username',
            'password' => 'Password',
            'original_password' => 'Original Password',
            'email_id' => 'Email ID',
            'auth_key' => 'Auth Key',
            'status' => 'Status',
            'file_id' => 'File ID',
            'is_deleted' => 'Is Deleted',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'last_visited_at' => 'Last Visited At',
            'is_admin' => 'Is Admin',
            'password_reset_token' => 'Password Reset Token',
        ];
    }
}

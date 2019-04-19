<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $photo
 * @property int $isAdmin
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['isAdmin'], 'integer'],
            [['name', 'email', 'password', 'photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'photo' => 'Photo',
            'isAdmin' => 'Is Admin',
        ];
    }


    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['user_id' => 'id']);
    }


    public static function findIdentity($id)
    {
        return User::findOne($id);
    }


    public function getId()
    {
        return $this->id;
    }


    public function getAuthKey()
    {

    }


    public static function findIdentityByAccessToken($token, $type = null)
    {

    }


    public function validateAuthKey($authKey)
    {

    }


    public static function findByEmail($email)
    {
        return User::find()->where(['email' => $email])->one();
    }


    public function validatePassword($password)
    {
        return ($this->password == $password) ? true : false;
    }


    public function create()
    {
        return $this->save(false);
    }


    public function saveFromVk($uid, $first_name, $photo)
    {
        $user = User::findOne($uid);

        if ($user)
        {
            return Yii::$app->user->login($user);
        }
        
        $this->id = $uid;
        $this->name = $first_name;
        $this->photo = $photo;
        $this->create();


        return Yii::$app->user->login($this);
    }


    public function getImage()                                         // метод вывода картинки
    {
        return $this->photo;
    }

    public function getAdmin()
    {
        return User::find()->where(['isAdmin' => 1])->one();
    }
}

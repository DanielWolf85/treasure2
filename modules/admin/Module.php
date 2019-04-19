<?php

namespace app\modules\admin;


use Yii;
/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $layout = '/admin';
    public $controllerNamespace = 'app\modules\admin\controllers';



    // сокрытие админки
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'denyCallback' => function($rule, $action)      // если не админ
                {
                    throw new \yii\web\NotFoundHttpException();
                },
                'rules' => [
                  [  'allow' => true,
                    'matchCallback' => function($rule, $action)         // если админ
                    {
                        return Yii::$app->user->identity->isAdmin;
                    }
                  ]
                ]
            ]
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}

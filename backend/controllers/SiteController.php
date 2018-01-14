<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\base\Model;
use common\models\User;
use backend\models\UserEditForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'edit', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
         $allUsers = User::findAll([
            'status' =>  10,
        ]);
        $data = array();
        foreach ($allUsers as $user) {
            $usern['id'] = $user->id;
            $usern['login'] = $user->username;
            $usern['email'] = $user->email;
            $data[] = $usern;
        }
        return $this->render('index', [
                'users' => $data,
            ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    /**
     * editUser action.
     *
     * @return string
     */
    public function actionEdit()
    {
        $id = $_GET['id'];
        $model = new UserEditForm($id);
        if ($model->load(Yii::$app->request->post()) && $model->edit()) {
            
            return $this->render('edit', [
            'model' => $model,
        ]); 
        }
 
        return $this->render('edit', [
            'model' => $model,
        ]);
    }
    
    public function actionDelete()
    {
        $id = $_GET['id'];
        $model = User::findIdentity($id);
        if ($model){
            $model->delete();
        }
        return $this->goBack();
    }
}

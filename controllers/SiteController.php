<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use app\models\SignupForm;
use app\models\User;
use yii\base\Security;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    /**
     * User action.
     *
     * @return Response|string
     */
    public function actionEntry()
    {
        $model = new EntryForm();

        //Несколько независимых блоков
        $security = new Security();
        $randomString = $security->generateRandomString();
        $randomKey = $security->generateRandomKey();

        //Использование форм
        $string = Yii::$app->request->post('string');
        $stringHash = '';

        if (!is_null($string)) {
            $stringHash = $security->generatePasswordHash($string);
        }

        if ($model->load(Yii::$app->request->post())/* && $model->validate()*/) {

            /* Передача формы в телеграм бот
            https://api.telegram.org/bot1070380528:AAGFeLWfhsl4yrvl_6EuZij9gdSqBZV4dQo/getUpdates,
            где, XXXXXXXXXXXXXXXXXXXXXXX - токен вашего бота, полученный ранее */

            $token = "1070380528:AAGFeLWfhsl4yrvl_6EuZij9gdSqBZV4dQo";
            $chat_id = "-361113943"; //https://www.youtube.com/watch?v=Df-XGBabjv4
            $arr = array(
                'Имя пользователя: ' => $model->name,
                'Email: ' => $model->email,
                'Телефон:' => $model->phone
            );
            $txt = null;

            foreach ($arr as $key => $value) {
                $txt .= "<b>" . $key . "</b> " . $value . "%0A";
            };

            $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}", "r");

            /**
             *  добавить данные из формы в mongoDB
             */
            $modelMongoDB = new EntryForm;
            $modelMongoDB->_id = date('');
            $modelMongoDB->name = $model->name;
            $modelMongoDB->email = $model->email;
            $modelMongoDB->phone = $model->phone;


            // if ($sendToTelegram) {                                
            //     return  $modelMongoDB->save() ? $model : null;
            // } else {
            //     return  "Error";
            // }


            /* ----------------------------- */

            return $this->render(
                'entry-confirm',
                [
                    'model' => $model,
                    'modelMongoDB' => $modelMongoDB
                ]
            );
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render(
                'entry',
                [
                    'model' => $model,
                    'time' => date('H:i:s'),
                    //Несколько независимых блоков
                    'randomString' => $randomString,
                    'randomKey' => $randomKey,
                    //Использование форм
                    'stringHash' => $stringHash,
                ]
            );
        }
    }



    /**
     * Displays add admin page.
     *
     * @return Response|string
     */
    public function actionAdmin()
    {
        $model = User::find()->where(['username' => 'admin'])->one();
        if (empty($model)) {
            $user = new User();
            $user->username = 'admin';
            $user->email = 'admin@devreadwrite.com';
            $user->setPassword('admin');
            $user->generateAuthKey();
            if ($user->save()) {
                echo 'good';
                Yii::$app->session->setFlash('success', "Вы успешно зарегистрировались");
            }
        }
    }

    /**
     * Displays signup page.
     *
     * @return Response|string
     */
    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new SignupForm();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    Yii::$app->session->setFlash('success', "Вы успешно зарегистрировались");
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', ['model' => $model]);
    }
}

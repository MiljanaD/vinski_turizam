<?php

namespace frontend\controllers;

use common\models\Adresa;
use common\models\Municipality;
use common\models\RegionSort;
use common\models\Street;
use common\models\VineRegion;
use common\models\VineService;
use common\models\VineSort;
use common\models\Winery;
use common\models\WineryService;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\debug\panels\EventPanel;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use common\models\SignupForm;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup', 'login'],
                'rules' => [
                    [
                        'actions' => ['signup','login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
//                    'logout' => ['post'],
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
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->request->isAjax)
        {
            $search = $this->request->post()['val'];
            $target = $this->request->post()['target'];
            if($target == 'winery') {
                $municipality = Municipality::find()->where(['like', 'name', $search])->all();
                $municipalityIds = [];
                foreach ($municipality as $item) {
                    $municipalityIds[] = $item->id;
                }
                $streets = Street::find()->where(['municipality_id' => $municipalityIds])->all();
                $streetIds = [];
                foreach ($streets as $item) {
                    $streetIds[] = $item->id;
                }
                $services = VineService::find()->where(['like', 'name', $search])->all();
                $servicesIds = [];
                foreach ($services as $item) {
                    $servicesIds[] = $item->id;
                }
                $wineryService = WineryService::find()->where(['service_id' => $servicesIds])->all();
                $wineryIds = [];
                foreach ($wineryService as $item) {
                    $wineryIds[] = $item->winery_id;
                }
                $wineries = Winery::find()->where(['street' => $streetIds])->orWhere(['id' => $wineryIds])->all();
                $regions = VineRegion::find()->all();
            }
            else if($target == 'region') {
                $vineSort = VineSort::find()->where(['like', 'name', $search])->all();
                $vineSortIds = [];
                foreach ($vineSort as $sort) {
                    $vineSortIds[] = $sort->id;
                }
                $regionSort = RegionSort::find()->where(['sort_id' => $vineSortIds])->all();
                $regionIds = [];
                foreach ($regionSort as $item) {
                    $regionIds[] = $item->region_id;
                }
                $regions = VineRegion::find()->where(['like', 'name', $search])->orWhere(['id' => $regionIds])->all();
                $wineries = Winery::find()->all();
            }
            return $this->render('index', ['regions' => $regions, 'wineries' => $wineries]);
        }
        else {
            $regions = VineRegion::find()->all();
            $wineries = Winery::find()->all();
            return $this->render('index', ['regions' => $regions, 'wineries' => $wineries]);
        }



    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if(Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->login(Yii::$app->request->post()['LoginForm']['password'])) {
                return $this->goHome();
            }
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->signup(Yii::$app->request->post()['Street']['name'])) {
                Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
                return $this->goHome();
            }
        }
        else if (!Yii::$app->request->isAjax) {
            return $this->goHome();
        }
        else {
            return $this->renderAjax('signup', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @return yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
            var_dump($model);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->set('admin', false);
            Yii::$app->session->setFlash('success', 'Vaša email adresa je verifikovana!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

}

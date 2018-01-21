<?php

namespace frontend\controllers;

use Yii;
use common\models\Publishing;
use common\models\PublishingSearch;
use common\models\PublishingPhone;
use common\models\PublishingAddress;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PublishingController implements the CRUD actions for Publishing model.
 */
class PublishingController extends Controller
{
    public $layout = 'crud';
    /**
     * @inheritdoc
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
     * Lists all Publishing models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PublishingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Publishing model.
     * @param integer $id
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
     * Creates a new Publishing model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Publishing();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Publishing model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Publishing model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Publishing model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Publishing the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Publishing::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSetPhone($id)
    {
        $publishing = Publishing::findOne($id);

        $model = new PublishingPhone();
        
        if(Yii::$app->request->isPost){
            $model->phone = Yii::$app->request->post('PublishingPhone')['phone'];
            $model->publishing_id = $publishing->id;
            $model->save();

            return $this->redirect(['view', 'id' => $publishing->id]);
        }

        return $this->render('phone', ['model' => $model]);
    }

    public function actionSetAddress($id)
    {

        $publishing = $this->findModel($id);

        $address_model = new PublishingAddress();

        $publishing->clearAddress($id);

        if(Yii::$app->request->isPost){
            $address_model->street = Yii::$app->request->post('PublishingAddress')['street'];
            $address_model->number = Yii::$app->request->post('PublishingAddress')['number'];
            $address_model->publishing_id = $publishing->id;
            $address_model->save();

            return $this->redirect(['view', 'id' => $publishing->id]);
        }

        return $this->render('address', ['model' => $address_model]);
    }
}

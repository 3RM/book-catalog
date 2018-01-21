<?php

namespace frontend\controllers;

use Yii;
use common\models\Book;
use common\models\Author;
use common\models\Publishing;
use common\models\ImageUpload;
use yii\web\UploadedFile;
use common\models\BookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
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
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Book model.
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
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Book();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Book model.
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
     * Deletes an existing Book model.
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
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param integer $id
     * @return book view | image form view
     */
    public function actionSetImage($id)
    {

        $model = new ImageUpload();

        if(Yii::$app->request->isPost){

            $book = Book::findOne($id);
            $file = UploadedFile::getInstance($model, 'image');
            
            if($book->saveImage($model->uploadImage($file)))
            {
                return $this->redirect(['view', 'id' => $book->id]);
            }
        }

        return $this->render('image', compact('model'));
    }

    public function actionViewImages($id)
    {
        $model = $this->findModel($id);

        $images = $model->getGalleryUrls($id);

        return $this->render('view-images', compact('images'));
    }

    public function actionSetAuthors($id)
    {
        $book = $this->findModel($id);

        $selectedAuthors = $book->getSelectedAuthors();

        $authors = ArrayHelper::map(Author::find()->all(), 'id', 'title');

        if(Yii::$app->request->isPost){
            $authors = Yii::$app->request->post('authors');
            $book->saveAuthors($authors);

            return $this->redirect(['view', 'id' => $book->id]);
        }

        return $this->render('authors', compact('selectedAuthors', 'authors'));

    }

    public function actionSetPublishing($id)
    {
        $book = $this->findModel($id);

        $selectedPublishing = $book->getSelectedPublishing();

        $publishing = ArrayHelper::map(Publishing::find()->all(), 'id', 'title');

        if(Yii::$app->request->isPost){
            $publishing_id = Yii::$app->request->post('publishing');
            $book->savePublishing($publishing_id);

            return $this->redirect(['view', 'id' => $book->id]);
        }

        return $this->render('publishing', compact('selectedPublishing', 'publishing'));
    }
}

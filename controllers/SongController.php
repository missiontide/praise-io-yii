<?php

namespace app\controllers;

use app\models\Song;
use app\models\SongSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * SongController implements the CRUD actions for Song model.
 */
class SongController extends Controller
{
    /**
     * List of allowed domains.
     * Note: Restriction works only for AJAX (using CORS, is not secure).
     *
     * @return array List of domains, that can access to this API
     */
    public static function allowedDomains()
    {
        return [
            // '*',                        // star allows all domains
            'http://localhost:3000',
        ];
    }
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                // For cross-domain AJAX request
                'corsFilter'  => [
                    'class' => \yii\filters\Cors::className(),
                    'cors'  => [
                        // restrict access to domains:
                        'Origin'                           => static::allowedDomains(),
                        'Access-Control-Request-Method'    => ['GET'],
                        'Access-Control-Allow-Credentials' => true,
                        'Access-Control-Max-Age'           => 3600, // Cache (seconds)
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Song models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SongSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Returns list in JSON of all Song models.
     * @return array
     */
    public function actionAll()
    {
        $this->response->format = \yii\web\Response::FORMAT_JSON;

        $provider = new ActiveDataProvider([
           'query' => Song::find()->select(['id', 'title', 'artist']),
            'pagination' => false,
        ]);

        return $provider->getModels();
    }

    /**
     * Returns list in JSON of matching-id Song models with lyrics.
     * @param int $ids comma-delineated list of IDs
     * @return array
     */
    public function actionLyrics($ids)
    {
        $this->response->format = \yii\web\Response::FORMAT_JSON;
        $ids = explode(',', $ids);

        $provider = new ActiveDataProvider([
            'query' => Song::find()->select(['id', 'title', 'artist', 'lyrics'])->where(['in', 'id', $ids]),
            'pagination' => false,
        ]);

        return $provider->getModels();
    }

    /**
     * Displays a single Song model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Song model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Song();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Song model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Song model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Song model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Song the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Song::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

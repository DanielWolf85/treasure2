<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Article;
use app\models\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ImageUpload;
use yii\web\UploadedFile;
use app\models\Category;
use yii\helpers\ArrayHelper;
use app\models\Tag;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
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
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();

        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->saveArticle()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Article model.
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
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)                   // этот метод возвращает модель по id
    {
        if (($model = Article::findOne($id)) !== null) {        // если модель существует
            return $model;                                          // возвращаем модель
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    
    
    public function  actionSetImage($id)        // экшен установки картинки
    {
        $model = new ImageUpload;                   // здесь в $model присваиваем новый объект Image Upload.. это наша модель, специально созданная для загрузки картинки
        
        if (Yii::$app->request->isPost)                 // если в request массив post не пустой (если кнопка была нажата)
        {
            $article = $this->findModel($id);               // присваиваем $article всю модель (модель статьи)

            $file = UploadedFile::getInstance($model, 'image');     // присваиваем $file всю информацию о картинке
            
            
            if ($article->saveImage($model->uploadFile($file, $article->image)))  // если это существует (обращение к методу saveImage модели и сохранение картинки в базу данных)
            {
                return $this->redirect(['view', 'id' => $article->id]);         // перенаправляем пользоавателя на страницу view.. в вид передаем id статьи
            }
                    
        }
        
        return $this->render('image', ['model' => $model]);         // рендерим страницу вида image.. передаем туда модель
    }
    
    
    
    public function actionSetCategory($id)                          // экшен установки категории.. передаем сюда $id статьи
    {
        
        $article = $this->findModel($id);                           // присваиваем $article всю модель (модель статьи)
        $selectedCategory = $article->category->id;                 // готовим значение категории для формы
        
        
        // генерируем массив из базы вида id => title и передаем его потом в вид для вывода в списке категорий
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');
        
        
        if (Yii::$app->request->isPost)         // если форма была отправлена
        {
            $category = Yii::$app->request->post('category');       // получаем id категории
            if ($article->saveCategory($category))                      // обращаемся к методу сохранения категории в модели.. Если сохранение прошло успешно, то
            {
                return $this->redirect(['view', 'id' => $article->id]);         // редтректим пользователя на просмотр view
            }
            
        }
        
        
        return $this->render('category', [
            'article' => $article,
            'selectedCategory' => $selectedCategory,
            'categories' => $categories,
        ]);
    }
    
    
    public function actionSetTags($id)
    {
        $article = $this->findModel($id);
        $selectedTags = $article->getSelectedTags();
       
        $tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');
        
        if (Yii::$app->request->isPost)
        {
            $tags = Yii::$app->request->post('tags');
            $article->saveTags($tags);
            return $this->redirect(['view', 'id' => $article->id]);
        }
        
        return $this->render('tags', [
            'selectedTags' => $selectedTags,
            'tags' => $tags,
        ]);
    }
}

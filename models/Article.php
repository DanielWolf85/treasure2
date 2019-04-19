<?php

namespace app\models;
use app\models\ImageUpload;
use yii\data\Pagination;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $data
 * @property string $description
 * @property string $content
 * @property string $image
 * @property int $viewed
 * @property int $user_id
 * @property int $category_id
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'description', 'content'], 'string'],
            [['data'], 'date' , 'format' => 'php:Y-m-d'],
            [['data'], 'default', 'value' => date('Y-m-d')],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'data' => 'Data',
            'description' => 'Description',
            'content' => 'Content',
            'image' => 'Image',
            'viewed' => 'Viewed',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
        ];
    }
    
    public function saveImage($filename)            // сохраняет картинку в базу банных
    {
        $this->image = $filename;                   // присваивает свойству $image название картинки $filename
        return $this->save(false);                  // возвращает сохранение.. false говорит о том, что сохранение происходит без стандартной валидации
    }
    
    
    public function beforeDelete()
    {
        $this->deleteImage();
        return parent::beforeDelete();
    }
    
    
    
    public function getImage()                                         // метод вывода картинки
    {
        if ($this->image)                                               // если картинка существует
        {
            return '/uploads/' . $this->image;                   // возвращаем картинку
        }
        return '/no-image.png';                                         // иначе ссобщаем об ее отсутствии
    }
    
    
    public function deleteImage()                   // метод удаления вызываем его на beforeDelete.. вызывается при нахатии на кнопку delete на панели администратора
    {
        $imageUploadModel = new ImageUpload();      // создаем экземпляр нашей модели ImageUpload
        $imageUploadModel->deleteCurrentImage($this->image);       // ичпользуем ее, а именно созданный нами метод удаления картинки
    }
    
    
    public function getCategory()                               // добавление связей между статьей и категориями
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);           // здесь мы связываем статьи с моделью категорий на основе id и category_id
    }
    
    
    
    public function saveCategory($category_id)                 // сохраняет категорию в базу
    {
        $category = Category::findOne($category_id);            // выбираем одну категорию, которую хотим привязать к этой модели
        
        if ($category != null)                                  // проверяем ее существование
        {
            $this->link('category', $category);                 // здесь прописываем название связи и следом передаем с кем связываем
            return true;                                        // возвращаем true
        }
        
    }
    
    
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->viaTable('article_tag', ['article_id' => 'id']);
    }
    
    
    public function getSelectedTags()
    {
        $selectedIds = $this->getTags()->select('id')->asArray()->all();       // здесь так.. выбрать все теги из базы по id  в виде массива и выбрать все
        return \yii\helpers\ArrayHelper::getColumn($selectedIds, 'id');
    }
    
    
    public function saveTags($tags)
    {
        if (is_array($tags))
        {
            $this->clearCurrentTags();
            
            foreach ($tags as $tag_id)
            {
                $tag = Tag::findOne($tag_id);
                
                $this->link('tags', $tag);
            }
        }
    }
    
    
    public function clearCurrentTags()
    {
        ArticleTag::deleteAll(['article_id' => $this->id]);
    }


    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->data);
    }


    public static function getAll($pageSize = 5)
    {
        // build a DB query to get all articles with status = 1
        $query = Article::find();

        // get the total number of articles (but do not fetch the article data yet)
        $count = $query->count();

        // create a pagination object with the total count
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);

        // limit the query using the pagination and retrieve the articles
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $data['articles'] = $articles;
        $data['pagination'] = $pagination;

        return $data;
    }


    public static function getPopular()
    {
        return Article::find()->orderBy('viewed desc')->limit(3)->all();
    }


    public static function getRecent()
    {
        return Article::find()->orderBy('data asc')->limit(3)->all();
    }
    
    
    public function saveArticle()
    {
        $this->user_id = Yii::$app->user->id;
        return $this->save();
    }


    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['article_id' => 'id']);
    }
}

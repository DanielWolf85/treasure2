<?php

namespace app\models;

use yii\base\Model;
use Yii;

class CommentForm extends Model
{
    public $comment;

    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['coment'], 'string', 'length' => [3,250]],
        ];
    }


    public function saveComment($article_id)
    {
        $comment = new Comment();
        $comment->text = $this->comment;
        $comment->user_id = Yii::$app->user->id;
        $comment->article_id = $article_id;
        $comment->status = 0;                    // если статус комменария 0, то он ждет подтверждения
        return $comment->save();
    }
}
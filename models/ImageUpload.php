<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model                         // это дополнительная модель ImageUpload.. специально для загрузки картинки
{
    public $image;                                      // это свойство, в которое зпишется картинка
    
    
    
    public function rules()                             // правила валидации картинки
    {
        return [
            [['image'], 'required'],                             // image обязателен к заполнению
            [['image'], 'file', 'extensions' => 'jpg,png']       // загружаемый файл должен быть либо формата jpg либо png
        ];
    }


    
    
    public function uploadFile(UploadedFile $file, $currentImage)              // метод загрузки картинки.. Принимает итформацию о катинке $file и ее текущее название $currentImage
    {
        
        $this->image = $file;                           // присваиваем свойству image полученную информацию о картинке (из котроллера)
        
        
        if ($this->validate())                                                          // если все прошло php-валидацию.. на случай, если java-script будет выключен
        {
            
            $this->deleteCurrentImage($currentImage);                // местный метод удаление каринки.. передаем в него имя текущей, которую надо удалить
    
            
            return $this->saveImage();                        // обращаемся к методу saveImage, который генерирует уникальное название картинки и сохраняет ее в указанной директории   

        }
    }
    
    
    public function deleteCurrentImage($currentImage)                    // удаление старой картинки
    {
        if ($this->fileExists($currentImage))                           // если старая картинка существует в папке uploads (здесь используем медод проверки существования файла fileExist)
            {
                unlink($this->getFolder() . $currentImage);             // то удаляем старую картинку со старым именем
            }
    }
    
    
    public function saveImage()                                         // загрузка картинки с новым уникальным именем
    {
        $filename = $this->generateFilename();      // трансформируем название картинки в уникальное и ложим в $filename
        
        $this->image->saveAs($this->getFolder() . $filename);          // здесь сохраняем новую картинку в указанной директории 
        
        return $filename;
    }
    
    
    


    
    public function fileExists($currentImage)                           // метод проверки существования файла
    {
        if (!empty($currentImage) && $currentImage != null)             // если название не пусто и не равно null
        {
            return file_exists($this->getFolder() . $currentImage);         // здесь возвращаем существует ли файл  или нет (директорию узнаем с помощью метода getFolder)
        }
        
    }
    
    
    
    private function getFolder()                             // возвращает директорию с загрузками uploads
    {
        return Yii::getAlias('@web') . 'uploads/';
    }
    
    
    private function generateFilename()                      // генерирует уникальное имя картинки
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
    }   
    
}

<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\Books;
use app\models\Categories;
use app\models\BookCategory;
use app\modules\admin\models\Options;

class ParseController extends Controller
{

    public function actionIndex($url = '/var/www/html/123/books.json')
    {
        $options = Options::findOne(1);
        $url = $options->link;
        // Получаем контент в виде массива
        $json = file_get_contents($url);
        $content = json_decode($json, true);

        // Записываем в базу
        foreach ($content as $item) {
            // Проверка на повтор
            if (isset($item['isbn'])) {
                $isRepeat = Books::find()->select('isbn')->where('isbn=:isbn')->addParams([':isbn' => $item['isbn']])->one();
            } else {
                $isRepeat = Books::find()->select('title')->where('title=:title')->addParams([':title' => $item['title']])->one();
            }

            if (empty($isRepeat)) {

                // Записываем в базу
                $isRepeat = NULL;
                $books = new Books();
                $books->title = $item['title'] ?? '';
                $books->isbn = $item['isbn'] ?? '';
                $books->description = $item['shortDescription'] ?? '';
                $books->page_count = $item['pageCount'] ?? '';
                $books->thumbnail = $item['thumbnailUrl'] ?? '';

                if ($books->thumbnail) {
                    // Загружаем файл в директорию
                    $dir = Yii::$app->getBasePath() . '/web/';
                    // Получаем расширение файла
                    preg_match('/\.\w+$/', $books->thumbnail, $imageSlug);
                    // Формируем файл
                    $image = 'books/' . uniqid() . $books->isbn . $imageSlug[0] ?? '';
                    // Записываем по isbn
                    $response = get_headers($books->thumbnail);
                    if ($response[0] == 'HTTP/1.1 200 OK') {
                        if ($image && file_put_contents($dir . $image, fopen($books->thumbnail, 'r'))) {
                            $books->image_name = $image;
                        } else {
                            echo "Ошибка записи изображения\n";
                        }
                    } else {
                        echo $response[0];
                    }
                }

                $books->status = $item['status'] ?? '';
                $books->autors = serialize($item['authors']);

                // Категории записываем в отдельную таблицу
                $categories = $item['categories'];
                $books->save();

                foreach ($categories as $category) {
                    // Если нету
                    $repeat = Categories::find()->where('title=:title')->addParams([':title' => $category])->one();
                    if (empty($repeat)) {
                        $cat = new Categories();
                        $cat->title = $category;
                        // Записываю алиас для ЧПУ
                        $cat->category_alias = strtolower(str_replace(' ', '-', strip_tags($category)));
                        $cat->save();
                        $books->link('categories', $cat);
                    } else {
                        $books->link('categories', $repeat);
                    }
                }

            }

        }
    }
}

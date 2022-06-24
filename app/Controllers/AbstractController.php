<?php

namespace App\Controllers;

use Exception;

abstract class AbstractController{
    public function render($view, $parameters = []) {
        // Заменяем слэши из ссылки на вид сепаратором
        $view = implode(DIRECTORY_SEPARATOR, explode('/', $view));

        // Импортируем переменные из массива в текущую таблицу символов
        extract($parameters, EXTR_SKIP);

        // Создаем полный путь с корневой папки до файла вида
        $view = $GLOBALS['path']['views'] . $view;

        // Отображаем вид если соответствующий файл существует, выдаем исключение если нет
        if (is_readable($view)) {
            require $view;
        } else {
            throw new Exception("Файл на вид по пути '$view' не найден.");
        }
    }

    public function layout($view){
        // Заменяем слэши из ссылки на блоки сепаратором
        $view = implode(DIRECTORY_SEPARATOR, explode('/', $view));

        // Возвращаем полный путь с корневой папки до файла вида блока
        return $GLOBALS['path']['layouts'] . $view;}

    public function image($file){
        // Заменяем слэши из ссылки на изображение сепаратором
        $file = implode(DIRECTORY_SEPARATOR, explode('/', $file));    

        // Определяем полный путь с корневой папки до изображения
        $path = $GLOBALS['path']['dev'] . $file;

        // Выявляем расширение изображения и объявляем переменную изображения
        $ext = mb_strtolower(pathinfo($path)['extension']);
        $img = null;

        // Кодируем изображение из полученной ссылки в формат base64
        if (in_array($ext, ['jpeg', 'jpg', 'gif', 'png', 'webp', 'svg'])) {
            if ($ext == 'svg') {
                $img = 'data:image/svg+xml;base64,' . base64_encode(file_get_contents($path));
            } else {
                $img = 'data:' . getimagesize($path)['mime'] . ';base64,' . base64_encode(file_get_contents($path));
            }
        }

        return $img;}
}

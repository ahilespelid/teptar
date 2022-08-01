<?php

namespace App\Controllers;

class AbstractController {
    public $notifications;
    public $users;
    public $user;
    
    private static $memory = [];

    public function __construct() {
        $this->users = new \App\Models\UserModel;
        $this->user = new UserController();
    }

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
            throw new \Exception("Файл на вид по пути '$view' не найден.");
        }
    }

    public function layout($view) {
        // Заменяем слэши из ссылки на блоки сепаратором
        $view = implode(DIRECTORY_SEPARATOR, explode('/', $view));

        // Возвращаем полный путь с корневой папки до файла вида блока
        
        return $GLOBALS['path']['layouts'] .DIRECTORY_SEPARATOR. $view;
    }

    public function user() {
        $user = new UserController();
        return $user->getLoginUser();
    }

    // Генерирует base64 файл из $_FILES
    public function setFormBaseImage(string $input): string
    {
        $avatar_name = $_FILES[$input]['name'][0];
        $avatar_tmp = $_FILES[$input]['tmp_name'][0];
        $avatar_ext = strrchr($avatar_name, '.');
        $avatar = file_get_contents($avatar_tmp);

        return 'data:image/' . $avatar_ext . ';base64,' . base64_encode($avatar);
    }

    // Проверяет действительна ли форма, и возвращает значение true/false
    public function formIsValid(array $required, $file = null): bool
    {
        $valid = true;
        $condition = isset($_POST);

        if ($file) {
            $condition = isset($_POST) && isset($_FILES);
            if (!isset($_FILES[$file])) {
                $valid = false;
            }
        }

        if ($condition && $valid === true) {
            foreach ($required as $input) {
                if (!isset($_POST[$input]) || $_POST[$input] === '') {
                    $valid = false;
                }
            }
        } else {
            $valid = false;
        }

        return $valid;
    }

    public function image($file) {
        // Заменяем слэши из ссылки на изображение сепаратором
        $file = implode(DIRECTORY_SEPARATOR, explode('/', $file));    

        // Генерируем полный путь с корневой папки до изображения
        $path = $GLOBALS['path']['dev'] . $file;

        // Условие если файл по генерированной пути существует
        if (file_exists($path)) {
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

            return $img;
        } else {
            return null;
        }
    }

    // Перенаправляет на роут, с возможностью передать $_GET параметры
    public function redirectToRoute(string $route, array $parameters = null) {
        $params = '';
        $i = 1;

        foreach ($parameters as $parameter => $value) {
            if ($i == 1) {
                $params .= '?' . $parameter . '=' . $value;
            } else {
                $params .= '&' . $parameter . '=' . $value;
            }
            $i += 1;
        }

        header('Location: ' . $route . $params);
        exit;
    }

    public function is_date($value){ // */  проверка строки на дату  // */
        if (!$value) {return null;}

        try {$d = (new \DateTime($value));
        return $d;
        } catch (\Exception $e){
        return null;}}

    public function  arrayDeleteElement(array $array, array $symbols = ['']) { // */ удаляет из одномерного массива елеметы  $symbols // */
        return (is_array($array) && !empty($array) && !is_array(current($array))) ? array_diff($array, $symbols) : false;}

    public function connMCD(){ // */  подключение к оперативке  // */
        if(!class_exists("Memcached")){return false;}
        $m = new \Memcached; $m->addServer('localhost', 11211);
        return $m;}

    public function arrayMinMax($array, string $return = 'max|min'){ // */ Выбирает минимальное и/или максимальное значение из массива // */
        if(!is_array($array) && empty($array) && !is_array(current($array)) && !is_string($return)){return false;}
        foreach($array as $k => $v){
            $min[$k] = min($v); 
            $max[$k] = max($v);
        }
        return ('min' == $return && !empty($min)) ? $min : (
                    ('max' == $return && !empty ($max)) ? $max : (
                        ((('max|min' == $return) || ('min|max' == $return)) && (!empty($min) || !empty($max))) ? array('min' => $min, 'max' => $max) : false));
    }

    /// */ Метод сохранения данных в памяти /// */
    public function store(string $key, $value): bool{self::$memory[$key] = $value;return true;}
    /// */  Метод получения данных из памяти /// */ 
    public function fetch(string $key){return self::$memory[$key] ?? null;}
    /// */ Метод удаления данных из памяти /// */ 
    public function delete(string $key): bool{unset(self::$memory[$key]);return true;}
    /// */ Метод проверки наличия данных по ключу /// */ 
    public function exists(string $key): bool{return array_key_exists($key, self::$memory);}
}
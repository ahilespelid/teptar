<?php

class Db {

    protected $pdo;

    public function __construct()
    {
       $config = require 'base.php';
        /*/ Конструкция try catch. Если ошибка не присутствует, блок Catch игнорируется. /*/
        try {
            /*/ Создаем объект класса PDO. Последним параметрам передаем массив, содержащий дополнительные настройки PDO и драйвера. /*/
            $this->pdo = new PDO(''.$config['driver'].':host='.$config['host'].';dbname='.$config['db_name'].';charset='.$config['charset'].'', $config['db_user'], $config['db_pass'], $config['options']);
            if ($this->pdo == true)
                echo '<!-- <div style="background: green; text-align: center; color: white;"><p>Есть соединение с БД </p></div> -->';
            /*/ Если возникла ошибка, то выполнение TRY прерывается. В catch мы указываем, исключение каких классов мы хотим ловить. /*/
            } catch (PDOException $e) {
            /*/ Завершаем работу скрипта и выводим ошибку. /*/
                die ('<div style="background: red; text-align: center; color: white;"><p>Не возможно подключиться к БД. Ошибка: ' . $e->getMessage() . '<br/></p></div>');
            }
    }

    /*/
     * Добавление в таблицу.
     * Пример вывода:
     * $params = [':photo_user'=>'1234567890'];
     * //Подготавливаем запрос
     * $sql = "INSERT INTO test (photo_user) VALUES (:photo_user)";
     * echo $Connect->addSql($sql, $params);
     /*/
    public function addSql($sql, $params =  [])
    {
       //Подготавливаем запрос с помощью функции prepare
       $stmt = $this->pdo->prepare($sql);
       //используем переменную execute для запуска подготовленного запроса.
        $data = $stmt->execute((array) $params);
        /*/
        Для теста
        if ($data) { echo 'Запись вставлена '; } else { echo 'Запись не вставлена '; }
        /*/
    }

     /*/
     * Выполнение запроса.
     * DELETE, UPDATE, CREATE TABLE
     * //Пример удаления
     * $sql = 'DELETE FROM test WHERE id = :id';
     * //Пример обновления
     * $sql = 'UPDATE test SET photo_user = :photo_user WHERE id = :id';
     /*/
    public function setSql($sql, $params =  [])
    {
        //Подготавливаем запрос с помощью функции prepare
        $stmt = $this->pdo->prepare($sql);
        //используем переменную execute для запуска подготовленного запроса.
        $data = $stmt->execute((array) $params);
        /*/
        Для теста
        if ($data) { echo 'Запрос выполнен '; } else { echo 'Запрос не выполнен '; }
        /*/
    }

     /*/
     * Получение ОДНОЙ строки из таблицы. (НАПРИМЕР все данные одного пользователя).
	 * $params = [':id'=> '1'];
	 * $sql = 'SELECT photo_user FROM test WHERE id = :id';
	 * $echo = $Connect->getRow('SELECT * FROM user WHERE id_user = :id', $params);
     /*/
    public function getRow($sql, $params =  [])
    {
        //Подготавливаем запрос с помощью функции prepare
        $stmt = $this->pdo->prepare($sql);
        //используем переменную execute для запуска подготовленного запроса.
        $stmt->execute((array) $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /*/
     * Получение ВСЕХ строк из таблицы. ВООБЩЕ ВСЕХ.
     * $sql = 'SELECT * FROM test WHERE id > :id';
     * $echo = $Connect->getAll($sql, $params);
     * print_r($echo);
     /*/
    public function getAll($sql, $params =  [])
    {
        //Подготавливаем запрос с помощью функции prepare
        $stmt = $this->pdo->prepare($sql);
        //используем переменную execute для запуска подготовленного запроса.
        $stmt->execute((array) $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*/
     * Получение только ОДНОГО значения. Выведет на экран например имя изображения у пользователя.
     * $params = [':id'=>'3'];
     * $sql = 'SELECT photo_user FROM user WHERE id_user = :id';
     * $echo = $Connect->getValue($sql, $params);
     * print_r($echo);
     /*/
    public function getValue($sql, $params =  [], $default = null)
    {
        $result = $this->getRow($sql, $params);
        if (!empty($result)) {
            $result = array_shift($result);
        }
        return (empty($result)) ? $default : $result;
    }

    /*/
     * Получение СТОЛБЦА (по одному значению в столбце) таблицы.
	 * Пример вывода: Array ( [0] => c2d2b3c4c3edaa32c6fdfb4bd614e4ed.jpg )
     * //Подготавливаем запрос
     * $sql = 'SELECT photo_user FROM test WHERE id = :id';
     * $echo = $Connect->getColumn('SELECT photo_user FROM test WHERE id = :id', $params); или например
	 * $echo = $Connect->getColumn('SELECT login_user FROM user'); - выведет все логины из таблицы логин
     * print_r($echo);
     /*/
    public function getColumn($sql, $params =  [])
    {
        //Подготавливаем запрос с помощью функции prepare
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute((array) $params);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    //Последняя добавленная запись
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

}

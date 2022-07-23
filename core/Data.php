<?php
namespace App;
use PDO, PDOException;
define('dbHost',  $GLOBALS['db']['host']);
define('dbBase',  $GLOBALS['db']['base']);
define('dbUser',  $GLOBALS['db']['user']);
define('dbPass',  $GLOBALS['db']['pass']);

abstract class Data{
    public $pdo;
    public $table;
    public $logFile;

    public function __construct(){}
    public function connPDO(){
        $this->logFile = $GLOBALS['path']['log']._DS_.'sql'._DS_;
        $pdo = new \PDO("mysql:dbname=" .$GLOBALS['db']['base'] . ";host=".
            $GLOBALS['db']['host'],
            $GLOBALS['db']['user'],
            $GLOBALS['db']['pass'], array(PDO::ATTR_PERSISTENT => true));

        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

/*/ -------------------------------------------------------------- Геты из базы -------------------------------------------------------------- /*/ 
    public function getId($table = '', $id = 1){//*/ Берёт значения по ИД из таблицы //*/ 

        $id = (int)$id; $id = $this->pdo->quote($id);
        $table = (is_string($table) && !empty($table)) ? trim($table) : $this->getRandTable()[0];
        $table = $this->pdo->quote($table); $table[0] = $table[strlen($table)-1] = '`';

        $sql = 'SELECT * FROM '.$table.' WHERE `id`='.$id.';';
        $this->writeLog($sql, __FUNCTION__);
        $return = $this->pdo->query($sql);  //*/ return $return->queryString; echo $sql; //*/

        return $return->fetch();}

    public function getAll(string $table){//*/ Берёт все значения из таблицы //*/
        $table = (is_string($table) && !empty($table)) ? trim($table) : $this->getRandTable()[0];
        $table = $this->pdo->quote($table); $table[0] = $table[strlen($table)-1] = '`';

        $sql = 'SELECT * FROM '.$table.';';
        $this->writeLog($sql, __FUNCTION__);
        $return = $this->pdo->query($sql);

        return $return->fetchAll();}


    public function getWhere($table = '', $where =  array('id'=>'1'), $sign = array(['simbol' => '=', 'quote' => true]), $order = 'ORDER BY `id` ASC'){//*/ Берёт все значения из таблицы: WHERE параметры массива //*/ 
       
        $table = (is_string($table) && !empty($table)) ? trim($table) : ((is_string($this->table) && !empty($this->table)) ? $this->table : $this->getRandTable()[0]);
        $table = $this->pdo->quote($table); $table[0] = $table[strlen($table)-1] = '`';
        $where = (is_array($where) && !empty($where) && !is_array(current($where))) ? $where : ['id'=>'1'];

        $whereString = ''; $i = 0; $c = count($where);

        foreach($where as $k => $v){

            if(!empty($sign[$i])){$k = ($sign[$i]['quote'])? $this->pdo->quote($k) : $k;} 
            if(str_starts_with($k,"'") && str_ends_with($k,"'")){$k[0] = $k[strlen($k)-1] = '`';}          
            $whereString .= $k.' '.(
                                                (!empty($sign[$i]['simbol'])) ?  
                                                                                                    (($sign[$i]['quote']) ? $sign[$i]['simbol'].$this->pdo->quote($v) : $sign[$i]['simbol'].' '.$v) 
                                                                                                    :  '='.$this->pdo->quote($v)
                                                ).((1+$i < $c ) ? ' AND ' : ''); $i++;
        }$whereString = ' WHERE '.$whereString.' '.$order;
        $sql =  'SELECT * FROM '.$table.$whereString .';'; //*/ echo $sql.'<br>'; //*/
        $this->writeLog($sql, __FUNCTION__, false);  

        $return = $this->pdo->query($sql);
        
        $return = $return->fetchAll(); 
         return (is_array($return) && !empty($return)) ? $return : false;}
    
    public function getRange($from = 1, $to = 10, $table = '', $colum = ''){//*/ Берёт от и до из таблиц(У|Ы)  //*/

        $table = (is_string($table) && !empty($table)) ? trim($table) : $this->getRandTable()[0];
        $table = $this->pdo->quote($table); $table[0] = $table[strlen($table)-1] = '`';
        if(is_string($colum) && !empty($colum)){
            $colum = $this->pdo->quote(trim($colum)); $colum[0] = $colum[strlen($colum)-1] = '`';
        }else{$colum = '*';}

        $sql =  'SELECT '.$colum.' FROM '.$table.' WHERE `id`>='.$from.' AND `id`<='.$to.';';
        $this->writeLog($sql, __FUNCTION__);
        $return = $this->pdo->query($sql);

        return $return->fetchAll();}

    public function getRandTable(bool $oneOrMony = false, bool $orderRand = false){//*/ Берёт случайную таблиц(У|Ы) из схемы  //*/ 
            $sql =  'SELECT `TABLE_NAME` FROM `INFORMATION_SCHEMA`.`TABLES` WHERE `TABLE_SCHEMA`'." = '" . $GLOBALS['db']['base'] . "' ORDER BY ".
                        ((!$orderRand) ? 'RAND()' : '`TABLE_ROWS` DESC')." ".((!$oneOrMony) ? ' LIMIT 1;' : ';');
            $this->writeLog($sql, __FUNCTION__);
            $return = $this->pdo->query($sql);
            
            $table = $return->fetchAll();
            $return = []; array_walk_recursive($table, function($a) use (&$return) { $return[] = $a;});
            return $return; //*/ return [ 0 => TABLE_NAME], 1 => TABLE_NAME, ...] //*/      
    }

    public function getColumnTable($table = ''){
        $table = (is_string($table) && !empty($table)) ? trim($table) : $this->getRandTable()[0];
        $table = $this->pdo->quote($table); $table[0] = $table[strlen($table)-1] = '`';

        $sql =  'SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='.
            "'". $this->base."'".'AND `TABLE_NAME`='. $table. ';';
        $this->writeLog($sql, __FUNCTION__);
        $return = $this->pdo->query($sql);

        $colum = $return->fetchAll();
        $return = []; array_walk_recursive($colum, function($a) use (&$return) { $return[] = $a;});

        return $return; //*/ $column [ 0 => TABLE_NAME], 1 => TABLE_NAME, ...] //*/ 
    }   

///*/ -------------------------------------------------------------- Вставки в базу -------------------------------------------------------------- /*/// 

    public function insert($table = '', $data = []){
        if(is_string($table) && !empty($table) && is_array($data) && !empty($data) && !is_array(current($data))){
            $table = $this->pdo->quote($table); $table[0] = $table[strlen($table)-1] = '`';

            $columns = '';
            $values = '';

            foreach ($data as $column => $value) {
                $column = $this->pdo->quote($column); $column[0] = $column[strlen($column)-1] = '`';
                $value = $this->pdo->quote($value);
                $columns     .= $columns ? ', ' : ''; $columns     .= $column;
                $values     .= $values     ? ', ' : ''; $values     .= $value;
            }
            $sql = 'INSERT INTO '.$table.' ('.$columns.') VALUES ('.$values.');'; //*/ echo $sql; //*/
            $this->writeLog($sql, __FUNCTION__);
            return ($this->pdo->query($sql)) ? $this->pdo->lastInsertId() : false;

        }return false;}

    public function updateTable($table = '', $data = []){
        if(is_string($table) && !empty($table) && is_array($data) && !empty($data) && !is_array(current($data)) && !empty($data['id'])){
            $table = trim($table); $table = $this->pdo->quote($table); $table[0] = $table[strlen($table)-1] = '`';

            $columns = '';

            foreach ($data as $column => $value) {
                if('id' == $column){continue;}

                $column = $this->pdo->quote($column); $column[0] = $column[strlen($column)-1] = '`';
                $place = $column; $place[0] = $place[strlen($column)-1] = ' '; $place = trim($place);

                $columns     .= $columns ? ', ' : '';
                $columns     .= $column.'=:'.$place;
            }

            $sql = 'UPDATE '.$table.' SET '.$columns.' WHERE `id` = :id;'; //*/ echo $sql; //*/
            $this->writeLog($sql, __FUNCTION__);
            return ($this->pdo->prepare($sql)->execute($data)) ? $data['id'] : false;

        }return false;}

    public function new_($sql = ''){

    }

    public function getQuery($sql = '', $return = true){
        $sql = (is_string($sql) && !empty($sql)) ? trim($sql) : false;
        $this->writeLog($sql, __FUNCTION__);

        if($return){
            return $this->pdo->query($sql)->fetchAll();
        }else{
            $this->pdo->query($sql); return true;}

        return false;}

    public function getTableFromIdString(string $subject){ $f = false;
        if(str_starts_with($subject,'id_')){$subject = str_replace('id_', '', $subject); $f = true;}
        if(str_ends_with($subject,'_id')){$subject = str_replace('_id', '', $subject); $f = true;}

        $n = preg_match( '/[A-Z_-]/', $subject, $matches, PREG_OFFSET_CAPTURE );

        if($n){$subject = mb_substr($subject, 0, $matches[0][1]);}
        $subject .= (str_ends_with($subject, 's') || 'uin' == $subject) ?  '' :  's';

    return ($f) ? $subject : false;}

    // Ищет одну запись по критериям
    // Пример: ['name' => 'John']
    public function findOneBy(array $criteria, array $orderBy = null){
        $criteriaSQL = '';
        $orderSQL = '';
        $iteration = 1;

        // Генерация строки запроса SQL для обязательного параметра критериев $criteria
        foreach ($criteria as $column => $value) {
            ($iteration == 1) ? $criteriaSQL .= "" : $criteriaSQL .= " AND ";
            $criteriaSQL .= $column . " = '" . $value . "'";
            $iteration += 1;
        }

        // Генерация строки запроса SQL для необязательного параметра сортировки $orderBy
        if ($orderBy) {
            $iteration = 1;
            foreach ($orderBy as $column => $order) {
                ($iteration == 1) ? $orderSQL .= ' ORDER BY ' : $orderSQL .= ', ' ;
                $orderSQL .= $column . ' ' . $order;
                $iteration += 1;
            }
        }

        // Генерация всего запроса из результатов предыдуще генерированных строков
        $sql = "SELECT * FROM " . $this->table . " WHERE " . $criteriaSQL . $orderSQL . " LIMIT 1";
        $this->writeLog($sql, __FUNCTION__);
        $query = $this->pdo->query($sql);

        return (!empty($return = $query->fetchAll())) ? $return[0] : false;
    }

    // Поиск всех записей таблицы
    public function findAll() {
        $sql = 'SELECT * FROM ' . $this->table . ';';
        $this->writeLog($sql, __FUNCTION__);
        $query = $this->pdo->query($sql);

        return $query->fetchAll();
    }

    // Ищет записи по критериям
    // Пример: ['name' => 'John']
    public function findBy(array $criteria, array $orderBy = null, int $limit = null, $offset = null){
        $criteriaSQL = '';
        $orderSQL = '';
        $limitSQL = '';
        $offsetSQL = '';
        $iteration = 1;

        // Генерация строки запроса SQL для обязательного параметра критериев $criteria
        foreach ($criteria as $column => $value) {
            ($iteration == 1) ? $criteriaSQL .= "" : $criteriaSQL .= " AND ";
            $criteriaSQL .= $column . " = '" . $value . "'";
            $iteration += 1;
        }

        // Генерация строки запроса SQL для необязательного параметра сортировки $orderBy
        if ($orderBy) {
            $iteration = 1;
            foreach ($orderBy as $column => $order) {
                ($iteration == 1) ? $orderSQL .= ' ORDER BY ' : $orderSQL .= ', ' ;
                $orderSQL .= $column . ' ' . $order;
                $iteration += 1;
            }
        }

        // Генерация строки запроса SQL для необязательных параметров лимита $limit и офсета $offset
        if ($limit) {
            $limitSQL = " LIMIT " . $limit;
            if ($offset) {
                $offsetSQL = " OFFSET " . $offset;
            }
        }

        // Генерация всего запроса из результатов предыдуще генерированных строков
        $sql = "SELECT * FROM " . $this->table . " WHERE " . $criteriaSQL . $orderSQL . $limitSQL . $offsetSQL;
        $this->writeLog($sql, __FUNCTION__);
        $query = $this->pdo->query($sql);

        return $query->fetchAll();
    }

    // Ищет записи по критериям
    // Пример: ['name' => 'John']
    // И возвращает в формате JSON
    public function jsonBy(array $criteria, array $orderBy = null, int $limit = null, $offset = null) {
        return json_encode($this->findBy($criteria, $orderBy, $limit, $offset), JSON_UNESCAPED_UNICODE);
    }

    // Ищет одну запись по критериям
    // Пример: ['name' => 'John']
    // И возвращает в формате JSON
    public function jsonOneBy(array $criteria, array $orderBy = null, int $limit = null, $offset = null) {
        return json_encode($this->findOneBy($criteria, $orderBy), JSON_UNESCAPED_UNICODE);
    }

    // Ищет все записи таблиц и возвращает их в формате JSON
    public function jsonAll() {
        return json_encode($this->findAll(), JSON_UNESCAPED_UNICODE);
    }

    // Выдает количество записей по критериям
    // Пример: ['role' => 'user']
    // Результат: int (8)
    public function count(array $criteria) {
        $criteriaSQL = '';
        $iteration = 1;

        // Генерация строки запроса SQL для обязательного параметра критериев $criteria
        foreach ($criteria as $column => $value) {
            ($iteration == 1) ? $criteriaSQL .= "" : $criteriaSQL .= " AND ";
            $criteriaSQL .= $column . " = '" . $value . "'";
            $iteration += 1;
        }

        // Генерация всего запроса из результатов предыдуще генерированных строков
        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE " . $criteriaSQL;
        $this->writeLog($sql, __FUNCTION__);
        $query = $this->pdo->query($sql);

        return $query->fetchColumn();
    }

    // Создает новую запись в базе данных
    // Пример ввода данных: ['firstname' => 'John', 'lastname' => 'Doe']
    public function add(array $entries) {
        $columns = '';
        $values = '';
        $i = 1;

        // Генерация строки запроса SQL для добавления новой записи в базу данных
        foreach ($entries as $column => $value) {
            $columns .= $column;

            if ($value instanceof \DateTime) {
                $values .= "'" . $value->format('Y-m-d H:i:s') . "'";
            } else {
                $values .= "'" . $value . "'";
            }

            if ($i !== count($entries)) {
                $columns .= ', ';
                $values .= ', ';
            }

            $i += 1;
        }

        // Генерация всего запроса из результатов предыдуще генерированных строков
        $sql = "INSERT INTO " . $this->table . " (" . $columns . ") VALUES (" . $values . ")";
        $this->writeLog($sql, __FUNCTION__);
        $this->pdo->query($sql);
    }

    public function columnValues(array $entries, $type = null) {
        $values = '';
        $i = 1;

        // Генерация строки запроса SQL (колонка = значение) в зависимости от типа значений
        foreach ($entries as $column => $value) {
            if (is_bool($value)) {
                $values .= '`' . $column . '`' . ' = ';

                if ($value === true) {
                    $values .= 'true';
                } else {
                    $values .= 'false';
                }
            } elseif (is_int($value) || is_float($value)) {
                $values .= '`' . $column . '`' . ' = ' . $value;
            } elseif ($value instanceof \DateTime) {
                $values .= '`' . $column . '`' . ' = ' . '"' . $value->format('Y-m-d H:i:s') . '"';
            } elseif ($value === null) {
                $values .= '`' . $column . '`' . ' = ' . 'NULL' ;
            } else {
                $values .= '`' . $column . '`' . ' = ' . '"' . $value . '"';
            }

            if ($i != count($entries)) {
                if ($type === null) {
                    $values .= ', ';
                } elseif ($type == 'conditions') {
                    $values .= ' AND ';
                }
            }

            $i += 1;
        }

        return $values;
    }

    public function update(array $entries, array $conditions) {
        // Генерация строки запроса SQL для изменения значений записей из базы данных
        $columnValues = $this->columnValues($entries);
        // Генерация строки запроса SQL для условий поиска записей из таблицы
        $conditionsValues = $this->columnValues($conditions, 'conditions');

        $sql = 'UPDATE '. $this->table .' SET '. $columnValues .' WHERE ' . $conditionsValues;
        $this->pdo->query($sql);

        return $sql;
    }

    // Позволяет сделать чистый SQL запрос в БД
    public function customSQL(string $sql) {
        $query = $this->pdo->query($sql);

        return $query->fetchAll();
    }

    public function writeLog($sql, $action = __FUNCTION__, $timeWrite = true) {
        $date = (new \DateTime('now'));
        $dateFile = $date->format('Y-m-d');
        $filename = $action . $dateFile . '.txt';

        if($sql){
            $entry = PHP_EOL .(($timeWrite) ? $date->format('[H:i:s]')  : '') .' '. $sql;
            file_put_contents($this->logFile . $filename, $entry, FILE_APPEND | LOCK_EX);                                                     
        } 
    }
}

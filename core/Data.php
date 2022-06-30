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

    public function __construct(){}
    public function connPDO(){
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
        $return = $this->pdo->query($sql);  //*/ return $return->queryString; //*/

        return $return->fetch();}

    public function getAll(string $table){//*/ Берёт все значения из таблицы //*/
        $table = (is_string($table) && !empty($table)) ? trim($table) : $this->getRandTable()[0];
        $table = $this->pdo->quote($table); $table[0] = $table[strlen($table)-1] = '`';

        $sql = 'SELECT * FROM '.$table.';';
        $return = $this->pdo->query($sql);

        return $return->fetchAll();}


    public function getWhere($table = '', $where =  array(), $sign = ['='], $order = 'ORDER BY `id` ASC'){//*/ Берёт все значения из таблицы: WHERE параметры массива //*/ 

        $table = (is_string($table) && !empty($table)) ? trim($table) : $this->getRandTable()[0];
        $table = $this->pdo->quote($table); $table[0] = $table[strlen($table)-1] = '`';
        $where = (is_array($where) && !empty($where) && !is_array(current($where))) ? $where : ['id'=>'1'];

        $whereString = ''; $i = 1; $c = count($where);
        foreach($where as $k => $v){
            $k = $this->pdo->quote($k); $k[0] = $k[strlen($k)-1] = '`';
            $whereString .= $k.((is_array($sign) && $c == count($sign)) ?  $sign[$i-1] : '=').$this->pdo->quote($v).(($i < $c ) ? ' AND ' : ''); $i++;
        }$whereString = ' WHERE '.$whereString.' '.$order;

        $sql =  'SELECT * FROM '.$table.$whereString .';'; //*/ echo $sql; //*/

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
        $return = $this->pdo->query($sql);

        return $return->fetchAll();}

    public function getRandTable(bool $oneOrMony = false, bool $orderRand = false){//*/ Берёт случайную таблиц(У|Ы) из схемы  //*/ 
            $sql =  'SELECT `TABLE_NAME` FROM `INFORMATION_SCHEMA`.`TABLES` WHERE `TABLE_SCHEMA`'." = '" . $GLOBALS['db']['base'] . "' ORDER BY ".
                        ((!$orderRand) ? 'RAND()' : '`TABLE_ROWS` DESC')." ".((!$oneOrMony) ? ' LIMIT 1;' : ';');
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
        $return = $this->pdo->query($sql);

        $colum = $return->fetchAll();
        $return = []; array_walk_recursive($colum, function($a) use (&$return) { $return[] = $a;});

        return $return; //*/ $column [ 0 => TABLE_NAME], 1 => TABLE_NAME, ...] //*/ 
    }   
/*/ -------------------------------------------------------------- Вставки в базу -------------------------------------------------------------- /*/ 

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
            return ($this->pdo->query($sql)) ? $this->pdo->lastInsertId() : false;

        }return false;}

    public function update($table = '', $data = []){
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
            return ($this->pdo->prepare($sql)->execute($data)) ? $data['id'] : false;

        }return false;}

    public function new_($sql = ''){

    }

    public function getQuery($sql = '', $return = true){
        $sql = (is_string($sql) && !empty($sql)) ? trim($sql) : false;

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
        $subject = (str_ends_with($subject, 's')) ?  $subject :  $subject.'s';

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

        // Генерация всего запроса из резульатов предыдуще генерированных строков
        $sql = "SELECT * FROM " . $this->table . " WHERE " . $criteriaSQL . $orderSQL . " LIMIT 1";
        $query = $this->pdo->query($sql);

        return (!empty($return = $query->fetchAll())) ? $return[0] : false;
    }

    // Поиск всех записей таблицы
    public function findAll() {
        $sql = 'SELECT * FROM ' . $this->table . ';';
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

        // Генерация всего запроса из резульатов предыдуще генерированных строков
        $sql = "SELECT * FROM " . $this->table . " WHERE " . $criteriaSQL . $orderSQL . $limitSQL . $offsetSQL;

        $query = $this->pdo->query($sql);

        return $query->fetchAll();
    }
}

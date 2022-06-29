<?php
namespace App;

class Registr{
    public  $logFile,
        $exDate,
        $exMessage,
        $exFileName,
        $exLine,
        $trFileName,
        $logPull;

    public function __construct() {
        $this->logPull = array();
        /*/ Путь к файлу лога (php.txt) /*/
        $this->logFile = $GLOBALS['path']['log'] . _DS_;

        /*/ Форматирование текущей даты /*/
        $this->exDate = (new \DateTime('now'))->format('[H:i | d M Y]');
    }

    /*/ Метод принимает исключение на обработку /*/
    public function setException($exception) {
        /*/ Присвоение значений свойствам если параметр $exception класса Exception /*/
        $backtrace = debug_backtrace();
        $this->trFileName = $trFileName = (!empty($backtrace[0]['file'])) ? $backtrace[0]['file'] . ' : ' .$backtrace[0]['line'] : 'undefined';

        if ($exception instanceof \Exception){
            $this->exMessage = $exMessage =  $exception->getMessage();
            $this->exFileName = $exFileName =  $exception->getFile();
            $this->exLine = $exLine  =  $exception->getLine();
        } else {
            $exception = (array) $exception;
            $this->exMessage = $exMessage       =   (!empty($exception['message'])) ? $exception['message'] : 'Calling the setException method of the Register class with an empty parameter';
            $this->exFileName = $exFileName     =   (!empty($exception['file'])) ? $exception['file'] : __FILE__;
            $this->exLine = $exLine             =   (!empty($exception['line'])) ? $exception['line'] : __LINE__;
        }

        /*/
        $this->exMessage = $exMessage = ($exception instanceof \Exception) ? $exception->getMessage() :
            ((!empty($exception['mess'])) ? $exception['mess'] : 'Calling the setException method of the Register class with an empty parameter');
        $this->exFileName = $exFileName =  ($exception instanceof \Exception) ? $exception->getFile() :
            ((!empty($exception['file'])) ? $exception['file'] : __FILE__);
        $this->exLine = $exLine  =  ($exception instanceof \Exception) ? $exception->getLine() :
             ((!empty($exception['line'])) ? $exception['line'] : __LINE__);
        $exDate = $this->exDate;
        /*/

        $this->logPull[] = [
            'date'  => $this->exDate,
            'message'  => $exMessage,
            'filename'  => $exFileName,
            'line'  => $exLine,
            'call'  => $trFileName
        ];
        return $this;
    }

    /*/ Метод выдает обработанное исключение /*/
    public function getExceptions(){
        return $this->logPull;
    }

    /*/ Метод добавляет запись в лог файл (php.txt) /*/
    public function writeLog($error = null) {
        /*/ Извлечение всех существующих php_(дата).txt файлов /*/
        $items = glob($this->logFile.'php_*.txt');
        $files = [];

        foreach ($items as $key => $value) {
            $files[$key] = $value;
        }

        /*/ Их сортировка по дате (сначала новые) /*/
        arsort($files);
        $files = array_values($files);

        /*/ Удаление старых файлов если их больше 90 /*/
        foreach ($files as $key => $value) {
            if ($key > 90) {
                unlink($value);
            }
        }

        /*/ Создание имени файла с текущей датой в назвинии файла /*/
        $date = (new \DateTime('now'))->format('Y-m-d');
        $filename = 'php_' . $date . '.txt';

        /*/ Создание файла $filename если он не существует /*/
        if (!file_exists($this->logFile . $filename)) {
            fopen($this->logFile . $filename, "w");
        }

        if ($error) {
            /*/ Создание новой записи текущего исключения /*/
            $entry = PHP_EOL . $this->exDate .' '. $error->getMessage() .' '. $error->getFile() .' (line '. $error->getLine() .')';
            /*/ Добавление новой записи в php.txt /*/
            file_put_contents($this->logFile . $filename, $entry, FILE_APPEND | LOCK_EX);
        } else {
            foreach ($this->logPull as $exception) {
                /*/ Создание новой записи текущего исключения /*/
                $entry = PHP_EOL . $exception['date'] .' '. $exception['message'] .' '. $exception['filename'] .' (line '. $exception['line'] .')';
                /*/ Добавление новой записи в php.txt /*/
                file_put_contents($this->logFile . $filename, $entry, FILE_APPEND | LOCK_EX);
            }
        }
    }
}

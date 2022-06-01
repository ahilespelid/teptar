<?php 
namespace App; 
use Exception;

class Registr {
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
        $this->logFile = $GLOBALS['path']['dev'] . $GLOBALS['path']['log'] . _DS_ . 'php.txt';

        /*/ Форматирование текущей даты /*/
        $this->exDate = (new \DateTime('now'))->format('[H:i | d M Y]');
    }

    public function setException($exception) { /*/ Метод принимает исключение на обработку /*/
        /*/ Присвоение значений свойствам если параметр $exception класса Exception /*/
        $backtrace = debug_backtrace();
        $this->trFileName = $trFileName = (!empty($backtrace[0]['file'])) ? $backtrace[0]['file'] . ' : ' .$backtrace[0]['line'] : 'undefined';
        
        if ($exception instanceof \Exception){
            $this->exMessage = $exMessage =  $exception->getMessage();
            $this->exFileName = $exFileName =  $exception->getFile();
            $this->exLine = $exLine  =  $exception->getLine();              
        } else {
            \pa($exception);
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
         $this->logPull[] = array('Date'      => $exDate,
                                                'Mess'     => $exMessage,
                                                'File'        => $exFileName,
                                                'Line'       => $exLine,
                                                'Call'        => $trFileName);
        return $this;
    }

    public function getException() { /*/ Метод выдает обработанное исключение /*/
             return $this->logPull;
    }

    public function writeLog() { /*/ Метод добавляет запись в лог файл (php.txt) /*/
        /*/ Создание файла php.txt если он не существует /*/
        if (!file_exists($this->logFile)){fopen($this->logFile, "w");}

        /*/ Создание новой записи текущего исключения /*/
        $entry = PHP_EOL . $this->exDate .' '. $this->exMessage .' '. $this->exFileName .' (line '. $this->exLine .')';

        /*/ Удаление записи из php.txt если идентичная запись уже существует /*/ 
        $contents = file_get_contents($this->logFile);
        if(strpos($contents, $entry)){
            file_put_contents($this->logFile, str_replace($entry, '', $contents));
        }

        /*/ Добавление новой записи в php.txt /*/
        file_put_contents($this->logFile, $entry, FILE_APPEND | LOCK_EX);
    }
}
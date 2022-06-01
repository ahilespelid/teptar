<?php 
namespace App;

class Registr {
    public  $logFile,
                $exDate,
                $exMessage,
                $exFileName,
                $exLine,
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
        if ($exception instanceof \Exception) {
            $this->exMessage = $exMessage = $exception->getMessage();
            $this->exFileName = $exFileName = $exception->getFile();
            $this->exLine = $exLine  = $exception->getLine();
            $exDate = $this->exDate;
            
        /*/ Присвоение значений свойствам если тип параметра $exception 'array' /*/
        } else {
            $this->exMessage = $exception['message'];
            $this->exFileName = $exception['filename'];
            $this->exLine = $exception['line'];
        }
        $this->logPull[] = array('date'          => $exDate,
                                                'message' => $exMessage,
                                                'filename' => $exFileName,
                                                'line'          => $exLine);
        return $this;
    }

    public function getException($type = false) { /*/ Метод выдает обработанное исключение /*/
        if ($type) {
       /*/ Если тип исключения 'false' выдать исключение в форматированном виде /*/
            return '<span style="color: #ce4040">' . $this->exDate . '</span> '.
                        $this->exMessage . ' <b>' . $this->exFileName. '</b> <small>(line ' . $this->exLine . ')</small><br>';
        } else {
        /*/ Иначе массив /*/
             return $this->logPull;
        }
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
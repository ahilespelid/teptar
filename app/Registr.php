<?php namespace App;

class Registr{
    public  $log,
                $date,
                $message,
                $filename,
                $line;

    public function __construct(){
        $this->log = $GLOBALS['path']['dev'] . $GLOBALS['path']['cor'] . _DS_ . 'log.txt';                                                                                                          /*/ Путь к файлу log.txt /*/
        $this->date = (new \DateTime('now'))->format('[H:i | d M Y]');                                                                                                                                     /*/ Форматирование текущей даты /*/

    }

    public function setException($exception){                                                                                                                                                                          /*/ Присвоение значений свойствам если параметр $exception класса Exception /*/
        if ($exception instanceof \Exception) {
            $this->message = $exception->getMessage();
            $this->filename = $exception->getFile();
            $this->line = $exception->getLine();
        } else {                                                                                                                                                                                                                                /*/ Присвоение значений свойствам если тип параметра $exception 'array' /*/
            $this->message = $exception['message'];
            $this->filename = $exception['filename'];
            $this->line = $exception['line'];
        }return $this;
    }

    public function getException($type = null){
        if ($type != 'array') {                                                                                                                                                                                                            /*/ Если запрошен тип исключения 'array' выдать исключение в виде массива /*/
            $date = '<span style="color: #ce4040">' . $this->date . '</span> ';

            return $date . $this->message . ' <b>' . $this->filename . '</b> <small>(line ' . $this->line . ')</small><br>';
        } else {
            return [                                                                                                                                                                                                                          /*/ В противном случае выдать исклюение в форматированном виде /*/
                'date' => $this->date,
                'message' => $this->message,
                'filename' => $this->filename,
                'line' => $this->line
            ];
        }
    }

    public function writeLog(){                                                                                                                                                                                                     /*/ Создание новой записи текущего исключения /*/
        $entry = PHP_EOL . $this->date .' '. $this->message .' '. $this->filename .' (line '. $this->line .')';

        $contents = file_get_contents($this->log);
        $contents = str_replace($entry, '', $contents);                                                                                                                                                                   /*/ Удаление записи из log.txt если такая запись уже существует /*/

        file_put_contents($this->log, $contents);
        file_put_contents($this->log, $entry, FILE_APPEND | LOCK_EX);                                                                                                                                      /*/ Добавление новой записи в log.txt /*/
    }
}
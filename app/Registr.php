<?php namespace App;

class Registr{
    public  $log,
            $date,
            $message,
            $filename,
            $line;

    public function __construct(){
        $this->log = $GLOBALS['path']['dev'] . $GLOBALS['path']['app'] . _DS_ . 'log.txt'; /*/ Путь к файлу log.txt /*/
        $this->date = (new \DateTime('now'))->format('[H:i | d M Y]'); /*/ Форматирование текущей даты /*/
    }

    public function setException($exception): Registr
    {
        /*/ Присвоение значений свойствам если параметр $exception класса Exception /*/
        if ($exception instanceof \Exception) {
            $this->message = $exception->getMessage();
            $this->filename = $exception->getFile();
            $this->line = $exception->getLine();
        /*/ Присвоение значений свойствам если тип параметра $exception 'array' /*/
        } else {
            $this->message = $exception['message'];
            $this->filename = $exception['filename'];
            $this->line = $exception['line'];
        }

        return $this;
    }

    public function getException($type = null)
    {
        /*/ Если запрошен тип исключения 'array' выдать исключение в виде массива /*/
        if ($type == 'array') {
            return [
                'date' => $this->date,
                'message' => $this->message,
                'filename' => $this->filename,
                'line' => $this->line
            ];
        /*/ В противном случае выдать исклюение в форматированном виде /*/
        } else {
            $date = '<span style="color: #ce4040">' . $this->date . '</span> ';

            return $date . $this->message . ' <b>' . $this->filename . '</b> <small>(line ' . $this->line . ')</small><br>';
        }
    }

    public function writeLog()
    {
        /*/ Создание файла log.txt если он не существует /*/
        if (!file_exists($this->log)) {
            fopen($this->log, "w");
        }

        /*/ Создание новой записи текущего исключения /*/
        $entry = PHP_EOL . $this->date .' '. $this->message .' '. $this->filename .' (line '. $this->line .')';

        /*/ Удаление записи из log.txt если идентичная запись уже существует /*/
        $contents = file_get_contents($this->log);
        $contents = str_replace($entry, '', $contents);
        file_put_contents($this->log, $contents);

        /*/ Добавление новой записи в log.txt /*/
        file_put_contents($this->log, $entry, FILE_APPEND | LOCK_EX);
    }
}

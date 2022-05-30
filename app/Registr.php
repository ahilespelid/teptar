<?php

<<<<<<< HEAD:app/Registr.php
class Registr{
=======
namespace App;

class Registry
{
>>>>>>> f6fd1e3818409331b7e47c2e445de17edc3b336a:app/Registry.php
    public  $log,
            $date,
            $message,
            $filename,
            $line;

    public function __construct()
    {
        /*/ Путь к файлу log.txt /*/
        $this->log = $GLOBALS['path']['dev'] . $GLOBALS['path']['app'] . _DS_ . 'log.txt';

        /*/ Форматирование текущей даты /*/
        $this->date = (new \DateTime('now'))->format('[H:i | d M Y]');
    }

<<<<<<< HEAD:app/Registr.php
    public function setException($exception){
=======
    public function setException($exception): static
    {
        /*/ Присвоение значений свойствам если параметр $exception класса Exception /*/
>>>>>>> f6fd1e3818409331b7e47c2e445de17edc3b336a:app/Registry.php
        if ($exception instanceof \Exception) {
            $this->message = $exception->getMessage();
            $this->filename = $exception->getFile();
            $this->line = $exception->getLine();
        /*/ Присвоение значений свойствам если тип параметра $exception 'array' /*/
        } else {
            $this->message = $exception['message'];
            $this->filename = $exception['filename'];
            $this->line = $exception['line'];
        }return $this;
    }

<<<<<<< HEAD:app/Registr.php
    public function getException($type = null){
        if ($type != 'array') {
            $date = '<span style="color: #ce4040">' . $this->date . '</span> ';

            return $date . $this->message . ' <b>' . $this->filename . '</b> <small>(line ' . $this->line . ')</small><br>';
        } else {
=======
    public function getException($type = null): array|string
    {
        /*/ Если запрошен тип исключения 'array' выдать исключение в виде массива /*/
        if ($type == 'array') {
>>>>>>> f6fd1e3818409331b7e47c2e445de17edc3b336a:app/Registry.php
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

<<<<<<< HEAD:app/Registr.php
    public function writeLog(){
=======
    public function writeLog()
    {
        /*/ Создание новой записи текущего исключения /*/
>>>>>>> f6fd1e3818409331b7e47c2e445de17edc3b336a:app/Registry.php
        $entry = PHP_EOL . $this->date .' '. $this->message .' '. $this->filename .' (line '. $this->line .')';

        /*/ Удаление записи из log.txt если такая запись уже существует /*/
        $contents = file_get_contents($this->log);
        $contents = str_replace($entry, '', $contents);
        file_put_contents($this->log, $contents);

        /*/ Добавление новой записи в log.txt /*/
        file_put_contents($this->log, $entry, FILE_APPEND | LOCK_EX);
    }
}
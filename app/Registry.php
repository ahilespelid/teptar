<?php

namespace App;

class Registry
{
    public  $log,
            $date,
            $message,
            $filename,
            $line;

    public function __construct()
    {
        $this->log = $GLOBALS['path']['dev'] . $GLOBALS['path']['app'] . _DS_ . 'log.txt';
        $this->date = (new \DateTime('now'))->format('[H:i | d M Y]');

    }

    public function setException($exception): static
    {
        if ($exception instanceof \Exception) {
            $this->message = $exception->getMessage();
            $this->filename = $exception->getFile();
            $this->line = $exception->getLine();
        } else {
            $this->message = $exception['message'];
            $this->filename = $exception['filename'];
            $this->line = $exception['line'];
        }

        return $this;
    }

    public function getException($type = null): array|string
    {
        if ($type != 'array') {
            $date = '<span style="color: #ce4040">' . $this->date . '</span> ';

            return $date . $this->message . ' <b>' . $this->filename . '</b> <small>(line ' . $this->line . ')</small><br>';
        } else {
            return [
                'date' => $this->date,
                'message' => $this->message,
                'filename' => $this->filename,
                'line' => $this->line
            ];
        }
    }

    public function writeLog()
    {
        $entry = PHP_EOL . $this->date .' '. $this->message .' '. $this->filename .' (line '. $this->line .')';

        $contents = file_get_contents($this->log);
        $contents = str_replace($entry, '', $contents);

        file_put_contents($this->log, $contents);
        file_put_contents($this->log, $entry, FILE_APPEND | LOCK_EX);
    }
}

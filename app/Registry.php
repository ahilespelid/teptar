<?php

namespace App;

class Registry
{
    public string $file;
    public array $object = [
        'type' => 'Fatal Error',
        'date' => '24 окт. 2022',
        'message' => 'Undefined constant "variable"',
        'filename' => 'www/public/index.php',
        'line' => '17',

    ];

    public function __construct()
    {
        $this->file = $GLOBALS['path']['dev'] . $GLOBALS['path']['app'] . _DS_ . 'log.txt';
    }

    public function setException()
    {
        $object = $this->object;

        $entry = null;

        foreach ($object as $key => $value) {
            if ($key == 'type') {
                $entry .= $value;
            } elseif ($key == 'date') {
                $entry .= $value;
            }
        }

        var_dump($entry);


//        $entry = '['. $object['date'] . '] [' . $object['type'] . '] ' . $object['message'] . ' | ' . $object['filename'] . ' (line ' . $object['line'] . ')';
//
//        file_put_contents($this->file, $entry, FILE_APPEND | LOCK_EX);
    }
}

<?php

namespace App\Service;

class Slugifier
{
    public array $transcription = [
        'а' => 'a',
        'б' => 'b',
        'в' => 'v',
        'г' => 'g',
        'д' => 'd',
        'е' => 'e',
        'ё' => 'yo',
        'ж' => 'zh',
        'з' => 'z',
        'и' => 'i',
        'й' => 'y',
        'к' => 'k',
        'л' => 'l',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'п' => 'p',
        'р' => 'r',
        'с' => 's',
        'т' => 't',
        'у' => 'u',
        'ф' => 'f',
        'х' => 'kh',
        'ц' => 'c',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'sh',
        'ы' => '',
        'ь' => '',
        'ъ' => '',
        'э' => 'ye',
        'ю' => 'yu',
        'я' => 'ya',
        '-' => '',
        '_' => '',
        ' ' => ''
    ];

    public function slugify($string, $pascalCase = false): array|string|null {
        $string = mb_str_split(mb_strtolower($string));
        $result = null;
        $hyphen = null;

        for ($i = 0; $i <= count($string) - 1; $i++) {
            if ($pascalCase && $i == 0) {
                $result .= ucfirst($this->transcription[$string[$i]]);
            } elseif ($string[$i] == '-' || $string[$i] == ' ' || $string[$i] == '_') {
                $result .= $this->transcription[$string[$i]];
                $hyphen = $i + 1;
            } elseif ($pascalCase && $i == $hyphen) {
                $result .= ucfirst($this->transcription[$string[$i]]);
            } elseif (!isset($this->transcription[$string[$i]])) {
                $result .= '';
            } else {
                $result .= $this->transcription[$string[$i]];
            }
        }

        return str_replace('iy', 'y',$result);
    }
}

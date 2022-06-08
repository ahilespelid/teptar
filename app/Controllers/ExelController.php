<?php 
namespace App\Controllers ;
use App\Models;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExelController{
    public      $view, $model;
    protected   $pageData = [];

    public function __construct() {
       //$this->view  = new App\View;
        $this->model = new \App\Models\PageModel;
    }
/*/ -------------------------------------------------------------- Работа с файлом exel  -------------------------------------------------------------- /*/   
    public function work($q){
        echo '<style>body{white-space: nowrap;}</style>';
        $inputFileName = $GLOBALS['path']['dev'].$GLOBALS['path']['tmp']._DS_.'itog.xlsx';
        $inputFileType = 'Xlsx';
        
        $spreadsheet = new Spreadsheet();
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);

        $reader->setReadDataOnly(true);
        $worksheetData = $reader->listWorksheetInfo($inputFileName);
        
        foreach ($worksheetData as $worksheet) {
            $sheetName = (string) trim($worksheet['worksheetName']);
            /*/ if(false !== strpos($sheetName, 'СВ') || 69 == $i || 68 == $i || 67 == $i ){continue;} /*/
            /*/ echo $sheetName.'<br>';  //array_splice($ar,19);  /*/ 
            
            $reader->setLoadSheetsOnly($sheetName); $spreadsheet = $reader->load($inputFileName); $worksheet = $spreadsheet->getActiveSheet();
            
            $ar = $worksheet->toArray();
            $ar = array_slice($ar,2,17);
            
            $data[$sheetName] = $ar;
        } 
        
/*/     \pa($data);   /*/ 
 
 
        
 $sql = " "; $l = 1;      
 foreach($data as $k => $v){
     for($i=0, $c = count($v); $i < $c; $i++) {
         $sql .= $l." INSERT INTO `indexes` (`mark`, `district`, `2017`, `2018`, `2019`, `2020`, `o_sop`, `max_sop`, `min_sop`, `iso_o`, `t_str`, `max_str`, `min_str`, `istr_t`, `index`) ".
 "VALUES ('".$k."', '".$v[$i][0]."', '".$v[$i][1]."',  '".$v[$i][2]."',  '".$v[$i][3]."',   '".$v[$i][4]."',   '".$v[$i][5]."',  '".$v[$i][6]."',  '".$v[$i][7]."',  '".$v[$i][8]."',   '".$v[$i][9]."',   '".$v[$i][10]."',   '".$v[$i][11]."', '".$v[$i][12]."',  '".$v[$i][13]."');  <br>";
         $l++;}                     
     }
     
     echo  $sql;    
       //
       
       
/*/        
        if(!empty($_FILES)){          
            $uploadfile = $uploaddir.basename($_FILES['file']['name']); 
            move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
            echo $uploadfile;  
        }else{
echo '<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Drag and Drop exel</title>  
        <style type="text/css">
body {font: 12px Arial, sans-serif;}
#dropZone {color: #555; font-size: 18px; text-align: center; width: 400px; padding: 50px 0; margin: 50px auto; background: #eee; border: 1px solid #ccc; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;}
#dropZone.hover {background: #ddd;border-color: #aaa;}
#dropZone.error {background: #faa; border-color: #f00;}
#dropZone.drop {background: #afa;border-color: #0f0;} 
        </style>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script type="text/javascript">
 $(document).ready(function() {   
    var dropZone = $("#dropZone"),                                                        
        maxFileSize = 50000000; // максимальный размер фалйа - 50 мб.
    
    // Проверка поддержки браузером
    if (typeof(window.FileReader) == "undefined") {
        dropZone.text("Не поддерживается браузером!");
        dropZone.addClass("error");
    }
    
    // Добавляем класс hover при наведении
    dropZone[0].ondragover = function() {
        dropZone.addClass("hover");
        return false;
    };
    
    // Убираем класс hover
    dropZone[0].ondragleave = function() {
        dropZone.removeClass("hover");
        return false;
    };
    
    // Обрабатываем событие Drop
    dropZone[0].ondrop = function(event) {
        event.preventDefault();
        dropZone.removeClass("hover");
        dropZone.addClass("drop");
        
        var file = event.dataTransfer.files[0];
        
        // Проверяем размер файла
        if (file.size > maxFileSize) {
            dropZone.text("Файл слишком большой!");
            dropZone.addClass("error");
            return false;
        }

        // Проверяем тип
        var fileName = $(file)[0].name;
        var extension = fileName.split(".").pop().toLowerCase();
        if (~$.inArray(extension, ["xlsm", "xls", "xlsx"])) {
            console.log("file "+fileName+" load");
        } else {
            dropZone.text("Файл не exel!");
            dropZone.addClass("error");
            return false;
        }
        
        // Создаем запрос
        var xhr = new XMLHttpRequest();
        xhr.upload.addEventListener("progress", uploadProgress, false);
        xhr.onreadystatechange = stateChange;
        xhr.open("POST", "/exel");
        xhr.setRequestHeader("X-FILE-NAME", file.name);

        
        xhr.send(file);
    };
    
    // Показываем процент загрузки
    function uploadProgress(event) {
        var percent = parseInt(event.loaded / event.total * 100);
        dropZone.text("Загрузка: " + percent + "%");
    }
    
    // Пост обрабочик
    function stateChange(event) {
        if (event.target.readyState == 4) {
            if (event.target.status == 200) {
                console.log(event.target.responseText);
                dropZone.text("Загрузка успешно завершена!");
            } else {
                dropZone.text("Произошла ошибка!");
                dropZone.addClass("error");
            }
        }
    }
    
});   
  </script>
</head>

<body>
    
    <form action="/exel">
      <div id="dropZone">
        Для загрузки, перетащите файл сюда.
      </div>
    </form>
  
</body>
</html>
'; 
        }
 /*/       
    }
 /*/ -------------------------------------------------------------- Загрузка exel -------------------------------------------------------------- /*/     
    public function load(){
        $path = realpath('./').DIRECTORY_SEPARATOR.'404.php';
       if(file_exists($path)){include($path);}
        exit();       
    }    
}
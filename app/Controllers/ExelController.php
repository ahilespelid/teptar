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
        $inputFileName = $GLOBALS['path']['dev'].$GLOBALS['path']['tmp']._DS_.'itog.xlsx';
        $inputFileType = 'Xlsx';
        
        $spreadsheet = new Spreadsheet();
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);

        $reader->setReadDataOnly(true);
        $worksheetData = $reader->listWorksheetInfo($inputFileName);
        $i=0; $j = 0;
        foreach ($worksheetData as $worksheet) {++$i;
            $sheetName = $worksheet['worksheetName'];
            if(false !== strpos($sheetName, 'СВ') || 69 == $i || 68 == $i || 67 == $i ){continue;}
            
             
            //echo $sheetName.'<br>';
            $reader->setLoadSheetsOnly($sheetName); $spreadsheet = $reader->load($inputFileName); $worksheet = $spreadsheet->getActiveSheet();

            $sheetName = (55 == $i ) ? '39.1' : $sheetName;
            $sheetName = (56 == $i ) ? '39.2' : $sheetName;
            $sheetName = (57 == $i ) ? '39.3' : $sheetName;
            $sheetName = (58 == $i ) ? '39.4' : $sheetName;
            $sheetName = (59 == $i ) ? '39.5' : $sheetName;

            $sheetName = (61 == $i ) ? '40.1' : $sheetName;
            $sheetName = (62 == $i ) ? '40.2' : $sheetName;
            $sheetName = (63 == $i ) ? '40.3' : $sheetName;
            $sheetName = (64 == $i ) ? '40.4' : $sheetName;
            $sheetName = (65 == $i ) ? '40.5' : $sheetName;
            
            $data[$sheetName] = array_slice($worksheet->toArray(), 4,19);
            
            //\pa($worksheet->toArray());

           $j++;
        } 
 $sql = " ";       
 foreach($data as $k => $v){
     for($l=0; $l < 16; $i++) {
         $sql .= "INSERT INTO `indexes` (`mark`, `district`, `2017`, `2018`, `2019`, `2020`, `o_sop`, `max_sop`, `min_sop`, `iso_o`, `t_str`, `max_str`, `min_str`, `istr_t`, `index`) ".
 "VALUES ('".$k."', '".$v[$l][0]."', '".$v[$l][1]."',  '".$v[$l][2]."',  '".$v[$l][3]."',   '".$v[$l][4]."',   '".$v[$l][5]."',  '".$v[$l][6]."',  '".$v[$l][7]."',  '".$v[$l][8]."',   '".$v[$l][9]."',   '".$v[$l][10]."',   '".$v[$l][11]."', '".$v[$l][12]."',  '".$v[$l][13]."'); ";
         }
     }
     echo  $sql;    
       //\pa($data);
       
       
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
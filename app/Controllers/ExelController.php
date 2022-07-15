<?php 
namespace App\Controllers ;
use App;
use App\Service\Security;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExelController{
    public      $view, $model, $security;
    protected   $pageData = [];

    public function __construct() {
       //$this->view  = new App\View;
        $this->model = new \App\Models\AjaxModel;
        $this->security = new Security();
    }
/*/ -------------------------------------------------------------- Работа с файлом exel  -------------------------------------------------------------- /*/   
    public function work($q){
        //$get = $this->model->getRandTable();
        echo '<style>body{white-space: nowrap;}</style>';
        $inputFileName = $GLOBALS['path']['tmp']._DS_.'itog.xlsx';
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
            pa($ar);
            $ar = array_slice($ar,2,17);
            
            $data[$sheetName] = $ar;
        } 
        
        $dataLoad = $data; 
         /*/   /*/ 
 
/*/         
 $sql = " "; $l = 1;      
 foreach($data as $k => $v){
     for($i=0, $c = count($v); $i < $c; $i++) {
         $sql .= $l." INSERT INTO `indexes` (`mark`, `district`, `2017`, `2018`, `2019`, `2020`, `o_sop`, `max_sop`, `min_sop`, `iso_o`, `t_str`, `max_str`, `min_str`, `istr_t`, `index`) ".
 "VALUES ('".$k."', '".$v[$i][0]."', '".$v[$i][1]."',  '".$v[$i][2]."',  '".$v[$i][3]."',   '".$v[$i][4]."',   '".$v[$i][5]."',  '".$v[$i][6]."',  '".$v[$i][7]."',  '".$v[$i][8]."',   '".$v[$i][9]."',   '".$v[$i][10]."',   '".$v[$i][11]."', '".$v[$i][12]."',  '".$v[$i][13]."');  <br>";
         $l++;}                     
     }
       /*/     

 foreach($dataLoad as $k=>$v){
     
     for($i=0, $c = count($v); $i < $c; $i++) {
         
         
          for($l=1, $s = count($v[$i]); $l < $s; $l++) {
               
              $v[$i][$l] = (empty($v[$i][$l])) ? 0 : $v[$i][$l];
              //echo $v[$i][$l].'<br>';
              $stroka[$v[$i][0]][] = $v[$i][$l];
          }//echo '<br>';
          
          
     
     } $dataRet[$k] = $stroka; unset($stroka);
 }  
     
//pa($dataRet);
$sql = '';
foreach($dataRet as $index => $district){$i=1;foreach($district as $region){for($l=0;$l<=3;$l++){
    $date = (0 == $l) ? "2017-01-01 00:00:17" : (
                 (1==$l)   ? "2018-01-01 00:00:18" : (
                 (2 == $l) ? "2019-01-01 00:00:19" : "2020-01-01 00:00:20"));
    $sql .= "INSERT INTO `teptar`.`index` (`id_user`, `id_mark`, `id_district`, `index`, `date`) VALUES ('1', '".trim($index)."', '".$i."', '".$region[$l]."', '".$date."');<br>".PHP_EOL;
    
}$sql .= '<br>'; $i++;}}

//echo  $sql;         
    }                    
 /*/ -------------------------------------------------------------- Загрузка exel -------------------------------------------------------------- /*/     
    public function load(){
        exit();       
    }    
}

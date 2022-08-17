<?php
namespace App\Controllers ; use App\Service\Security;
/// */ Убираем вывод ошибок, устанавливаем необходимое количество памяти
ini_set('display_errors', 0); ini_set('display_startup_errors', 0); error_reporting(E_ALL); ini_set('memory_limit','0');  ini_set('memory_limit','0'); set_time_limit(0); /// */

class DiskController extends AbstractController{
    public  $model, $user, $path, $imgPath, $security;

    public function __construct() {
        $this->user = new UserController();
        $this->security = new Security();        
        $this->model = new \App\Models\IndexModel;
        $this->path = $GLOBALS['path']['disk'];
        $this->imgPath = _DS_.'assets'._DS_.'images'._DS_.'staff'._DS_;
        
    }
/*/ -------------------------------------------------------------- Диск -------------------------------------------------------------- /*/
    public function index($q){$xmr = ($_SERVER['HTTP_X_REQUESTED_WITH']) ?? false;
        $path = $this->path;
        if(!empty($q['07c5be14']) && str_starts_with($q['07c5be14'], $this->path)){$path = $q['07c5be14'];}
    
        if($xmr && !empty($q)){
            $file = (file_exists($q['05c7be12'])) ? $q['05c7be12'] : false;
            $rm = ('c287b455c3d5' == $q['bb4de946']) ? 1 : 0;           
            if($file){
                if (ob_get_level()){ob_end_clean();}
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . basename($file));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                $return = @readfile($file);
                if(-1 == $return){
                    $zip = $this->zip($file);
                    header("Content-Type: application/zip");
                    header('Content-Length: ' . filesize($zip));
                    $return = @readfile($zip);
                }
                if($rm){
                    $this->rm($file); 
                    if(-1 == $return){
                        echo PHP_EOL.'(' . basename($file) . ').'.PHP_EOL.'ahilespelid@yandex.ru'.PHP_EOL;
                }}
                echo $return;
                
                exit;
        }}
        //$this->rm('/var/www/disk/log1');        
      
        $dirs = $this->dirScan($path,'d');
        $files = $this->dirScan($path,'f');

        $this->render('/staff/profile/disk.php', [
            'dirs' => $dirs,
            'files' => $files,
        ]);

    }    
///*/ Сканирование файлов и папок ///*/
    public function dirScan($dir, $fORd = 'a'){$dir = (empty($dir)) ? $this->path : ((is_dir($dir)) ? $dir : false);
        if($dir){$dir = ($this->is_seporator($dir)) ? $dir : $dir._DS_; $scanDir = array_diff(scandir($dir), array('..', '.'));
        
        foreach($scanDir as $v){$fileORdir = $dir.$v; if(($fORd == 'd' && is_file($fileORdir)) || ($fORd == 'f' && is_dir($fileORdir))){continue;}
            $type = (is_file($fileORdir)) ? 'f' : 'd';
            $img = $this->imgPath.(('d' == $type) ? 'dir.svg' : ((file_exists($GLOBALS['path']['dev'].$this->imgPath.$svg = pathinfo($fileORdir, PATHINFO_EXTENSION).'.svg')) ? $svg : 'def.svg'));
            $ret = ['img' => $img, 'type' => $type, 'path' => $fileORdir, 'name'=> $v, 'user' => $this->user->getLoginUser()['id']];  
            if('f' == $type){$ret['mime'] = (new \finfo(FILEINFO_MIME_TYPE))->file($fileORdir);} $return[] = $ret;
        }}else{return false;}
    return (is_array($return) && !empty($return)) ? $return : false;}
///*/ Удаление файлов ///*/
    public function rm($path){
        return !empty($path) && is_file($path) ? unlink($path) : (array_reduce(glob($path.'/*'), function ($r, $i) { return $r && $this->rm($i); }, true)) && rmdir($path);
    }
///*/ Переименование файла ///*/   
    public function rn($path, $name){
        $name = (trim($name)) ?? false;
        if(!file_exists($path) && !is_string($name)){return false;}
        return rename($path, pathinfo($path)['dirname']._DS_. str_replace(' ', '_', $name));
    } 
 ///*/ Проверяет наличие сепоратора в начале или конце переданного пути ///*/       
    public function is_seporator($dir, $sORe = 'e'){
        if(!is_string($dir) && empty($dir)){return false;}
        if('e' == $sORe){
            if(str_ends_with($dir, DIRECTORY_SEPARATOR)){return true;}
        } elseif ('s' == $sORe){
            if(str_starts_with($dir, DIRECTORY_SEPARATOR)){return true;}
        }
    return false;}
///*/ Заворачивает каталог в архив ///*/ 
    public static function zip($source){
        $destination = sys_get_temp_dir()._DS_.uniqid('arh').'.zip';
        if (!extension_loaded('zip') || !file_exists($source)){return false;}
        $zip = new \ZipArchive(); 
        if(!$zip->open($destination, \ZipArchive::CREATE)){return false;}
        
        $source = str_replace(['\\', '/'], _DS_, realpath($source));
        
        if (is_dir($source)){
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($source), \RecursiveIteratorIterator::SELF_FIRST);
            foreach ($files as $file){
                $file = str_replace(['\\', '/'], _DS_, $file);
                if ($file == '.' || $file == '..' || empty($file) || _DS_ == $file){continue;}
                if (in_array(substr($file, strrpos($file, _DS_) + 1), array('.', '..'))){continue;}
                
                $file = realpath($file); $file = str_replace(['\\', '/'], _DS_, $file);
                
                if (is_dir($file)){
                    $d = str_replace($source . _DS_, '', $file);
                    if (empty($d)){continue;}
                    $zip->addEmptyDir($d);
                } elseif (is_file($file)){
                    $zip->addFromString(str_replace($source . _DS_, '', $file),file_get_contents($file));
        }}} elseif (is_file($source)){$zip->addFromString(basename($source), file_get_contents($source));}
        return ($zip->close()) ? $destination : false;}  

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// перезаписать файл
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function SetFile($file, $array)
{
$s = 1;

foreach ($array as $value) {
if ($s === 1) {
file_put_contents($file, $value."\r\n");
$s++;
} else {
file_put_contents($file, $value."\r\n", FILE_APPEND | LOCK_EX);
}
}
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Переименование файлов (работает для директорий) 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function rename($file_old, $file_new) {
        $file_old = $this -> dopRes($file_old);
        $file_new = $this -> dopRes($file_new);
        rename($file_old, $file_new);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Создание файла
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function File_great($file, $text, $options = 'r') {

        $file = $_SERVER['DOCUMENT_ROOT'].'/'.$file;

        if (!file_exists($file)) {
            $fp = fopen($file, $options);

            if (!$text == '') {
                fwrite($fp, $text);

            }   fclose($fp);
        } else {
            $fp = fopen($file, $options);

            if (!$text == '') {
                fwrite($fp, $text);

            }   fclose($fp);
        }
    }
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Создание директории
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function Dir_great($dir, $glob) {
        $dir = $this -> dopRes($dir);
        $structure = $_SERVER['DOCUMENT_ROOT'].'/'.$dir;

        if ($glob == true) {
            if (@!mkdir($structure, 0777, true)) {
                // die('Не удалось создать путь из директорий.');
                return false;
            }
        } else {
            if (@!mkdir($structure, 0777)) {
                // die('Не удалось создать директорию.');
                return false;
            }
        }
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Удаление директории
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function Dir_delit($dir) {
        $dir = $this -> dopRes($dir);
        $dir = $_SERVER['DOCUMENT_ROOT'].'/'.$dir;
        if ($objs = glob($dir."/*")) {
            foreach($objs as $obj) {
                is_dir($obj) ? Dir_delit($obj) : unlink($obj);
            }
        }   rmdir($dir);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Рекурсивное слияние и - или копирование дерикотрии с файлами внутри
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function recurCopy($from, $to) {
        $from = $this -> dopRes($from);
        $to = $this -> dopRes($to);
        $structure = $_SERVER['DOCUMENT_ROOT'].'/'.$from;
        $structure2 = $_SERVER['DOCUMENT_ROOT'].'/'.$to;
        if(!file_exists($structure2)){
            mkdir($structure2);
        }
        if ($objs = glob($structure."/*")) {
            foreach($objs as $obj) {
                $forto=$structure2.str_replace($structure, '', $obj);
                if(is_dir($obj)){
                    recurCopy($obj, $forto);
                } else {
                    copy($obj, $forto);
                }
            }
        } return true;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// считает колличество файлов в указанной дериктории
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function CountFile($value)
    {
        $value = $this -> dopRes($value);
        $dir = opendir($_SERVER['DOCUMENT_ROOT'].'/'.$value);
        $count = 0;
        while($file = readdir($dir)){
            if($file == '.' || $file == '..' || is_dir($_SERVER['DOCUMENT_ROOT'] .'/'. $value . $file)){
                continue;
            }
            $count++;
        }
        return $count;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// вспомогательная функция для внутреннего использования внутри класса (удаляет слешь в начале - если есть)
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    private function dopRes($dir)
    {
        if ($dir[0] == '/') {
            $dir = mb_substr($dir, 1);
        }

        return $dir;
    }

    private function dopUrl($dir)
    {
        $dir = $_SERVER['DOCUMENT_ROOT'].'/'.$dir;
        return $dir;
    }

    private function dopCube($Search_str, $key, $i) 
    {
        unset($this -> in_file_clon[$key]);
    }
    
    public function scan(object $iterator){$filelist =[];
        foreach($iterator as $entry) {$filelist[] = $entry->getFilename();}
        return $filelist;
    }
     /*/ -------------------------------------------------------------- Диск страница загрузки-------------------------------------------------------------- /*/
    public function upload($q){
?><style type="text/css">
body {font-family: sans-serif;overflow:  hidden;}
#drop-area {display: block; border: 2px dashed #ccc; border-radius: 20px; width: 99vw; height: 96vh; text-align: center; padding-top: 20px; overflow: auto; -ms-overflow-style: none; scrollbar-width: none;}
#drop-area.highlight {border-color: purple;}
p{margin-top: 0;}
.my-form {margin-bottom: 10px;}
#gallery {margin-top: 10px;}
#gallery img {width: 150px; margin-bottom: 10px; margin-right: 10px; vertical-align: middle;}
.button {display: inline-block; padding: 10px; background: #ccc; cursor: pointer; border-radius: 5px; border: 1px solid #ccc;}
.button:hover {background: #ddd;}
#fileElem {display: none;}
</style>
<script type="text/javascript">window.onload = function() {
let dropArea = document.getElementById("drop-area");

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {dropArea.addEventListener(eventName, preventDefaults, false); document.body.addEventListener(eventName, preventDefaults, false);});
['dragenter', 'dragover'].forEach(eventName => {dropArea.addEventListener(eventName, highlight, false)});
['dragleave', 'drop'].forEach(eventName => {dropArea.addEventListener(eventName, unhighlight, false)});

dropArea.addEventListener('drop', handleDrop, false);

function preventDefaults (e) {e.preventDefault(); e.stopPropagation();}
function highlight(e){dropArea.classList.add('highlight');}
function unhighlight(e){dropArea.classList.remove('active');}
function handleDrop(e){let dt = e.dataTransfer, files = dt.files; handleFiles(files);}

let uploadProgress = [], progressBar = document.getElementById('progress-bar');

function initializeProgress(numFiles){progressBar.value = 0; uploadProgress = [];for(let i = numFiles; i > 0; i--){uploadProgress.push(0);}}
function updateProgress(fileNumber, percent){uploadProgress[fileNumber] = percent; let total = uploadProgress.reduce((tot, curr) => tot + curr, 0) / uploadProgress.length; progressBar.value = total;}
function handleFiles(files){files = [...files]; initializeProgress(files.length); files.forEach(uploadFile); files.forEach(previewFile);}
function previewFile(file){let reader = new FileReader(); reader.readAsDataURL(file); reader.onloadend = function(){let img = document.createElement('img'); img.src = reader.result; document.getElementById('gallery').appendChild(img);}}
function uploadFile(file, i) {
    console.log(file.name);
    console.log(i);

    let url = '/disk/up', xhr = new XMLHttpRequest(), formData = new FormData()

    xhr.open('POST', url, true); xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.upload.addEventListener("progress", function(e){updateProgress(i, (e.loaded * 100.0 / e.total) || 100);});
    xhr.addEventListener('readystatechange', function(e){
        if (xhr.readyState == 4 && xhr.status == 200){
        updateProgress(i, 100);
        }else if(xhr.readyState == 4 && xhr.status != 200){
        // Error. Inform the user
    }});

    formData.append('num', i);
    formData.append('name', file.name);
    formData.append('file', file);
    xhr.send(formData);
}

let fileElem = document.getElementById('fileElem'); fileElem.addEventListener('change', (e) => {handleFiles(fileElem.files);}, false); }
</script> 
 
<div id="drop-area">
  <form class="my-form">
    <p>Загрузите несколько файлов с помощью диалогового окна "Файл" или перетаскивая изображения в область, отмеченную пунктиром</p>
    <input type="file" id="fileElem" multiple>
    <label class="button" for="fileElem">Выберите файлы</label>
  </form>
  <progress id="progress-bar" max=100 value=0></progress>
  <div id="gallery"></div>
</div>

<?php     
 
    
    
    
    
    
    
    
    
    
    
    }   

    
    
    
}

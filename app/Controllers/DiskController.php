<?php
namespace App\Controllers ; use App\Service\Security;
/// */ Убираем вывод ошибок, устанавливаем необходимое количество памяти
ini_set('display_errors', 0); ini_set('display_startup_errors', 0); error_reporting(E_ALL); ini_set('memory_limit','0');  ini_set('memory_limit','0'); set_time_limit(0); ini_set('upload_max_filesize', '100M'); /// */

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
        $ajaxPath = (!empty($q['07c5be14'])) ? $q['07c5be14'] : ((!empty($_REQUEST['07c5be14'])) ? $_REQUEST['07c5be14'] : false);
        $path = (!empty($ajaxPath) && str_starts_with($ajaxPath, $this->path)) ? $ajaxPath : $this->path;
///*/ Обработка выгрузки и\или удаления ///*/        
        if($xmr){
            $file = (file_exists($q['05c7be12'])) ? $q['05c7be12'] : false;
            $rm = ('c287b455c3d5' == $q['bb4de946']) ? 1 : 0;           
            $rn = ('621f0bb63e77' == $q['bb4de946']) ? 1 : 0;           
            $mk = ('777f0bb63e77' == $q['bb4de946']) ? 1 : 0;           
            if($file){
                if (ob_get_level()){ob_end_clean();}
                if(!$rn){
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename=' . basename($file));
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($file));}
                if(empty($return = @file_get_contents($file))){
                    $zip = $this->zip($file);
                    header("Content-Type: application/zip");
                    header('Content-Length: ' . filesize($zip));
                    $return = @file_get_contents($zip);
                }
                if($rm){$this->rm($file); echo $return; exit;} ///*/  Удаление ///*/ 
                if($mk){if($newDirPath = $this->mk($file, $q['45208e6e'])){
                    $this->model->getQuery($sql = "INSERT INTO `".$this->model->tableDisk."` VALUES (NULL,'".$newDirPath."', ".$this->user->getLoginUser()['id'].") ON DUPLICATE KEY UPDATE `id_user`= ".$this->user->getLoginUser()['id'].";", false);
                } exit;} ///*/  Создание каталога ///*/ 
                if($rn){///*/ Переименование ///*/ 
                    header('Content-Type: text/html; charset=utf-8');
                    if (ob_get_level()){ob_end_clean();}
                    if(str_starts_with($q['05c7be12'], $this->path)){echo $this->rn($file, $q['35208e6e']); exit;}      
                }else{echo $return; exit;}}                
       
            ///*/  Обработка загрузки на диск ///*/
            if(!empty($_POST['6f6Ad9D4'])){
                $input_name = '29D7367d'; 
                $allow = array('docx', 'xlsx', 'doc',  'xls',  'txt',  'tar',  'zip',  'rar',  '7z',  '7zip',  'gz',  'png',  'jpg',  'jpeg',  'gif',  'webp',  'mp3',  'mp4',  'mpeg'); 
                $deny = array('phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp', 'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html', 'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi', 'exe');
                echo ini_get('upload_max_filesize');
                $path = (!empty($_POST['6f6Ad9D4']) && str_starts_with($_POST['6f6Ad9D4'], $this->path)) ? $_POST['6f6Ad9D4'] : $this->path;
                $path = ($this->is_seporator($path)) ? $path :  $path._DS_;
                $data = array();
                ///*/ 
                pa($_FILES); ///*/
                if(!isset($_FILES[$input_name])){$error = 'Файлы не загружены.';}else{
                    $files = array();
                    $diff = count($_FILES[$input_name]) - count($_FILES[$input_name], COUNT_RECURSIVE);
                    if ($diff == 0){$files = array($_FILES[$input_name]);}else{
                        foreach($_FILES[$input_name] as $k => $l){foreach($l as $i => $v){$files[$i][$k] = $v;}
                    }}
                foreach ($files as $file){$error = $success = '';
                    if (!empty($file['error']) || empty($file['tmp_name'])){$error = 'Не удалось загрузить файл.';}
                    elseif($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])){$error = 'Не удалось загрузить файл.1';}
                    else{
                        $pattern = "[^A-zА-яЁё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";  pa($file); 
                        $name = mb_eregi_replace($pattern, '-', $file['name']);  pa($name);$name = mb_ereg_replace('[-]+', '-', $name);
                        $parts = pathinfo($name);
                        
                        if (empty($name) || empty($parts['extension'])){$error = 'Недопустимый тип файла';}
                        elseif(!empty($allow) && !in_array(strtolower($parts['extension']), $allow)){$error = 'Недопустимый тип файла (позволять)';}
                        elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)){$error = 'Недопустимый тип файла (запрещать)';}
                        else{
                            if (move_uploaded_file($file['tmp_name'], $path . $name)){
                                $this->model->getQuery($sql = "INSERT INTO `".$this->model->tableDisk."` VALUES (NULL,'".$path.$name."', ".$this->user->getLoginUser()['id'].") ON DUPLICATE KEY UPDATE `id_user`= ".$this->user->getLoginUser()['id'].";", false); 
                                $data[] = $sql;
                                $success = $path . $name. ' Файл «' . $name . '» успешно загружен.';}
                            else{$error = 'Не удалось загрузить файл.';
                    }}}
                    if (!empty($success)){$data[] = '<p style="color: green">' . $success . '</p>';}
                    if (!empty($error)){$data[] = '<p style="color: red">' . $error . '</p>'; }
            }}header('Content-Type: text/html; charset=utf-8'); foreach($data as $d){echo $d.'<br>';} exit;}
        }
        
        $dirs = $this->dirScan($path,'d');
        $files = $this->dirScan($path,'f');

        $return = $this->render('/staff/profile/disk.php', [
            'dirs' => $dirs,
            'files' => $files,
            'path' => $path,
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
///*/ Создание директории ///*/ 
    public function mk($path, $name, $glob = false){
        if(!str_starts_with($path, $this->path)){return false;}        
        $structure = (($this->is_seporator($path)) ?  $path :  $path._DS_). str_replace(' ', '_', $name);
        return (@!mkdir($structure, 0777, $glob)) ? false : $structure;
    }
}

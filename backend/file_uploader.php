<?php
/****************************************
Example of how to use this uploader class...
You can uncomment the following lines (minus the require) to use these as your defaults.
// list of valid extensions, ex. array("jpeg", "xml", "bmp")
/******************************************/
$config['dbhost'] = "aggeloiDB.db.9904379.hostedresource.com";
    $config['dbname'] = "aggeloiDB";
    $config['dbuser'] = "aggeloiDB"; 
    $config['dbpass'] = "Aggeloi582654!";
    
    if($config['dbhost'] && $config['dbname'] && $config['dbuser']){
       $dbcnx = @mysql_connect($config['dbhost'], $config['dbuser'], $config['dbpass']);
            $db = @mysql_select_db($config['dbname']);
    }
/**
 * Handle file uploads via XMLHttpRequest
 */
class qqUploadedFileXhr {
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {    
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);
        
        if ($realSize != $this->getSize()){            
            return false;
        }
        
        $target = fopen($path, "w");        
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);
        
        return true;
    }
    function getName() {
        return $_GET['qqfile'];
    }
    function getSize() {
        if (isset($_SERVER["CONTENT_LENGTH"])){
            return (int)$_SERVER["CONTENT_LENGTH"];            
        } else {
            throw new Exception('Getting content length is not supported.');
        }      
    }   
}
/**
 * Handle file uploads via regular form post (uses the $_FILES array)
 */
class qqUploadedFileForm {  
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {
        if(!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)){
            return false;
        }
        return true;
    }
    function getName() {
        return $_FILES['qqfile']['name'];
    }
    function getSize() {
        return $_FILES['qqfile']['size'];
    }
}
class qqFileUploader {
    private $allowedExtensions = array();
    private $sizeLimit = 10485760;
    private $file;
	private $uploadName;
    function __construct(array $allowedExtensions = array(), $sizeLimit = 10485760){        
        $allowedExtensions = array_map("strtolower", $allowedExtensions);
            
        $this->allowedExtensions = $allowedExtensions;        
        $this->sizeLimit = $sizeLimit;
        
        $this->checkServerSettings();       
        if (isset($_GET['qqfile'])) {
			$this->file = new qqUploadedFileXhr();
        } elseif (isset($_FILES['qqfile'])) {
            $this->file = new qqUploadedFileForm();
        } else {
            $this->file = false; 
        }
    }
    
	public function getUploadName(){
		if( isset( $this->uploadName ) )
			return $this->uploadName;
	}
	
	public function getName(){
		if ($this->file)
			return $this->file->getName();
	}
    
    private function checkServerSettings(){        
        $postSize = $this->toBytes(ini_get('post_max_size'));
        $uploadSize = $this->toBytes(ini_get('upload_max_filesize'));        
        
        if ($postSize < $this->sizeLimit || $uploadSize < $this->sizeLimit){
            $size = max(10, $this->sizeLimit / 1024 / 1024) . 'M';             
            die("{'error':'increase post_max_size and upload_max_filesize to $size'}");    
        }        
    }
    
    private function toBytes($str){
        $val = trim($str);
        $last = strtolower($str[strlen($str)-1]);
        switch($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;        
        }
        return $val;
    }
    
    /**
     * Returns array('success'=>true) or array('error'=>'error message')
     */
    function handleUpload($uploadDirectory, $replaceOldFile = FALSE){
        if (!is_writable($uploadDirectory)){
            return array('error' => "Server error. Upload directory isn't writable.");
        }
        
        if (!$this->file){
            return array('error' => 'No files were uploaded.');
        }
        
        $size = $this->file->getSize();
        
        if ($size == 0) {
            return array('error' => 'File is empty');
        }
        
        if ($size > $this->sizeLimit) {
            return array('error' => 'File is too large');
        }
        
        $pathinfo = pathinfo($this->file->getName());
        //$filename = $pathinfo['filename'];
        $filename = md5(uniqid());
        $ext = @$pathinfo['extension'];		// hide notices if extension is empty
        if($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)){
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'File has an invalid extension, it should be one of '. $these . '.');
        }
        
        if(!$replaceOldFile){
            /// don't overwrite previous files that were uploaded
            while (file_exists($uploadDirectory . $filename . '.' . $ext)) {
                $filename .= rand(10, 99);
            }
        }
        
		$this->uploadName = $filename . '.' . $ext;
		
        if ($this->file->save($uploadDirectory . $filename . '.' . $ext)){
            return array('success'=>true,'filename'=>$this->uploadName);
        } else {
            return array('error'=> 'Could not save uploaded file.' .
                'The upload was cancelled, or server error encountered');
        }
        
    }    
}
/***************UPLOAD PROCESS STARTS FRM HERE***************/
    $current_date = date("Y-m-d g:i:s");
    $uploader = new qqFileUploader();
    $result = $uploader->handleUpload('../uploads/images/');    
    $allowed_extensions_ = array("jpeg","jpg","jpe","png","gif");
    $elements=explode(".",$result['filename']);
    $t=count($elements);
    $extension=$elements[$t-1];
    $img_name=$result['filename'];
    $date_insert=date("Y-m-d H:i:s",time());
    if(in_array(strtolower($extension),$allowed_extensions_)){
        include("classes/class.imageResize.php");
        $image_resize= new imageResize();
        /*Check if the uploaded image has width greater than 800*/
        $image_resize->load('../uploads/images/'.$result['filename']);
        if($image_resize->getWidth()>800){
            $image_resize->resizeToWidth(800);                      // CHECK image size to reduce system disk use.
            $image_resize->save('../uploads/images/'.$result['filename']);       // SAVE 600px IMAGE         
        }
        /*Check if the uploaded image has height greater than 800*/
        $image_resize->load('../uploads/images/'.$result['filename']);
        if($image_resize->getHeight()>800){
            $image_resize->resizeToHeight(800);                      // CHECK image size to reduce system disk use.
            $image_resize->save('../uploads/images/'.$result['filename']);       // SAVE 600px IMAGE         
        }
        //create 1 thumbnail with 225px
        $image_resize->resizeToWidth(640);                 
        $image_resize->save('../uploads/images/640/'.$result['filename']);
        //create 1 thumbnail with 225px
        $image_resize->resizeToWidth(245);                 
        $image_resize->save('../uploads/images/245/'.$result['filename']);
        //create 1 thumbnail with 755px
        $image_resize->resizeToHeight(90);                    
        $image_resize->save('../uploads/images/90/'.$result['filename']);
        list($width, $height, $type, $attr) = getimagesize('../uploads/images/'.$result['filename']);
        if($_REQUEST['table'] == 'gallery'){ 
            mysql_query("INSERT INTO gallery (category,image_name,status) VALUES  ('".$_REQUEST['category']."','$img_name','1')");
            $id_=mysql_insert_id();
            $result['file_id']=$id_;
            $result['file_name']=$result['filename'];
        }elseif($_REQUEST['table'] == 'menu_images'){ 
            mysql_query("INSERT INTO menu_images(image_name,menu_id,default_image,date_insert) VALUES ('$img_name','".$_REQUEST['page']."','0','$date_insert')");
                
            $id_=mysql_insert_id();
            $result['file_id']=$id_;
            $result['file_name']=$result['filename'];
        }
        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    }else{
        $r['success']=false;
        $r['message']="Unsupported file type.";
       // @unlink("upload_folder/".$result['filename']);
        echo htmlspecialchars(json_encode($r), ENT_NOQUOTES);
    }
?>
	
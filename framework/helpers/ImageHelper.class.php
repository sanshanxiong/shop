<?php
/**
 * Created by PhpStorm.
 * User: qcx
 * Date: 2017/1/11
 * Time: 21:30
 */
class ImageHelper{
    private $_imageTypes=[
        'image/jpg',
        'image/jpeg',
        'image/png',
        'image/pjpeg',
        'image/gif',
        'image/bmp',
        'image/x-png'];
    private $_size,$_type;
    public $_height,$_width;
    private $_orignName;
    private $_saveName;
    const SAVE_PATH=PUBLIC_PATH."uploads".DS;//const前面好像是不能加public 等修饰
    private $_fileObj;
    private $_msg;
    public function __construct($fileOjb)
    {
        //$this->_type = $fileOjb["type"];
        $this->_fileObj = $fileOjb;
        $this->_orignName = $fileOjb['name'];
        $this->_ext = explode('.',$fileOjb['name'])[1];
        $this->_saveName=md5_file($fileOjb['tmp_name']).".".$this->_ext;
        $this->_size = ($fileOjb['size']/1024)."Kb";
        list($this->_width,$this->_height,$this->_type,$attr) = getimagesize($fileOjb['tmp_name']);
    }
    public function isValid($type)
    {
        if(!in_array($type, $this->_imageTypes) )
        {
            $this->_msg=$this->msg." invalid type";
            return false ;
        }
        return true;
    }
    public function  uploadImage()
    {

        if (file_exists(self::SAVE_PATH.$this->_saveName))
        {
            //echo $_FILES["file"]["name"] . " already exists. ";
            echo $this->_orignName." already exists. ";
            $this->_msg=$this->_msg.$this->_orignName." already exists. ";
        }
        else
        {
            move_uploaded_file($this->_fileObj["tmp_name"],
                self::SAVE_PATH.$this->_saveName);
            echo "Stored in: " . self::SAVE_PATH . $this->_saveName;
            $this->_msg=$this->msg."Stored in: " .  self::SAVE_PATH.$this->_saveName  ;
        }
    }
    public function imageInfo(){
        return  1;
    }
    public function printInfo()
   {
     echo $this->_saveName." ".$this->_size." ".$this->_width." ".$this->_height." ".$this->_type;
       echo $this->_msg;
   }
}
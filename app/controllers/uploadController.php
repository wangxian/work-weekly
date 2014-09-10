<?php
 /**
 +------------------------------------------------------------------------------
 * upload相关处理 支持html5
 +------------------------------------------------------------------------------
 * @version 3.0
 * @author  WangXian
 * @email    <admin@loopx.cn>
 * @creation date 2011-4-25 上午10:59:31
 * @last modified 2011-4-25 上午10:59:31
 +------------------------------------------------------------------------------
 */
class uploadController extends controller
{
    private $savepath = '/assets/attachments/'; //资源保存的路径,相对于服务器webroot
    private $max_filesize=2097152; //2M,上传最大文件

    private $err = '';
    private $msg = '';
    private $upload_file = array();
    private $webpath = '';
    private $filepath = '';

    public function __construct()
    {
        Session::init();
        if( empty($_SESSION['sysuser']) ) exit('404');
    }

    /** xheditor上传图片。*/
    public function imgAction()
    {
        $allow_ext = array(1,2,3); //允许的图片类型
        $maxwidth  = getv("w", "500");
        $maxheight = getv("h", "400");

        $this->_upload(); //上传资源
        //C('show_errors','main',false);//不显示错误

        if(empty($this->err))
        {
            $imginfo = getimagesize($this->upload_file['tmp_name']);
            $imgtype = array(1=>'gif', 2=>'jpg', 3=>'png', 4=>'swf', 5=>'psd', 6=>'bmp', 7=>'tiff(intel byte order)', 8=>'tiff(motorola byte order)', 9=>'jpc', 10=>'jp2', 11=>'jpx', 12=>'jb2', 13=>'swc', 14=>'iff', 15=>'wbmp', 16=>'xbm');
            if( in_array($imginfo[2], $allow_ext) )
            {
                $realname=uniqid().'.'.$imgtype[$imginfo[2]];
                if( Image::thumbImg($this->upload_file['tmp_name'], $this->filepath.$realname, $maxwidth,$maxheight) )
                {
                    $this->msg=$this->webpath.$realname;
                }
                else
                {
                    $this->err = '裁剪图片失败！';
                }
		        }
		        else $this->err='上传文件扩展名必需为jpg,jpeg,png,gif';
        }

        echo $this->_output();
    }

    public function galleryAction()
    {

        $this->_upload(); //上传资源

        if(empty($this->err))
        {
            $realname=uniqid().$this->upload_file['ext'];
            $this->msg=$this->webpath.$realname;

            $square = getv("square");
            $size   = getv("size", 75);
            $category = getv("t", "list");

            if($category == "list")
            {
                $this->thumbImg($this->upload_file['tmp_name'], $this->filepath.$realname."_thumb.jpg", $size, $size);
            }

            if(!$square)
                copy($this->upload_file['tmp_name'], $this->filepath.$realname);
            else
                $this->thumbImg($this->upload_file['tmp_name'], $this->filepath.$realname, $size, $size);
            // copy($this->upload_file['tmp_name'], $this->filepath.$realname);

            // 入库
            $m = new model;
            $m->table("b_gallery")
              ->set(array(
                    "img"=>$this->msg,
                    "category"=>$category,
                    "created"=>date("Y-m-d H:i:s")
                ))
              ->insert();
        }

        echo $this->_output();
    }

    public function swfuploadAction()
    {

        $this->_upload(); //上传资源
        //C('show_errors','main',false);//不显示错误

        $square = getv("square");
        $size   = getv("size", 75);

        if(empty($this->err))
        {
            $realname=uniqid().$this->upload_file['ext'];
            $this->msg=$this->webpath.$realname;

            // 裁剪出一个正方形的图形
            if(!$square)
                copy($this->upload_file['tmp_name'], $this->filepath.$realname);
            else
                $this->thumbImg($this->upload_file['tmp_name'], $this->filepath.$realname, $size, $size);
        }

        echo $this->_output();
    }

    /*
    * 裁剪正方形图片，多余的部分，填充黑色
    */
    function thumbImg($srcfile,$dstfile,$thumbWidth,$thumbHeight)
    {
        $imageinfo = getimagesize($srcfile);
        if(empty($imageinfo)) throw new ephpException('只支持gif,jpg,png的图片');
        // dump($imageinfo);

        if($imageinfo[2] == 1) $im = imagecreatefromgif($srcfile);
        elseif( $imageinfo[2] == 2 ) $im = imagecreatefromjpeg($srcfile);
        elseif( $imageinfo[2] == 3 ) $im = imagecreatefrompng($srcfile);
        else
        {
            throw new ephpException('只支持gif,jpg,png的图片');
        }

        $w = $imageinfo[0];
        $h = $imageinfo[1];

        /* 正方形图形 */
        $target_ratio = $thumbWidth / $thumbHeight;
        $img_ratio = $w / $h;

        if($target_ratio > $img_ratio)
        {
            $new_height = $thumbHeight;
            $new_width = $img_ratio * $thumbHeight;
        }
        else
        {
            $new_height = $thumbWidth / $img_ratio;
            $new_width = $thumbWidth;
        }

        if ($new_height > $thumbHeight) $new_height = $thumbHeight;
        if ($new_width > $thumbWidth) $new_height = $thumbWidth;

        /* 正方形图形 */


        $ni = imagecreatetruecolor($thumbWidth, $thumbHeight);
        // imagecopyresampled($ni, $im, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $w, $h);
        imagecopyresampled($ni, $im, ($thumbWidth-$new_width)/2, ($thumbHeight-$new_height)/2, 0, 0, $new_width, $new_height, $w, $h);
        imagejpeg($ni, $dstfile);
        imagedestroy($im);

        return true;
    }

    private function _upload()
    {
        $savepath = $this->savepath.date('Ym').'/';
        $this->filepath = $_SERVER['DOCUMENT_ROOT'].$savepath; // 当前目录
        // $this->webpath = 'http://'.$_SERVER['HTTP_HOST'].$savepath; // web目录
        $this->webpath = $savepath; // web目录

        $inputname = 'filedata'; // 表单文件域name
        if(! is_dir($this->filepath) ) mkdir($this->filepath,0777);


        if(isset($_SERVER['HTTP_CONTENT_DISPOSITION'])&&preg_match('/attachment;\s+name="(.+?)";\s+filename="(.+?)"/i',$_SERVER['HTTP_CONTENT_DISPOSITION'],$info))
        {//HTML5上传
            $tmp_name = $this->filepath.uniqid();
            file_put_contents($tmp_name,file_get_contents("php://input"));
            $this->upload_file['name'] = $info[2]; //原始名称
            $this->upload_file['tmp_name'] = $tmp_name; //上传后名称
            $this->upload_file['ext'] = strrchr($info[2],'.');//源文件扩展名
        }
        else
        {
            if(empty($_FILES[$inputname])) $this->err='表单域名称设置错误！';
            elseif(!empty($_FILES[$inputname]['error']))
            {
                switch($_FILES[$inputname]['error'])
                {
                    case '1':
                        $this->err = '文件大小超过了php.ini定义的upload_max_filesize值';
                        break;
                    case '2':
                        $this->err = '文件大小超过了HTML定义的MAX_FILE_SIZE值';
                        break;
                    case '3':
                        $this->err = '文件上传不完全';
                        break;
                    case '4':
                        $this->err = '无文件上传';
                        break;
                    case '6':
                        $this->err = '缺少临时文件夹';
                        break;
                    case '7':
                        $this->err = '写文件失败';
                        break;
                    case '8':
                        $this->err = '上传被其它扩展中断';
                        break;
                    case '999':
                    default:
                        $this->err = '无有效错误代码';
                }
            }
            elseif( empty($_FILES[$inputname]['tmp_name']) || $_FILES[$inputname]['tmp_name'] == 'none')
            {
            		$this->err = '无文件上传';
            }
            else
            {
                $this->upload_file = $_FILES[$inputname];
                $this->upload_file['ext'] = strrchr($_FILES[$inputname]['name'],'.');//源文件扩展名
            }
        }


        if(empty($this->err))
        {
            $filesize = filesize($this->upload_file['tmp_name']);
            if($filesize > $this->max_filesize) $this->err = '上传文件大于：'.$this->format_filesize($this->max_filesize);
        }
    }

    function format_filesize($bytes)
    {
        if($bytes >= 1073741824)  $bytes = round($bytes / 1073741824 * 100) / 100 . 'GB';
        elseif($bytes >= 1048576) $bytes = round($bytes / 1048576 * 100) / 100 . 'MB';
        elseif($bytes >= 1024) $bytes = round($bytes / 1024 * 100) / 100 . 'KB';
        else $bytes = $bytes . 'Bytes';
        return $bytes;
    }

    /** 返回json。*/
    private function _output()
    {
        $data['err'] = $this->err;
        $data['msg'] = $this->msg;
        return json_encode($data);
    }

    function __destruct()
    {
        //删除临时文件
        unlink($this->upload_file['tmp_name']);
    }
}
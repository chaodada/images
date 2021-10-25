<?php

class Img
{

    private $pic;

    private $backGroundPicPath;
    private $backGroundPic;

    private $fontPath;

    private $width; // 宽
    private $height; // 高
    private $type;

    private $colorArray = [];


    public $UserName;
    public $ToUserName;


    public function __construct()
    {
    }

    /**
     * 设置字体
     * @param $fontPath
     */
    public function SetFont($fontPath)
    {
        $this->fontPath = $fontPath;
    }

    /**
     * 设置背景图
     * @param $backGroundPicPath
     */
    public function SetBackGroundPic($backGroundPicPath)
    {
        $this->backGroundPicPath = $backGroundPicPath;
    }

    /**
     * 设置大小
     * @param $width
     * @param $height
     */
    public function SetSize($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    private function CreateColor()
    {

        switch ($this->type) {
            case 1:
                $this->colorArray['black'] = imagecolorallocate($this->pic, 1, 1, 1); //颜色
                $this->colorArray['blue'] = imagecolorallocatealpha($this->pic, 45, 100, 179, 0.96);
                break;
            case 2:
                $this->colorArray['white'] = imagecolorallocatealpha($this->pic, 255, 255, 255, 41);
                break;
            default:
                break;
        }
    }



    private function WriteText()
    {
        switch ($this->type) {
            case 1:
                imagettftext($this->pic, 14, 0, 23, 164, $this->colorArray['black'], $this->fontPath, $this->UserName);
                imagettftext($this->pic, 14, 0, 180, 330, $this->colorArray['blue'], $this->fontPath, $this->ToUserName);
                break;
            case 2:
                imagettftext($this->pic, 60, 0, 190, 500, $this->colorArray['white'], $this->fontPath, $this->ToUserName);
                break;
            default:
                break;
        }
    }


    public function Start($type = 1)
    {
        $this->type = $type;
        $this->CreatePic();
        $this->ReadBackGroundPic();
        $this->ImgCopy();
        $this->CreateColor();
        $this->WriteText();
    }

    /**
     * Base64输出
     */
    public function OutputBase64()
    {
        ob_start();
        imagejpeg($this->pic);
        $imageData = ob_get_contents();
        $base64Image = base64_encode($imageData);
        ob_end_clean();
        $this->destroyImage();
        return 'data:image/jpeg;base64,' . $base64Image;
    }




    /**
     * http输出
     */
    public function OutputHttpImage()
    {
        header("content-type:image/jpeg");
        imagejpeg($this->pic);
        $this->destroyImage();
    }

    /**
     * 保存到本地
     */
    public function OutputLocalImage($path='')
    {
        if (!$path) {
            $path = date('YmdHis') . ".jpeg";
        }
        imagejpeg($this->pic, $path);
        $this->destroyImage();
        return $path;
    }


    /**
     * 销毁图片
     */
    private function destroyImage()
    {
        imagedestroy($this->pic);
    }


    private function ImgCopy()
    {
        imagecopy($this->pic, $this->backGroundPic, 0, 0, 0, 0, $this->width, $this->height);
        imagedestroy($this->backGroundPic);
    }

    /**
     *
     */
    private function ReadBackGroundPic()
    {
        $this->backGroundPic = imagecreatefromjpeg($this->backGroundPicPath);
    }

    /**
     *
     */
    private function CreatePic()
    {
        $this->pic = imagecreatetruecolor($this->width, $this->height);
    }


}

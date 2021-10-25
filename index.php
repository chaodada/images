<?php

include 'Img.php';

$obj = new Img();
$obj->UserName = "我";
$obj->ToUserName = "你";

//$obj->SetFont('01.ttf');
//$obj->SetBackGroundPic('01.jpg');
//$obj->SetSize(393, 708);
//$obj->Start(1);


$obj->SetFont('02.ttf');
$obj->SetBackGroundPic('02.jpg');
$obj->SetSize(580, 774);
$obj->Start(2);




//$obj->OutputHttpImage();
echo $obj->OutputLocalImage();
//echo  $obj->OutputBase64();

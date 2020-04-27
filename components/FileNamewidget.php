<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

use yii;
use yii\base\Widget;

class FileNamewidget extends Widget {

    public static function getimage($file) {
        $array = $file;
        $fileName = $array[0];
        $fileName = time();
        $fileExt = $array[1];
        $newfile = $fileName . "." . $fileExt;
        return $newfile;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23.02.2019
 * Time: 22:40
 */

namespace App\Http\UrlHelper;
use App\Http\FileHelper\FileHelper;

class UrlHelper
{
    public static function checkUrl($url)
    {
        if ($url) {
            $filehelper = new FileHelper($url);
            if ($filehelper->getUrlContent()) {

                if ($filehelper->getFileNameAndExtensionFromUrl()) {

                    return 'Ok';


                } else
                    return 'Url does not containe file with extension';
            } else {
                return 'Url is not valid';
            }
        }
        else {
            return 'Url is empty';
        }

    }
}

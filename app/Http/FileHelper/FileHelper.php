<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23.02.2019
 * Time: 20:42
 */

namespace App\Http\FileHelper;


class FileHelper
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function getUrlContent()
    {
        try {
            $result = file_get_contents($this->url);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
        return $result;
    }

    public function getPathToFile($foldername)
    {
        $path = '/'.$foldername. '/'.$this->getFileNameAndExtensionFromUrl();
        return $path;
    }

   private function getPathInfo()
   {
       return pathinfo($this->url);
   }

    public function getFileNameAndExtensionFromUrl()
    {
        $path_parts = $this->getPathInfo();
        if ((array_key_exists('filename', $path_parts)) and (array_key_exists('extension', $path_parts))){
                $filename_and_extension =  $path_parts['filename'] .'.' . $path_parts['extension'];
                return $filename_and_extension;
        }
        else
        {
            return false;
        }

    }

    public function saveFileOnLocalDisk(){
       file_put_contents(public_path($this->getPathToFile('storage')), $this->getUrlContent());
    }

    public function getMimeTypeFromFile()
    {
        $mime_content_type = mime_content_type('storage/' . $this->getFileNameAndExtensionFromUrl());
        return $mime_content_type;
    }



}

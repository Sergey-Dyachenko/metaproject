<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21.02.2019
 * Time: 23:58
 */


namespace App\Http\Controllers\Api;

use App\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\UrlHelper\UrlHelper;
use App\Http\FileHelper\FileHelper;

class ApiController extends Controller
{
    public function index()
    {
        $files = File::all();
        return response()->json($files);
    }

    public function store(Request $request)
    {
        $url = $request->input('url');
        $check_result = UrlHelper::checkUrl($url);
        if ($check_result == 'Ok')
        {
            $filehelper = new FileHelper($url);
            $filehelper->saveFileOnLocalDisk();
            $file = new File();
            $file->mime_type = $filehelper->getMimeTypeFromFile();
            $file->url = $url;
            $file->path = $filehelper->getPathToFile('storage');
            $file->save();
            return response()->json($file->toArray());
        }
        else
        {
            return response()->json($check_result);
        }
    }

    public  function destroy($id)
    {

        $file = File::find($id);
        $absolute_path = public_path() . $file->path;
        if (is_file($absolute_path))
        {
            unlink($absolute_path);
        }
        $file->delete();

        return response()->json('File deleted');
    }
}

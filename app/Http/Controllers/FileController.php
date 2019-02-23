<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21.02.2019
 * Time: 21:31
 */

namespace App\Http\Controllers;
use App\File;
use App\Http\UrlHelper\UrlHelper;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FileFacade;
use App\Http\FileHelper\FileHelper;

class FileController
{
    public function index()
    {
        $files = File::all();
        return view('welcome', compact('files'));
    }

    public function destroy($id)
    {
        $file = File::find($id);

        $absolute_path = public_path() . $file->path;

        if (is_file($absolute_path))
        {
           unlink($absolute_path);
        }
        $file->delete();

        return redirect('/');
    }

    public function download($id)
    {

        $file = File::find($id);
        $path_parts = pathinfo($file->url);
        $filename_and_extension = $path_parts['filename']. '.'.$path_parts['extension'];
        $full_path = public_path(). $file->path;
        $headers = [
            'Content-Type:' . $file->mime_type
        ];
        return response()->download($full_path, $filename_and_extension, $headers);
    }



    public function savefile(Request $request)
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
            return redirect('/');
        }
        else
        {
            echo $check_result;
        }

    }
}

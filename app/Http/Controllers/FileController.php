<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21.02.2019
 * Time: 21:31
 */

namespace App\Http\Controllers;
use App\File;
use Response;

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
        $file->delete();
        return redirect('/');
    }

    public function download($id)
    {
        $file = File::find($id);
        $full_url = public_path(). $file->path;
        $headers = [
            'Content-Type:' . $file->mime_type
        ];
        return response()->download($full_url, 'bootstrap.css', $headers);
    }


    public function savefile($url)
    {
        var_dump($url);
        die();
    }
}

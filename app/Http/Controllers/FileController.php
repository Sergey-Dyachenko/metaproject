<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21.02.2019
 * Time: 21:31
 */

namespace App\Http\Controllers;
use App\File;

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
}
